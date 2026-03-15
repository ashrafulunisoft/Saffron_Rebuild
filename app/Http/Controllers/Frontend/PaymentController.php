<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\SSLCommerzService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    protected $sslcommerz;

    public function __construct(SSLCommerzService $sslcommerz)
    {
        $this->sslcommerz = $sslcommerz;
    }

    /**
     * Initiate SSLCommerz payment
     */
    public function pay(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        $order = Order::findOrFail($request->order_id);

        // Check if order belongs to current user
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('customer.orders')
                ->with('error', 'Unauthorized access.');
        }

        // Check if order is already paid
        if ($order->payment_status === 'paid') {
            return redirect()->route('customer.orders.show', $order)
                ->with('info', 'This order is already paid.');
        }

        $tran_id = 'TRAN-' . strtoupper(uniqid()) . '-' . $order->id;

        // Parse shipping address
        $address = json_decode($order->shipping_address, true);

        $paymentData = [
            'total_amount' => $order->final_amount,
            'currency' => 'BDT',
            'tran_id' => $tran_id,
            'success_url' => route('payment.success'),
            'fail_url' => route('payment.fail'),
            'cancel_url' => route('payment.cancel'),
            'ipn_url' => route('payment.ipn'),
            'cus_name' => ($address['first_name'] ?? '') . ' ' . ($address['last_name'] ?? ''),
            'cus_email' => $address['email'] ?? '',
            'cus_phone' => $address['phone'] ?? '',
            'cus_add1' => $address['address'] ?? '',
            'cus_city' => $address['city'] ?? '',
            'product_name' => "Order #{$order->order_number}",
            'product_category' => 'Ecommerce',
            'product_profile' => 'physical-goods',
        ];

        $response = $this->sslcommerz->createPayment($paymentData);

        if (isset($response['status']) && $response['status'] === 'SUCCESS') {
            // Save transaction ID to order
            $order->update([
                'transaction_id' => $tran_id,
                'payment_method' => 'sslcommerz',
            ]);

            return redirect()->away($response['GatewayPageURL']);
        }

        // Log and show actual error
        $errorMessage = $response['message'] ?? 'Unknown error occurred';
        Log::error('Payment initiation failed: ' . $errorMessage, ['response' => $response]);

        return redirect()->route('checkout')
            ->with('error', 'Payment initiation failed: ' . $errorMessage);
    }

    /**
     * Payment success callback
     */
    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');

        // Validate transaction
        $validation = $this->sslcommerz->validateTransaction($tran_id);

        if ($validation && isset($validation['element'][0]['error_title']) === 'N/A') {
            // Update order status
            $order = Order::where('transaction_id', $tran_id)->first();

            if ($order) {
                DB::beginTransaction();
                try {
                    $order->update([
                        'payment_status' => 'paid',
                        'status' => 'processing',
                    ]);

                    // Clear the cart for authenticated user after successful payment
                    Cart::where('user_id', Auth::id())->delete();

                    DB::commit();

                    return redirect()->route('customer.orders.show', $order)
                        ->with('success', 'Payment completed successfully!');
                } catch (\Exception $e) {
                    DB::rollback();
                    return redirect()->route('customer.orders')
                        ->with('error', 'Payment successful but order update failed. Please contact support.');
                }
            }
        }

        return redirect()->route('customer.orders')
            ->with('error', 'Payment validation failed.');
    }

    /**
     * Payment fail callback
     */
    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order = Order::where('transaction_id', $tran_id)->first();

        if ($order) {
            $order->update([
                'payment_status' => 'failed',
                'status' => 'cancelled',
            ]);
        }

        return redirect()->route('customer.orders')
            ->with('error', 'Payment failed. Please try again or contact support.');
    }

    /**
     * Payment cancel callback
     */
    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order = Order::where('transaction_id', $tran_id)->first();

        if ($order) {
            $order->update([
                'payment_status' => 'cancelled',
                'status' => 'cancelled',
            ]);
        }

        return redirect()->route('customer.orders')
            ->with('info', 'Payment cancelled.');
    }

    /**
     * IPN (Instant Payment Notification) listener
     */
    public function ipn(Request $request)
    {
        // Verify IPN
        if ($this->sslcommerz->verifyIPN($request->all())) {
            $tran_id = $request->input('tran_id');
            $order = Order::where('transaction_id', $tran_id)->first();

            if ($order && $order->payment_status !== 'paid') {
                DB::beginTransaction();
                try {
                    $order->update([
                        'payment_status' => 'paid',
                        'status' => 'processing',
                    ]);

                    // Clear the cart for authenticated user
                    Cart::where('user_id', $order->user_id)->delete();

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    Log::error('IPN Order Update Failed: ' . $e->getMessage());
                }
            }
        }

        return response()->json(['status' => 'success']);
    }
}
