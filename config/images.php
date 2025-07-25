<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Image Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains configuration for image handling in the application
    |
    */

    'fallbacks' => [
        'product' => 'images/MOCKUP DEPAN.jpeg.jpg',
        'product_back' => 'images/MOCKUP BELAKANG.jpeg.jpg',
        'payment_proof' => 'images/no-payment-proof.svg',
        'no_image' => 'images/no-image.png',
        'logo' => 'images/logo.png',
    ],

    'storage_paths' => [
        'products' => 'products',
        'payment_proofs' => 'payment_proofs',
    ],

    'allowed_extensions' => [
        'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'
    ],

    'max_file_size' => 5120, // 5MB in KB

    'image_quality' => [
        'jpeg' => 85,
        'webp' => 85,
    ],

    'thumbnails' => [
        'small' => [150, 150],
        'medium' => [300, 300],
        'large' => [600, 600],
    ],
];