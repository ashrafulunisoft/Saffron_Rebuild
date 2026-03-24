<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display the shipping settings page.
     */
    public function index()
    {
        $shippingSettings = [
            'inside_dhaka' => Setting::getShippingInsideDhaka(),
            'outside_dhaka' => Setting::getShippingOutsideDhaka(),
            'free_shipping_threshold' => Setting::getFreeShippingThreshold(),
        ];

        return view('admin.ecommerce.shipping.index', compact('shippingSettings'));
    }

    /**
     * Update shipping settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'inside_dhaka' => 'required|numeric|min:0',
            'outside_dhaka' => 'required|numeric|min:0',
            'free_shipping_threshold' => 'required|numeric|min:0',
        ]);

        try {
            $setting = Setting::where('key', 'shipping_inside_dhaka')->first();
            if ($setting) {
                $setting->update(['value' => $request->inside_dhaka]);
            }

            $setting = Setting::where('key', 'shipping_outside_dhaka')->first();
            if ($setting) {
                $setting->update(['value' => $request->outside_dhaka]);
            }

            $setting = Setting::where('key', 'free_shipping_threshold')->first();
            if ($setting) {
                $setting->update(['value' => $request->free_shipping_threshold]);
            }

            // Clear cache
            Setting::clearCache();

            return redirect()->route('admin.ecommerce.shipping.index')
                ->with('success', 'Shipping charges updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Shipping update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to update shipping charges: ' . $e->getMessage())
                ->withInput();
        }
    }
}
