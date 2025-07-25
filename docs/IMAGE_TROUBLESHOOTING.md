# Panduan Troubleshooting Gambar - EnthusiastVerse E-commerce

## Masalah: Gambar Tidak Muncul Setelah Hosting (Muncul Tanda Tanya)

### Penyebab Umum:
1. **APP_URL tidak sesuai dengan domain hosting**
2. **Storage symlink belum dibuat**
3. **Permission folder tidak tepat**
4. **Path gambar tidak sesuai dengan struktur hosting**
5. **Server tidak mendukung symlink**

---

## Solusi Step-by-Step

### 1. Jalankan Script Otomatis
```bash
php final-image-fix.php
```

Script ini akan:
- ✅ Check konfigurasi .env
- ✅ Buat storage symlink
- ✅ Set permission folder
- ✅ Buat .htaccess files
- ✅ Create fallback images
- ✅ Test image access

### 2. Update Konfigurasi Environment

**Edit file `.env`:**
```env
APP_URL=https://yourdomain.com  # Ganti dengan domain hosting Anda
APP_ENV=production
APP_DEBUG=false
```

### 3. Buat Storage Symlink

**Metode 1 - Artisan (Recommended):**
```bash
php artisan storage:link
```

**Metode 2 - Manual jika Artisan gagal:**
```bash
ln -s ../storage/app/public public/storage
```

**Metode 3 - Copy manual jika symlink tidak didukung:**
```bash
cp -r storage/app/public/* public/storage/
```

### 4. Set Permission yang Benar

```bash
# Folder permissions
chmod 755 storage/
chmod 755 storage/app/
chmod 755 storage/app/public/
chmod 755 public/storage/
chmod 755 public/images/

# File permissions
find storage/app/public/ -type f -exec chmod 644 {} \;
find public/storage/ -type f -exec chmod 644 {} \;
find public/images/ -type f -exec chmod 644 {} \;
```

### 5. Clear dan Cache Ulang

```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Cache untuk production
php artisan config:cache
php artisan route:cache
```

---

## Struktur Folder yang Benar

```
public/
├── images/                     # Gambar statis
│   ├── logo.png
│   ├── MOCKUP DEPAN.jpeg.jpg
│   ├── MOCKUP BELAKANG.jpeg.jpg
│   ├── no-image.png
│   └── no-payment-proof.svg
├── storage/                    # Symlink ke ../storage/app/public/
│   ├── products/              # Gambar produk yang diupload
│   └── payment_proofs/        # Bukti pembayaran
└── .htaccess

storage/
└── app/
    └��─ public/
        ├── products/          # File asli gambar produk
        └── payment_proofs/    # File asli bukti pembayaran
```

---

## Troubleshooting Berdasarkan Hosting Provider

### Shared Hosting (cPanel, Plesk, dll)

**Masalah umum:**
- Symlink tidak didukung
- Permission terbatas
- PHP functions disabled

**Solusi:**
1. **Copy manual files:**
   ```bash
   cp -r storage/app/public/* public/storage/
   ```

2. **Set permission via File Manager:**
   - Folder: 755
   - Files: 644

3. **Check PHP functions:**
   Pastikan `symlink()` dan `exec()` tidak di-disable

### VPS/Dedicated Server

**Masalah umum:**
- Apache/Nginx configuration
- SELinux restrictions
- File ownership

**Solusi:**
1. **Apache - Enable mod_rewrite:**
   ```bash
   sudo a2enmod rewrite
   sudo systemctl restart apache2
   ```

2. **Nginx - Add location block:**
   ```nginx
   location /storage {
       alias /path/to/your/app/storage/app/public;
   }
   ```

3. **Fix ownership:**
   ```bash
   sudo chown -R www-data:www-data storage/
   sudo chown -R www-data:www-data public/storage/
   ```

### Cloud Hosting (AWS, DigitalOcean, dll)

**Masalah umum:**
- Load balancer issues
- CDN configuration
- Container restrictions

**Solusi:**
1. **Use S3/Object Storage untuk gambar**
2. **Configure CDN properly**
3. **Set correct ASSET_URL in .env**

---

## Debugging Tools

### 1. Check Symlink Status
```bash
ls -la public/storage
```
Output yang benar:
```
lrwxrwxrwx 1 user user 20 Jan 1 12:00 storage -> ../storage/app/public
```

### 2. Test Image Access
```bash
curl -I https://yourdomain.com/storage/products/image.jpg
curl -I https://yourdomain.com/images/logo.png
```

### 3. Check Server Logs
```bash
# Apache
tail -f /var/log/apache2/error.log

# Nginx
tail -f /var/log/nginx/error.log

# PHP
tail -f /var/log/php/error.log
```

### 4. Browser Developer Tools
1. Buka F12 → Network tab
2. Reload halaman
3. Cek status code gambar:
   - **200**: OK
   - **404**: File tidak ditemukan
   - **403**: Permission denied
   - **500**: Server error

---

## Fallback Solutions

### 1. Jika Symlink Tidak Bisa Dibuat

**Buat script sync otomatis:**
```php
// sync-storage.php
<?php
$source = 'storage/app/public/';
$target = 'public/storage/';

function syncFiles($source, $target) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    foreach ($iterator as $item) {
        $targetPath = $target . $iterator->getSubPathName();
        
        if ($item->isDir()) {
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0755, true);
            }
        } else {
            if (!file_exists($targetPath) || filemtime($item) > filemtime($targetPath)) {
                copy($item, $targetPath);
                chmod($targetPath, 0644);
            }
        }
    }
}

syncFiles($source, $target);
echo "Files synced successfully!";
?>
```

**Jalankan via cron job:**
```bash
*/5 * * * * cd /path/to/your/app && php sync-storage.php
```

### 2. Jika Permission Selalu Reset

**Buat script permission:**
```bash
#!/bin/bash
# fix-permissions.sh

chmod 755 storage/
chmod 755 storage/app/
chmod 755 storage/app/public/
chmod 755 public/storage/
chmod 755 public/images/

find storage/app/public/ -type f -exec chmod 644 {} \;
find public/storage/ -type f -exec chmod 644 {} \;
find public/images/ -type f -exec chmod 644 {} \;

echo "Permissions fixed!"
```

### 3. Jika Gambar Corrupt/Tidak Load

**Check file integrity:**
```bash
# Check if files are readable
file public/images/logo.png
file storage/app/public/products/*.jpg

# Check file sizes
du -sh public/images/*
du -sh storage/app/public/products/*
```

---

## Prevention Tips

### 1. Monitoring Script
```php
// monitor-images.php
<?php
$checks = [
    'Storage symlink' => is_link('public/storage'),
    'Images folder' => is_dir('public/images'),
    'Storage folder' => is_dir('storage/app/public'),
    'Logo exists' => file_exists('public/images/logo.png'),
];

foreach ($checks as $check => $status) {
    echo $check . ': ' . ($status ? 'OK' : 'FAIL') . "\n";
}
?>
```

### 2. Automated Backup
```bash
#!/bin/bash
# backup-images.sh

DATE=$(date +%Y%m%d_%H%M%S)
tar -czf "images_backup_$DATE.tar.gz" public/images/ storage/app/public/
echo "Backup created: images_backup_$DATE.tar.gz"
```

### 3. Health Check Endpoint
```php
// routes/web.php
Route::get('/health/images', function () {
    $checks = [
        'storage_link' => is_link(public_path('storage')),
        'images_folder' => is_dir(public_path('images')),
        'logo_exists' => file_exists(public_path('images/logo.png')),
    ];
    
    return response()->json($checks);
});
```

---

## Contact Support

Jika semua solusi di atas tidak berhasil:

1. **Check hosting documentation** untuk Laravel deployment
2. **Contact hosting support** dengan informasi:
   - Laravel version
   - PHP version
   - Error messages
   - Server configuration
3. **Provide access** untuk debugging jika diperlukan

---

**Remember**: Selalu backup files sebelum melakukan perubahan pada server production!