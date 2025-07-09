# Fix untuk Modal Add to Cart

## Masalah
Modal size selection tidak berfungsi karena fungsi `addToCartWithQuantity` tidak didefinisikan.

## Solusi
Ganti panggilan fungsi `addToCartWithQuantity(productId, productName, selectedSize, '', quantity);` dengan kode berikut:

```javascript
// Add to cart with selected size and quantity
const button = document.querySelector(`[data-product-id="${productId}"]`);
if (button) {
    button.classList.add('loading');
}

fetch('{{ route("cart.add") }}', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({
        product_id: productId,
        quantity: quantity,
        size: selectedSize,
        color: ''
    })
})
.then(response => response.json())
.then(data => {
    if (button) {
        button.classList.remove('loading');
    }
    
    if (data.success) {
        // Update cart counter with animation
        const cartCounter = document.querySelector('.cart-counter');
        if (cartCounter) {
            cartCounter.textContent = data.cart_count;
            cartCounter.classList.add('updated');
            setTimeout(() => cartCounter.classList.remove('updated'), 600);
        }
        
        // Show success toast
        showToast('success', 'Added to Cart!', `${productName} (Size: ${selectedSize}) has been added to your cart.`);
    } else {
        showToast('error', 'Error!', data.message || 'Failed to add product to cart.');
    }
})
.catch(error => {
    console.error('Error:', error);
    if (button) {
        button.classList.remove('loading');
    }
    showToast('error', 'Error!', 'Something went wrong. Please try again.');
});
```

## Lokasi
File: `resources/views/products.blade.php`
Baris: Sekitar baris yang berisi `addToCartWithQuantity(productId, productName, selectedSize, '', quantity);`

## Cara Menerapkan
1. Buka file `resources/views/products.blade.php`
2. Cari baris yang berisi `addToCartWithQuantity(productId, productName, selectedSize, '', quantity);`
3. Ganti baris tersebut dengan kode di atas
4. Simpan file

Setelah perubahan ini, modal add to cart akan berfungsi dengan baik dan produk akan masuk ke keranjang dengan notifikasi yang muncul.