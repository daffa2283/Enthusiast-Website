<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Get image URL with fallback for hosting environment
     */
    public static function getImageUrl($imagePath, $fallback = 'images/no-image.png')
    {
        if (empty($imagePath)) {
            return asset($fallback);
        }

        // Jika path sudah lengkap (http/https), return as is
        if (str_starts_with($imagePath, 'http')) {
            return $imagePath;
        }

        // Untuk gambar di storage (uploaded files)
        if (!str_starts_with($imagePath, 'storage/')) {
            // Check if file exists in storage/app/public
            if (Storage::disk('public')->exists($imagePath)) {
                return asset('storage/' . $imagePath);
            }
        }

        // Jika sudah ada prefix storage/
        if (str_starts_with($imagePath, 'storage/')) {
            $cleanPath = str_replace('storage/', '', $imagePath);
            if (Storage::disk('public')->exists($cleanPath)) {
                return asset($imagePath);
            }
        }

        // Jika file ada di public folder langsung
        $publicPath = public_path($imagePath);
        if (file_exists($publicPath)) {
            return asset($imagePath);
        }

        // Return fallback jika tidak ada
        return asset($fallback);
    }

    /**
     * Get product image URL with fallback
     */
    public static function getProductImageUrl($imagePath, $fallback = 'images/MOCKUP DEPAN.jpeg.jpg')
    {
        return self::getImageUrl($imagePath, $fallback);
    }

    /**
     * Get payment proof URL with fallback
     */
    public static function getPaymentProofUrl($imagePath, $fallback = 'images/no-payment-proof.svg')
    {
        return self::getImageUrl($imagePath, $fallback);
    }

    /**
     * Check if image exists in storage
     */
    public static function imageExists($imagePath)
    {
        if (empty($imagePath)) {
            return false;
        }

        // Check in storage/app/public
        if (Storage::disk('public')->exists($imagePath)) {
            return true;
        }

        // Check in public folder
        $publicPath = public_path($imagePath);
        if (file_exists($publicPath)) {
            return true;
        }

        return false;
    }

    /**
     * Get storage URL for Filament
     */
    public static function getStorageUrl($path)
    {
        if (empty($path)) {
            return null;
        }

        // Ensure we have the correct storage URL
        return Storage::disk('public')->url($path);
    }

    /**
     * Fix image path for hosting environment
     */
    public static function fixImagePath($imagePath)
    {
        if (empty($imagePath)) {
            return null;
        }

        // Remove any leading slashes or storage/ prefix
        $cleanPath = ltrim($imagePath, '/');
        $cleanPath = str_replace('storage/', '', $cleanPath);

        return $cleanPath;
    }
}