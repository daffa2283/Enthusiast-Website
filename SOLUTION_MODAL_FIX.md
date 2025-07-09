# Solusi: Samakan Modal Add to Cart dengan Quick View Modal

## Masalah
Modal "Add to Cart" di halaman products tidak berfungsi dengan baik.

## Solusi
Ganti modal size selection dengan modal quick view yang sama seperti di halaman home.

## Perubahan yang Diperlukan

### 1. Ganti Panggilan Fungsi
Di file `resources/views/products.blade.php`, cari bagian ini:

```javascript
// Check if product has sizes
if (sizesText && sizesText.trim() !== '' && sizesText.trim() !== '-') {
    // Show size selection modal
    showSizeSelectionModal(productId, productName, sizesText);
} else {
    // Add to cart without size selection
    addToCartDirectly(productId, productName, '', '');
}
```

**Ganti dengan:**
```javascript
// Always show quick view modal for size and quantity selection
openQuickView(productId);
```

### 2. Hapus Fungsi yang Tidak Diperlukan
Hapus atau comment out fungsi-fungsi berikut:
- `showSizeSelectionModal()`
- `closeSizeSelectionModal()`
- `addToCartWithQuantity()` (jika ada)

### 3. Pastikan Quick View Modal Ada
Pastikan modal quick view sudah ada di halaman products (sudah ada di kode saat ini).

## Hasil
Setelah perubahan ini:
- ✅ Ketika user klik "Add to Cart" di halaman products, akan muncul modal quick view yang sama seperti di halaman home
- ✅ User bisa memilih size, color, dan quantity
- ✅ Modal akan berfungsi dengan baik karena menggunakan kode yang sudah teruji
- ✅ Produk akan masuk ke keranjang dengan notifikasi

## Keuntungan Solusi Ini
1. **Konsistensi**: Modal yang sama di semua halaman
2. **Reliability**: Menggunakan kode yang sudah berfungsi
3. **User Experience**: Interface yang familiar untuk user
4. **Maintenance**: Lebih mudah maintain karena hanya ada satu jenis modal