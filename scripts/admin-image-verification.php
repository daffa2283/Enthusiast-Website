<?php
/**
 * Admin Image Verification Script
 * Memverifikasi bahwa semua gambar di admin dashboard menggunakan ImageHelper
 */

echo "=== Admin Image Verification Script ===\n\n";

// Files yang perlu dicek
$filesToCheck = [
    'app/Filament/Resources/ProductResource.php' => [
        'pattern' => 'ImageHelper::getProductImageUrl',
        'description' => 'Product images in admin table'
    ],
    'app/Filament/Resources/OrderResource.php' => [
        'pattern' => 'ImageHelper::getPaymentProofUrl',
        'description' => 'Payment proof images in admin table'
    ],
    'resources/views/admin/orders/show.blade.php' => [
        'pattern' => 'ImageHelper::getPaymentProofUrl',
        'description' => 'Payment proof in order details'
    ],
    'resources/views/filament/modals/payment-proof.blade.php' => [
        'pattern' => 'ImageHelper::getPaymentProofUrl',
        'description' => 'Payment proof modal'
    ]
];

$allPassed = true;

foreach ($filesToCheck as $file => $config) {
    echo "Checking: $file\n";
    
    if (!file_exists($file)) {
        echo "   ❌ File not found!\n";
        $allPassed = false;
        continue;
    }
    
    $content = file_get_contents($file);
    
    if (strpos($content, $config['pattern']) !== false) {
        echo "   ✅ {$config['description']} - Using ImageHelper\n";
    } else {
        echo "   ⚠️  {$config['description']} - NOT using ImageHelper\n";
        $allPassed = false;
    }
    
    // Check for old patterns
    $oldPatterns = [
        "asset('storage/'",
        'asset("storage/"'
    ];
    
    foreach ($oldPatterns as $oldPattern) {
        if (strpos($content, $oldPattern) !== false) {
            echo "   ⚠️  Found old pattern: $oldPattern\n";
            $allPassed = false;
        }
    }
    
    echo "\n";
}

// Check ImageHelper class
echo "Checking ImageHelper class...\n";
if (file_exists('app/Helpers/ImageHelper.php')) {
    echo "   ✅ ImageHelper class exists\n";
    
    $helperContent = file_get_contents('app/Helpers/ImageHelper.php');
    
    $requiredMethods = [
        'getProductImageUrl',
        'getPaymentProofUrl',
        'getImageUrl'
    ];
    
    foreach ($requiredMethods as $method) {
        if (strpos($helperContent, "function $method") !== false || strpos($helperContent, "static function $method") !== false) {
            echo "   ✅ Method $method exists\n";
        } else {
            echo "   ❌ Method $method missing\n";
            $allPassed = false;
        }
    }
} else {
    echo "   ❌ ImageHelper class not found!\n";
    $allPassed = false;
}

echo "\n";

// Check composer autoload
echo "Checking composer autoload...\n";
if (file_exists('composer.json')) {
    $composerContent = file_get_contents('composer.json');
    $composerData = json_decode($composerContent, true);
    
    if (isset($composerData['autoload']['files']) && 
        in_array('app/Helpers/ImageHelper.php', $composerData['autoload']['files'])) {
        echo "   ✅ ImageHelper is autoloaded in composer.json\n";
    } else {
        echo "   ⚠️  ImageHelper not found in composer autoload\n";
        $allPassed = false;
    }
} else {
    echo "   ❌ composer.json not found!\n";
    $allPassed = false;
}

echo "\n";

// Check fallback images
echo "Checking fallback images...\n";
$fallbackImages = [
    'public/images/MOCKUP DEPAN.jpeg.jpg',
    'public/images/MOCKUP BELAKANG.jpeg.jpg',
    'public/images/no-image.png',
    'public/images/no-payment-proof.svg'
];

foreach ($fallbackImages as $image) {
    if (file_exists($image)) {
        echo "   ✅ $image exists\n";
    } else {
        echo "   ⚠️  $image missing\n";
        $allPassed = false;
    }
}

echo "\n";

// Summary
echo str_repeat("=", 50) . "\n";
echo "VERIFICATION SUMMARY\n";
echo str_repeat("=", 50) . "\n";

if ($allPassed) {
    echo "🎉 ALL CHECKS PASSED!\n";
    echo "✅ Admin dashboard images are properly configured\n";
    echo "✅ All files are using ImageHelper\n";
    echo "✅ Fallback images are in place\n";
    echo "✅ Ready for hosting deployment\n";
} else {
    echo "⚠️  SOME ISSUES FOUND!\n";
    echo "Please review the warnings above and fix them.\n";
}

echo "\nNext steps:\n";
echo "1. Run: composer dump-autoload\n";
echo "2. Test admin dashboard locally\n";
echo "3. Deploy to hosting\n";
echo "4. Run final-image-fix.php on hosting\n";

echo "\n" . str_repeat("=", 50) . "\n";
?>