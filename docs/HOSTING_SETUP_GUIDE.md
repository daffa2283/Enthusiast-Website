# Panduan Setup Hosting untuk EnthusiastVerse E-commerce

## Masalah Gambar Tidak Muncul Setelah Hosting

Jika gambar tidak muncul setelah hosting (muncul tanda tanya), ikuti langkah-langkah berikut:

## 1. Update Konfigurasi Environment

### Update file `.env`:
```env
APP_URL=https://yourdomain.com  # Ganti dengan domain hosting Anda
APP_ENV=production
APP_DEBUG=false
```

## 2. Setup Storage Symlink

### Metode 1: Menggunakan Artisan (Recommended)
```bash
php artisan storage:link
```

### Metode 2: Jika Artisan tidak tersedia
Jalankan script setup yang sudah disediakan:
```bash
php setup-hosting-images.php
```

### Metode 3: Manual
Jika kedua metode di atas tidak berhasil:
1. Buat folder `storage` di dalam folder `public`
2. Copy semua file dari `storage/app/public/` ke `public/storage/`

## 3. Set Permission Folder

Pastikan permission folder berikut:
```bash
chmod 755 storage/
chmod 755 storage/app/
chmod 755 storage/app/public/
chmod 755 public/storage/
chmod 644 storage/app/public/*
chmod 644 public/storage/*
```

## 4. Clear dan Cache Ulang

```bash
# Clear cache
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Cache ulang untuk production
php artisan config:cache
php artisan route:cache
```

## 5. Struktur Folder yang Benar

Pastikan struktur folder seperti ini:
```
public/
├── images/
│   ├── logo.png
│   ├── MOCKUP DEPAN.jpeg.jpg
│   ├── MOCKUP BELAKANG.jpeg.jpg
│   ├── no-image.png
│   └── no-payment-proof.svg
├── storage/ (symlink ke ../storage/app/public/)
│   ├── products/
│   └── payment_proofs/
└── .htaccess

storage/
└── app/
    └── public/
        ├── products/
        └── payment_proofs/
```

## 6. Troubleshooting

### Jika gambar masih tidak muncul:

1. **Cek URL gambar di browser**
   - Buka developer tools (F12)
   - Lihat tab Network untuk melihat error 404 pada gambar
   - Pastikan URL mengarah ke path yang benar

2. **Cek permission file**
   ```bash
   ls -la public/storage/
   ls -la storage/app/public/
   ```

3. **Cek apakah symlink berhasil**
   ```bash
   ls -la public/storage
   ```
   Seharusnya menunjukkan: `storage -> ../storage/app/public`

4. **Test akses langsung**
   Coba akses gambar langsung di browser:
   - `https://yourdomain.com/storage/products/namafile.jpg`
   - `https://yourdomain.com/images/logo.png`

## 7. Fitur ImageHelper

Aplikasi ini menggunakan `ImageHelper` untuk menangani gambar dengan fallback otomatis:

```php
// Untuk gambar produk
\App\Helpers\ImageHelper::getProductImageUrl($imagePath)

// Untuk bukti pembayaran
\App\Helpers\ImageHelper::getPaymentProofUrl($imagePath)

// General image URL
\App\Helpers\ImageHelper::getImageUrl($imagePath, $fallback)
```

## 8. Gambar Fallback

Jika gambar tidak ditemukan, sistem akan otomatis menggunakan gambar fallback:
- Produk: `images/MOCKUP DEPAN.jpeg.jpg`
- Bukti pembayaran: `images/no-payment-proof.svg`
- General: `images/no-image.png`

## 9. Hosting Provider Specific

### Shared Hosting:
- Pastikan PHP version >= 8.1
- Aktifkan extension: GD, fileinfo
- Set memory_limit minimal 256M

### VPS/Dedicated:
- Install Nginx/Apache dengan konfigurasi Laravel
- Set document root ke folder `public`
- Aktifkan mod_rewrite (Apache) atau rewrite rules (Nginx)

## 10. File .htaccess untuk Storage

File `.htaccess` sudah dibuat otomatis di `public/storage/` dengan konfigurasi:
- Allow akses ke file gambar
- Set MIME types yang benar
- Enable compression untuk gambar
- Prevent akses ke file PHP

## 11. Monitoring dan Maintenance

### Cek rutin:
1. Storage space untuk folder `storage/app/public/`
2. Permission folder setelah update
3. Backup gambar secara berkala
4. Monitor error logs untuk masalah gambar

### Log errors:
Cek file log di `storage/logs/laravel.log` untuk error terkait gambar.

## 12. Performance Optimization

1. **Image Compression**: Gunakan tools seperti TinyPNG sebelum upload
2. **WebP Format**: Convert gambar ke WebP untuk ukuran lebih kecil
3. **CDN**: Pertimbangkan menggunakan CDN untuk gambar
4. **Lazy Loading**: Sudah diimplementasi dengan `loading="lazy"`

## Kontak Support

Jika masih mengalami masalah, pastikan:
1. Domain sudah pointing dengan benar
2. SSL certificate sudah aktif
3. File permission sudah benar
4. Storage symlink sudah dibuat

---

**Catatan**: Selalu backup data sebelum melakukan perubahan pada server production.