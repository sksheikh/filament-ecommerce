<?php

namespace App\Helpers;

use App\Models\DeliveryCharge;
use Illuminate\Support\Facades\Log;

class ShippingChargeManagement
{
    /**
     * Get the shipping charge based on district and area.
     *
     * @param int|null $districtId
     * @param int|null $areaId
     * @return float
     */
    public static function getShippingCharge($districtId = null)
    {

        if (!$districtId) {
            $shippingInfo = self::getShippingInfoFromCookie();
            $districtId = $shippingInfo['district_id'] ?? null;
        }

        if (!$districtId) {
            return 0;
        }



        // Find charge by district mapping
        $charge = DeliveryCharge::whereHas('districts', function ($query) use ($districtId) {
            $query->where('districts.id', $districtId);
        })->where('is_active', true)->first();
        

        if ($charge) {
            return (float) $charge->amount;
        }

        // Fallback to default logic
        if ($districtId == 18) { // Dhaka District ID
            return (float) getSetting('shipping_inside_dhaka', 60);
        }

        return (float) getSetting('shipping_outside_dhaka', 120);
    }

    /**
     * Add shipping info to cookie.
     * 
     * @param int $districtId
     * @param int|null $areaId
     */
    public static function addShippingInfoToCookie($districtId)
    {
        $shippingInfo = [
            'district_id' => $districtId,
            'amount' => self::getShippingCharge($districtId),
        ];

        \Illuminate\Support\Facades\Cookie::queue('shipping_info', json_encode($shippingInfo), 60 * 24 * 30);
    }

    /**
     * Get shipping info from cookie.
     * 
     * @return array
     */
    public static function getShippingInfoFromCookie()
    {
        $shippingInfo = json_decode(\Illuminate\Support\Facades\Cookie::get('shipping_info'), true);
        return $shippingInfo ?: [];
    }

    /**
     * Clear shipping info from cookie.
     */
    public static function clearShippingInfo()
    {
        \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::forget('shipping_info'));
    }
}
