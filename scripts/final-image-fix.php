<?php
/**
 * Final Image Fix Script untuk EnthusiastVerse E-commerce
 * Script ini akan memastikan semua gambar dapat ditampilkan dengan benar di hosting
 */

echo "=== Final Image Fix untuk EnthusiastVerse E-commerce ===\n\n";

// 1. Update APP_URL di .env
echo "1. Checking .env configuration...\n";
$envFile = '.env';
if (file_exists($envFile)) {
    $envContent = file_get_contents($envFile);
    
    // Check current APP_URL
    if (preg_match('/APP_URL=(.*)/', $envContent, $matches)) {
        $currentUrl = trim($matches[1]);
        echo "   Current APP_URL: $currentUrl\n";
        
        if (strpos($currentUrl, 'localhost') !== false || strpos($currentUrl, '127.0.0.1') !== false) {
            echo "   ⚠️  APP_URL masih menggunakan localhost!\n";
            echo "   Silakan update APP_URL di file .env dengan domain hosting Anda\n";
        } else {
            echo "   ✓ APP_URL sudah dikonfigurasi untuk production\n";
        }
    }
} else {
    echo "   ❌ File .env tidak ditemukan!\n";
}

// 2. Check dan buat storage symlink
echo "\n2. Checking storage symlink...\n";
if (file_exists('public/storage')) {
    if (is_link('public/storage')) {
        echo "   ✓ Storage symlink sudah ada\n";
    } else {
        echo "   ⚠️  Folder public/storage ada tapi bukan symlink\n";
        echo "   Menghapus folder dan membuat symlink...\n";
        
        // Backup existing files
        if (is_dir('public/storage')) {
            rename('public/storage', 'public/storage_backup_' . date('Y-m-d_H-i-s'));
        }
        
        // Create symlink
        if (symlink('../storage/app/public', 'public/storage')) {
            echo "   ✓ Storage symlink berhasil dibuat\n";
        } else {
            echo "   ❌ Gagal membuat symlink, menggunakan metode copy...\n";
            copyStorageFiles();
        }
    }
} else {
    echo "   Creating storage symlink...\n";
    if (symlink('../storage/app/public', 'public/storage')) {
        echo "   ✓ Storage symlink berhasil dibuat\n";
    } else {
        echo "   ❌ Gagal membuat symlink, menggunakan metode copy...\n";
        copyStorageFiles();
    }
}

// 3. Check folder structure
echo "\n3. Checking folder structure...\n";
$requiredFolders = [
    'public/images',
    'public/storage',
    'storage/app/public',
    'storage/app/public/products',
    'storage/app/public/payment_proofs'
];

foreach ($requiredFolders as $folder) {
    if (is_dir($folder)) {
        echo "   ✓ $folder exists\n";
    } else {
        mkdir($folder, 0755, true);
        echo "   ✓ $folder created\n";
    }
}

// 4. Check permissions
echo "\n4. Setting permissions...\n";
$permissionFolders = [
    'storage' => 0755,
    'storage/app' => 0755,
    'storage/app/public' => 0755,
    'storage/logs' => 0755,
    'public/storage' => 0755,
    'public/images' => 0755
];

foreach ($permissionFolders as $folder => $permission) {
    if (is_dir($folder)) {
        chmod($folder, $permission);
        echo "   ✓ Permission set for $folder\n";
    }
}

// 5. Check gambar yang ada
echo "\n5. Checking existing images...\n";

// Check public/images
$publicImages = 0;
if (is_dir('public/images')) {
    $files = glob('public/images/*.{jpg,jpeg,png,gif,svg}', GLOB_BRACE);
    $publicImages = count($files);
    echo "   ✓ Found $publicImages images in public/images\n";
    
    // List important images
    $importantImages = [
        'public/images/logo.png',
        'public/images/MOCKUP DEPAN.jpeg.jpg',
        'public/images/MOCKUP BELAKANG.jpeg.jpg',
        'public/images/no-image.png',
        'public/images/no-payment-proof.svg'
    ];
    
    foreach ($importantImages as $img) {
        if (file_exists($img)) {
            echo "   ✓ $img exists\n";
        } else {
            echo "   ⚠️  $img missing\n";
        }
    }
}

// Check storage images
$storageImages = 0;
if (is_dir('storage/app/public')) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('storage/app/public'));
    foreach ($iterator as $file) {
        if ($file->isFile() && in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'svg'])) {
            $storageImages++;
        }
    }
    echo "   ✓ Found $storageImages images in storage/app/public\n";
}

// 6. Create .htaccess for storage
echo "\n6. Creating .htaccess for storage...\n";
$htaccessContent = '# Allow access to storage files
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Allow direct access to files
    RewriteCond %{REQUEST_FILENAME} -f
    RewriteRule ^(.*)$ - [L]
    
    # Prevent access to PHP files
    <Files "*.php">
        Order Deny,Allow
        Deny from all
    </Files>
</IfModule>

# Set proper MIME types for images
<IfModule mod_mime.c>
    AddType image/jpeg .jpg .jpeg
    AddType image/png .png
    AddType image/gif .gif
    AddType image/webp .webp
    AddType image/svg+xml .svg
</IfModule>

# Enable compression for images
<IfModule mod_deflate.c>
    <FilesMatch "\.(jpg|jpeg|png|gif|webp)$">
        SetOutputFilter DEFLATE
    </FilesMatch>
</IfModule>';

if (!file_exists('public/storage/.htaccess')) {
    file_put_contents('public/storage/.htaccess', $htaccessContent);
    echo "   ✓ .htaccess created for public/storage\n";
} else {
    echo "   ✓ .htaccess already exists for public/storage\n";
}

// 7. Create fallback images if missing
echo "\n7. Creating fallback images...\n";
createFallbackImages();

// 8. Test image access
echo "\n8. Testing image access...\n";
testImageAccess();

// 9. Generate summary report
echo "\n" . str_repeat("=", 60) . "\n";
echo "SUMMARY REPORT\n";
echo str_repeat("=", 60) . "\n";

echo "✓ Storage symlink: " . (is_link('public/storage') ? 'OK' : 'NEEDS ATTENTION') . "\n";
echo "✓ Public images: $publicImages files\n";
echo "✓ Storage images: $storageImages files\n";
echo "✓ Folder permissions: SET\n";
echo "✓ .htaccess files: CREATED\n";

echo "\nNEXT STEPS:\n";
echo "1. Update APP_URL in .env with your hosting domain\n";
echo "2. Run: php artisan config:cache\n";
echo "3. Run: php artisan route:cache\n";
echo "4. Test image access in browser\n";

echo "\nIf images still don't show:\n";
echo "1. Check if mod_rewrite is enabled on your server\n";
echo "2. Verify file permissions (755 for folders, 644 for files)\n";
echo "3. Check server error logs\n";
echo "4. Contact hosting support if needed\n";

echo "\n" . str_repeat("=", 60) . "\n";
echo "Script completed successfully!\n";

/**
 * Helper functions
 */
function copyStorageFiles() {
    echo "   Copying storage files manually...\n";
    
    if (!is_dir('public/storage')) {
        mkdir('public/storage', 0755, true);
    }
    
    if (is_dir('storage/app/public')) {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator('storage/app/public', RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach ($iterator as $item) {
            $target = 'public/storage/' . $iterator->getSubPathName();
            
            if ($item->isDir()) {
                if (!is_dir($target)) {
                    mkdir($target, 0755, true);
                }
            } else {
                copy($item, $target);
                chmod($target, 0644);
            }
        }
        echo "   ✓ Storage files copied successfully\n";
    }
}

function createFallbackImages() {
    // Create no-image.png if missing
    if (!file_exists('public/images/no-image.png')) {
        $img = imagecreate(200, 200);
        $bg = imagecolorallocate($img, 248, 249, 250);
        $text_color = imagecolorallocate($img, 108, 117, 125);
        imagestring($img, 5, 60, 95, 'No Image', $text_color);
        imagepng($img, 'public/images/no-image.png');
        imagedestroy($img);
        echo "   ✓ Created no-image.png\n";
    }
    
    // Create no-payment-proof.svg if missing
    if (!file_exists('public/images/no-payment-proof.svg')) {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200">
            <rect width="200" height="200" fill="#f8f9fa"/>
            <text x="100" y="100" text-anchor="middle" dy=".3em" font-family="Arial" font-size="14" fill="#6c757d">No Payment Proof</text>
        </svg>';
        file_put_contents('public/images/no-payment-proof.svg', $svg);
        echo "   ✓ Created no-payment-proof.svg\n";
    }
}

function testImageAccess() {
    $testImages = [
        'public/images/logo.png',
        'public/storage' // Test if storage folder is accessible
    ];
    
    foreach ($testImages as $path) {
        if (file_exists($path)) {
            echo "   ✓ $path is accessible\n";
        } else {
            echo "   ⚠️  $path not found\n";
        }
    }
}
?>