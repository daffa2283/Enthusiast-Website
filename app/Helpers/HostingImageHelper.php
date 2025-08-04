<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class HostingImageHelper
{
    /**
     * Get image URL that works in both local and hosting environments
     */
    public static function getImageUrl($imagePath, $fallback = "images/no-image.png")
    {
        if (empty($imagePath)) {
            return asset($fallback);
        }

        // For hosting environment - always use asset() with storage prefix
        if (!str_starts_with($imagePath, "storage/")) {
            $imagePath = "storage/" . $imagePath;
        }

        // Check if file exists before returning URL
        $publicPath = public_path($imagePath);
        if (file_exists($publicPath)) {
            return asset($imagePath);
        }

        // Fallback to default image
        return asset($fallback);
    }

    /**
     * Get product image URL for hosting
     */
    public static function getProductImageUrl($imagePath)
    {
        return self::getImageUrl($imagePath, "images/MOCKUP DEPAN.jpeg.jpg");
    }

    /**
     * Get payment proof URL for hosting
     */
    public static function getPaymentProofUrl($imagePath)
    {
        return self::getImageUrl($imagePath, "images/no-payment-proof.svg");
    }
}