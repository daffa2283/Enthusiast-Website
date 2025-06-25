# Database Documentation - EnthusiastVerse E-commerce

## Database Structure

Database telah berhasil dibuat dengan struktur yang lengkap untuk aplikasi e-commerce. Berikut adalah detail dari setiap tabel:

### 1. Products Table
**Tabel utama untuk menyimpan data produk**

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Primary key |
| name | VARCHAR(255) | Nama produk |
| description | TEXT | Deskripsi produk |
| price | DECIMAL(10,2) | Harga produk |
| image | VARCHAR(255) | Path gambar produk |
| category | VARCHAR(255) | Kategori produk |
| stock | INTEGER | Jumlah stok |
| is_active | BOOLEAN | Status aktif produk |
| size | VARCHAR(255) | Ukuran tersedia (S,M,L,XL) |
| color | VARCHAR(255) | Warna produk |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 2. Categories Table
**Tabel untuk kategori produk**

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Primary key |
| name | VARCHAR(255) | Nama kategori |
| slug | VARCHAR(255) | URL slug (unique) |
| description | TEXT | Deskripsi kategori |
| image | VARCHAR(255) | Gambar kategori |
| is_active | BOOLEAN | Status aktif kategori |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 3. Cart Items Table
**Tabel untuk menyimpan item dalam keranjang belanja**

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Primary key |
| session_id | VARCHAR(255) | ID sesi untuk guest user |
| user_id | BIGINT (FK) | Foreign key ke users table |
| product_id | BIGINT (FK) | Foreign key ke products table |
| quantity | INTEGER | Jumlah item |
| price | DECIMAL(10,2) | Harga saat ditambahkan ke cart |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 4. Orders Table
**Tabel untuk menyimpan data pesanan**

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Primary key |
| order_number | VARCHAR(255) | Nomor pesanan (unique) |
| user_id | BIGINT (FK) | Foreign key ke users table |
| customer_name | VARCHAR(255) | Nama pelanggan |
| customer_email | VARCHAR(255) | Email pelanggan |
| customer_phone | VARCHAR(255) | Telepon pelanggan |
| shipping_address | TEXT | Alamat pengiriman |
| subtotal | DECIMAL(10,2) | Subtotal pesanan |
| shipping_cost | DECIMAL(10,2) | Biaya pengiriman |
| total | DECIMAL(10,2) | Total pesanan |
| status | ENUM | Status pesanan (pending, processing, shipped, delivered, cancelled) |
| payment_status | ENUM | Status pembayaran (pending, paid, failed, refunded) |
| payment_method | VARCHAR(255) | Metode pembayaran |
| notes | TEXT | Catatan pesanan |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 5. Order Items Table
**Tabel untuk detail item dalam pesanan**

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Primary key |
| order_id | BIGINT (FK) | Foreign key ke orders table |
| product_id | BIGINT (FK) | Foreign key ke products table |
| product_name | VARCHAR(255) | Nama produk saat pesanan |
| product_price | DECIMAL(10,2) | Harga produk saat pesanan |
| quantity | INTEGER | Jumlah item |
| total | DECIMAL(10,2) | Total harga item |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

## Models dan Relationships

### Product Model
- **Location**: `app/Models/Product.php`
- **Relationships**:
  - `hasMany(CartItem::class)` - Relasi ke cart items
  - `hasMany(OrderItem::class)` - Relasi ke order items
- **Scopes**:
  - `active()` - Produk yang aktif
  - `inStock()` - Produk yang masih ada stok
- **Accessors**:
  - `formatted_price` - Format harga dalam Rupiah
  - `image_url` - URL lengkap gambar

### Category Model
- **Location**: `app/Models/Category.php`
- **Features**:
  - Auto-generate slug dari nama
- **Scopes**:
  - `active()` - Kategori yang aktif

### CartItem Model
- **Location**: `app/Models/CartItem.php`
- **Relationships**:
  - `belongsTo(Product::class)` - Relasi ke produk
  - `belongsTo(User::class)` - Relasi ke user
- **Accessors**:
  - `total` - Total harga item (quantity × price)
  - `formatted_total` - Format total dalam Rupiah

### Order Model
- **Location**: `app/Models/Order.php`
- **Relationships**:
  - `belongsTo(User::class)` - Relasi ke user
  - `hasMany(OrderItem::class)` - Relasi ke order items
- **Features**:
  - Auto-generate nomor pesanan
- **Scopes**:
  - `pending()` - Pesanan pending
  - `completed()` - Pesanan selesai
- **Accessors**:
  - `formatted_total` - Format total dalam Rupiah
  - `formatted_subtotal` - Format subtotal dalam Rupiah
  - `formatted_shipping_cost` - Format biaya kirim dalam Rupiah

### OrderItem Model
- **Location**: `app/Models/OrderItem.php`
- **Relationships**:
  - `belongsTo(Order::class)` - Relasi ke pesanan
  - `belongsTo(Product::class)` - Relasi ke produk
- **Accessors**:
  - `formatted_product_price` - Format harga produk dalam Rupiah
  - `formatted_total` - Format total dalam Rupiah

## Sample Data

### Categories
1. **T-Shirts** - Comfortable and stylish t-shirts for everyday wear
2. **Hoodies** - Warm and cozy hoodies perfect for casual outings
3. **Sweatshirts** - Premium sweatshirts with modern designs
4. **Accessories** - Complete your look with our accessories collection

### Products
1. **Essential Crewneck** - Rp. 399.000 (Sweatshirt, Stock: 50)
2. **Premium Hoodie** - Rp. 599.000 (Hoodie, Stock: 30)
3. **Classic Tee** - Rp. 299.000 (T-shirt, Stock: 75)
4. **Street Hoodie** - Rp. 699.000 (Hoodie, Stock: 25)
5. **Vintage Crewneck** - Rp. 449.000 (Sweatshirt, Stock: 40)
6. **Oversized Hoodie** - Rp. 649.000 (Hoodie, Stock: 35)

## Database Commands

### Migration Commands
```bash
# Menjalankan migration
php artisan migrate

# Rollback migration
php artisan migrate:rollback

# Reset dan jalankan ulang migration
php artisan migrate:fresh
```

### Seeder Commands
```bash
# Menjalankan seeder
php artisan db:seed

# Menjalankan seeder spesifik
php artisan db:seed --class=ProductSeeder
php artisan db:seed --class=CategorySeeder

# Reset database dan jalankan seeder
php artisan migrate:fresh --seed
```

## Controller Integration

### HomeController Updates
- **index()** - Mengambil 4 produk featured untuk homepage
- **products()** - Mengambil semua produk aktif dan kategori
- **addToCart()** - Validasi stok dan menambah ke cart dengan data dari database
- **removeFromCart()** - Menghapus item dari cart

### Features Implemented
1. **Stock Management** - Validasi stok saat menambah ke cart
2. **Price Formatting** - Format harga otomatis dalam Rupiah
3. **Image Handling** - Path gambar yang benar
4. **Cart Session** - Manajemen cart menggunakan session
5. **Database Integration** - Semua data produk dari database

## Next Steps

### Recommended Enhancements
1. **User Authentication** - Sistem login/register
2. **Persistent Cart** - Simpan cart ke database untuk user login
3. **Order Management** - Sistem checkout dan manajemen pesanan
4. **Admin Panel** - Interface untuk mengelola produk dan pesanan
5. **Payment Integration** - Integrasi dengan payment gateway
6. **Search & Filter** - Fitur pencarian dan filter produk
7. **Product Reviews** - Sistem review dan rating produk
8. **Inventory Management** - Manajemen stok yang lebih advanced

---

**Status: ✅ Database Complete**
Database telah berhasil dibuat dan terintegrasi dengan aplikasi Laravel. Semua tabel, model, dan relationship sudah berfungsi dengan baik.