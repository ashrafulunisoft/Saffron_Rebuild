<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SSLCommerzService
{
    protected $storeId;
    protected $storePassword;
    protected $isSandbox;

    public function __construct()
    {
        $this->storeId = config('services.sslcommerz.store_id');
        $this->storePassword = config('services.sslcommerz.store_password');
        $this->isSandbox = config('services.sslcommerz.sandbox', true);
    }

    /**
     * Create payment session
     */
    public function createPayment(array $data)
    {
        $url = $this->isSandbox
            ? 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php'
            : 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';

        $post_data = [
            'store_id' => $this->storeId,
            'store_passwd' => $this->storePassword,
            'total_amount' => $data['total_amount'],
            'currency' => $data['currency'] ?? 'BDT',
            'tran_id' => $data['tran_id'],
            'success_url' => $data['success_url'],
            'fail_url' => $data['fail_url'],
            'cancel_url' => $data['cancel_url'],
            'multi_card_name' => $data['multi_card_name'] ?? '',
            'cus_name' => $data['cus_name'],
            'cus_email' => $data['cus_email'],
            'cus_phone' => $data['cus_phone'],
            'cus_add1' => $data['cus_add1'],
            'cus_city' => $data['cus_city'],
            'cus_country' => $data['cus_country'] ?? 'Bangladesh',
            'shipping_method' => $data['shipping_method'] ?? 'NO',
            'product_name' => $data['product_name'] ?? 'Order Payment',
            'product_category' => $data['product_category'] ?? 'Ecommerce',
            'product_profile' => $data['product_profile'] ?? 'physical-goods',
        ];

        // Only add ipn_url if provided
        if (!empty($data['ipn_url'])) {
            $post_data['ipn_url'] = $data['ipn_url'];
        }

        try {
            // Log the request data for debugging
            Log::info('SSLCommerz Request:', [
                'url' => $url,
                'store_id' => $this->storeId,
                'total_amount' => $data['total_amount'],
                'tran_id' => $data['tran_id'],
            ]);

            $response = Http::asForm()->post($url, $post_data);

            // Log the response
            Log::info('SSLCommerz Response:', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if ($response->successful()) {
                $result = $response->json();
                Log::info('SSLCommerz JSON Response:', $result);

                // Check if response contains GatewayPageURL
                if (isset($result['GatewayPageURL'])) {
                    return $result;
                }

                // If no GatewayPageURL, this might be an error response
                Log::error('SSLCommerz: No GatewayPageURL in response', $result);
                return [
                    'status' => 'error',
                    'message' => $result['error'] ?? 'Invalid response from payment gateway'
                ];
            }

            Log::error('SSLCommerz API Error: ' . $response->body() . ' Status: ' . $response->status());
            return [
                'status' => 'error',
                'message' => 'Failed to connect to payment gateway (HTTP ' . $response->status() . ')'
            ];

        } catch (\Exception $e) {
            Log::error('SSLCommerz Exception: ' . $e->getMessage());
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Validate payment transaction
     */
    public function validateTransaction($tran_id)
    {
        $url = $this->isSandbox
            ? 'https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php'
            : 'https://securepay.sslcommerz.com/validator/api/validationserverAPI.php';

        $post_data = [
            'store_id' => $this->storeId,
            'store_passwd' => $this->storePassword,
            'tran_id' => $tran_id,
            'val_id' => request()->get('val_id'),
            'amount' => request()->get('amount'),
            'card_type' => request()->get('card_type'),
            'currency' => request()->get('currency') ?? 'BDT',
            'card_no' => request()->get('card_no'),
        ];

        try {
            $response = Http::asForm()->post($url, $post_data);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('SSLCommerz Validation Error: ' . $response->body());
            return null;

        } catch (\Exception $e) {
            Log::error('SSLCommerz Validation Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Verify IPN (Instant Payment Notification)
     */
    public function verifyIPN(array $data)
    {
        # Check if the transaction is valid
        if (isset($data['tran_id']) && isset($data['val_id'])) {
            $validation = $this->validateTransaction($data['tran_id']);

            if ($validation && isset($validation['element'][0]['error_title']) === 'N/A') {
                return true;
            }
        }

        return false;
    }

    /**
     * Get gateway URL
     */
    public function getGatewayUrl()
    {
        return $this->isSandbox
            ? 'https://sandbox.sslcommerz.com/gwprocess/v3/api.php'
            : 'https://securepay.sslcommerz.com/gwprocess/v3/api.php';
    }
}
