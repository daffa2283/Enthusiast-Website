<?php
/**
 * Script untuk setup gambar di hosting Laravel
 * Jalankan script ini setelah upload ke hosting untuk memastikan semua gambar dapat ditampilkan
 */

echo "=== Setup Hosting Images Laravel ===\n";

// 1. Buat storage symlink
echo "1. Membuat storage symlink...\n";
if (file_exists('public/storage')) {
    echo "   Storage symlink sudah ada\n";
} else {
    // Buat symlink manual jika artisan tidak tersedia
    $target = '../storage/app/public';
    $link = 'public/storage';
    
    if (symlink($target, $link)) {
        echo "   Storage symlink berhasil dibuat\n";
    } else {
        echo "   Gagal membuat storage symlink, mencoba metode alternatif...\n";
        
        // Metode alternatif: copy folder
        if (!is_dir('public/storage')) {
            mkdir('public/storage', 0755, true);
        }
        
        // Copy semua file dari storage/app/public ke public/storage
        $sourceDir = 'storage/app/public';
        $targetDir = 'public/storage';
        
        if (is_dir($sourceDir)) {
            copyDirectory($sourceDir, $targetDir);
            echo "   File berhasil dicopy dari storage/app/public ke public/storage\n";
        } else {
            echo "   Folder storage/app/public tidak ditemukan\n";
        }
    }
}

// 2. Pastikan folder gambar ada
echo "2. Memastikan folder gambar ada...\n";
$imageFolders = [
    'public/images',
    'public/storage/products',
    'public/storage/payment_proofs',
    'storage/app/public/products',
    'storage/app/public/payment_proofs'
];

foreach ($imageFolders as $folder) {
    if (!is_dir($folder)) {
        mkdir($folder, 0755, true);
        echo "   Folder dibuat: $folder\n";
    } else {
        echo "   Folder sudah ada: $folder\n";
    }
}

// 3. Set permission untuk folder gambar
echo "3. Setting permission untuk folder gambar...\n";
$dirs = [
    'public/images',
    'public/storage',
    'storage/app/public',
    'storage/app/public/products',
    'storage/app/public/payment_proofs'
];

foreach ($dirs as $dir) {
    if (is_dir($dir)) {
        chmod($dir, 0755);
        echo "   Permission set untuk: $dir\n";
        
        // Set permission untuk semua file di dalam folder
        $files = glob($dir . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                chmod($file, 0644);
            }
        }
    }
}

// 4. Cek gambar yang ada
echo "4. Mengecek gambar yang ada...\n";
$imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];

// Cek gambar di public/images
if (is_dir('public/images')) {
    $publicImages = scandir('public/images');
    $imageCount = 0;
    foreach ($publicImages as $file) {
        if ($file != '.' && $file != '..') {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, $imageExtensions)) {
                $imageCount++;
            }
        }
    }
    echo "   Ditemukan $imageCount gambar di public/images\n";
}

// Cek gambar di storage
if (is_dir('storage/app/public')) {
    $storageImages = 0;
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('storage/app/public'));
    foreach ($iterator as $file) {
        if ($file->isFile()) {
            $ext = strtolower($file->getExtension());
            if (in_array($ext, $imageExtensions)) {
                $storageImages++;
            }
        }
    }
    echo "   Ditemukan $storageImages gambar di storage/app/public\n";
}

// 5. Buat file .htaccess untuk folder storage jika belum ada
echo "5. Membuat .htaccess untuk folder storage...\n";
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
    echo "   .htaccess dibuat untuk public/storage\n";
} else {
    echo "   .htaccess sudah ada untuk public/storage\n";
}

// 6. Test akses gambar
echo "6. Testing akses gambar...\n";
$testImages = [
    'public/images/logo.png',
    'public/images/MOCKUP DEPAN.jpeg.jpg',
    'public/images/no-image.png'
];

foreach ($testImages as $testImage) {
    if (file_exists($testImage)) {
        echo "   ✓ $testImage dapat diakses\n";
    } else {
        echo "   ✗ $testImage tidak ditemukan\n";
    }
}

// 7. Buat gambar fallback jika tidak ada
echo "7. Membuat gambar fallback...\n";
$fallbackImages = [
    'public/images/no-image.png',
    'public/images/no-payment-proof.svg'
];

foreach ($fallbackImages as $fallbackImage) {
    if (!file_exists($fallbackImage)) {
        // Buat gambar placeholder sederhana
        if (strpos($fallbackImage, '.svg') !== false) {
            $svgContent = '<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200">
                <rect width="200" height="200" fill="#f8f9fa"/>
                <text x="100" y="100" text-anchor="middle" dy=".3em" font-family="Arial" font-size="14" fill="#6c757d">No Image</text>
            </svg>';
            file_put_contents($fallbackImage, $svgContent);
            echo "   Fallback SVG dibuat: $fallbackImage\n";
        }
    }
}

echo "\n=== Setup gambar selesai ===\n";
echo "Langkah selanjutnya:\n";
echo "1. Pastikan APP_URL di .env sesuai dengan domain hosting\n";
echo "2. Jalankan: php artisan config:cache\n";
echo "3. Jalankan: php artisan route:cache\n";
echo "4. Test akses gambar di browser\n";
echo "5. Jika masih bermasalah, cek permission folder dan file\n";

/**
 * Helper function untuk copy directory
 */
function copyDirectory($source, $destination) {
    if (!is_dir($destination)) {
        mkdir($destination, 0755, true);
    }
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    foreach ($iterator as $item) {
        $target = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
        
        if ($item->isDir()) {
            if (!is_dir($target)) {
                mkdir($target, 0755, true);
            }
        } else {
            copy($item, $target);
            chmod($target, 0644);
        }
    }
}
?>