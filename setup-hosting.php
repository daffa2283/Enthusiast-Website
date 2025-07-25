<?php
/**
 * Script untuk setup hosting Laravel
 * Jalankan script ini setelah upload ke hosting
 */

echo "=== Setup Hosting Laravel ===\n";

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
        echo "   Gagal membuat storage symlink\n";
        echo "   Silakan buat folder 'storage' di dalam folder 'public'\n";
        echo "   Dan copy semua file dari 'storage/app/public' ke 'public/storage'\n";
    }
}

// 2. Set permission untuk storage dan cache
echo "2. Setting permission...\n";
$dirs = [
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
    'bootstrap/cache'
];

foreach ($dirs as $dir) {
    if (is_dir($dir)) {
        chmod($dir, 0755);
        echo "   Permission set untuk: $dir\n";
    }
}

// 3. Clear cache
echo "3. Clearing cache...\n";
$cacheFiles = [
    'bootstrap/cache/config.php',
    'bootstrap/cache/routes.php',
    'bootstrap/cache/services.php'
];

foreach ($cacheFiles as $file) {
    if (file_exists($file)) {
        unlink($file);
        echo "   Deleted: $file\n";
    }
}

echo "\n=== Setup selesai ===\n";
echo "Jangan lupa:\n";
echo "1. Update APP_URL di .env dengan domain hosting Anda\n";
echo "2. Update konfigurasi database di .env\n";
echo "3. Jalankan: php artisan config:cache\n";
echo "4. Jalankan: php artisan route:cache\n";
?>