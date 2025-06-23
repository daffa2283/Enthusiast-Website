# 🛍️ EnthusiastVerse - E-Commerce Platform

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.1+-blue?style=for-the-badge&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/Filament-3.0-orange?style=for-the-badge" alt="Filament">
  <img src="https://img.shields.io/badge/MySQL-8.0-blue?style=for-the-badge&logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/Vite-5.0-purple?style=for-the-badge&logo=vite" alt="Vite">
</p>

<p align="center">
  <strong>Modern E-Commerce Platform built with Laravel & Filament Admin Panel</strong>
</p>

---

## 📋 Table of Contents

- [About](#about)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Usage](#usage)
- [Admin Panel](#admin-panel)
- [Database Structure](#database-structure)
- [API Documentation](#api-documentation)
- [Security](#security)
- [Contributing](#contributing)
- [License](#license)

---

## 🎯 About

**EnthusiastVerse** adalah platform e-commerce modern yang dibangun menggunakan Laravel 10 dengan admin panel yang powerful menggunakan Filament v3. Platform ini dirancang untuk memberikan pengalaman berbelanja online yang seamless dengan fitur manajemen yang komprehensif.

### 🌟 Key Highlights

- **Modern UI/UX**: Interface yang clean dan responsive
- **Advanced Admin Panel**: Manajemen lengkap dengan Filament v3
- **Security First**: Sistem keamanan berlapis dengan monitoring
- **Scalable Architecture**: Struktur yang dapat berkembang
- **Real-time Features**: Update real-time untuk inventory dan orders

---

## ✨ Features

### 🛒 Customer Features
- **Product Catalog**: Browse produk dengan kategori dan filter
- **Advanced Search**: Pencarian produk dengan suggestions
- **Shopping Cart**: Keranjang belanja dengan session management
- **Checkout Process**: Proses checkout yang streamlined
- **Order Tracking**: Lacak status pesanan real-time
- **Responsive Design**: Optimal di semua device

### 👨‍💼 Admin Features
- **Dashboard Analytics**: Overview statistik dan grafik
- **Product Management**: CRUD produk dengan image upload
- **Category Management**: Organisasi kategori produk
- **Order Management**: Kelola pesanan dan status
- **Inventory Tracking**: Monitor stok dan low stock alerts
- **User Management**: Manajemen pengguna dan roles

### 🛡️ Security Features
- **Satpam System**: Sistem monitoring keamanan khusus
- **Activity Logging**: Log semua aktivitas sistem
- **Access Control**: Kontrol akses berlapis
- **Security Monitoring**: Real-time security monitoring
- **Incident Reporting**: Sistem pelaporan keamanan

---

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 10.x
- **PHP**: 8.1+
- **Database**: MySQL 8.0
- **Admin Panel**: Filament v3
- **Authentication**: Laravel Sanctum

### Frontend
- **Build Tool**: Vite 5.0
- **CSS Framework**: Tailwind CSS
- **JavaScript**: Vanilla JS + Alpine.js
- **Icons**: Heroicons

### Development Tools
- **Package Manager**: Composer & NPM
- **Code Quality**: Laravel Pint
- **Testing**: PHPUnit
- **Version Control**: Git

---

## 🚀 Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js & NPM
- MySQL 8.0
- Git

### Step-by-Step Installation

1. **Clone Repository**
   ```bash
   git clone https://github.com/yourusername/enthusias.git
   cd enthusias
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install Node Dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Configuration**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=enthusias
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Database Migration & Seeding**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Storage Link**
   ```bash
   php artisan storage:link
   ```

8. **Build Assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

9. **Create Admin User**
   ```bash
   php artisan make:filament-user
   ```

10. **Start Development Server**
    ```bash
    php artisan serve
    ```

---

## 🎮 Usage

### Customer Interface
- **Homepage**: `http://localhost:8000`
- **Products**: `http://localhost:8000/products`
- **Cart**: `http://localhost:8000/cart`
- **Checkout**: `http://localhost:8000/checkout`

### Admin Panel
- **Admin Dashboard**: `http://localhost:8000/admin`
- **Login**: Use credentials created with `make:filament-user`

### Default Test Accounts
```
Admin:
Email: admin@enthusias.com
Password: password

Customer:
Email: customer@enthusias.com
Password: password
```

---

## 🎛️ Admin Panel

### Dashboard Features
- **📊 Statistics Overview**: 6 key metrics widgets
- **📈 Orders Chart**: Monthly orders and revenue trends
- **🔔 Notifications**: Real-time alerts and updates

### Management Modules

#### 📦 Product Management
- CRUD operations with image upload
- Stock management and low stock alerts
- Bulk actions (activate/deactivate)
- Advanced filtering and search
- Category assignment

#### 🏷️ Category Management
- Category organization with images
- Auto-slug generation
- Hierarchical structure support
- Bulk operations

#### 🛍️ Order Management
- Complete order lifecycle tracking
- Status updates with notifications
- Order items management
- Customer information
- Payment status tracking

#### 👥 User Management
- Customer account management
- Admin role assignment
- Activity monitoring

---

## 🗄️ Database Structure

### Core Tables

#### Users
```sql
- id, name, email, password
- email_verified_at, remember_token
- created_at, updated_at
```

#### Products
```sql
- id, name, description, price
- image, category, stock, is_active
- size, color, created_at, updated_at
```

#### Orders
```sql
- id, order_number, user_id
- customer_name, customer_email, customer_phone
- shipping_address, subtotal, shipping_cost, total
- status, payment_status, payment_method
- notes, created_at, updated_at
```

#### Order Items
```sql
- id, order_id, product_id
- quantity, price, total
- created_at, updated_at
```

### Security Tables

#### Security Logs
```sql
- id, satpam_id, activity_type
- description, ip_address, user_agent
- metadata, created_at
```

#### System Monitor
```sql
- id, component, status, details
- checked_at, created_at, updated_at
```

---

## 📚 API Documentation

### Public Endpoints
```
GET /api/products - List all products
GET /api/products/{id} - Get product details
GET /api/categories - List categories
GET /api/search - Search products
```

### Authenticated Endpoints
```
POST /api/cart/add - Add to cart
GET /api/cart - Get cart items
POST /api/orders - Create order
GET /api/orders/{id} - Get order details
```

### Admin Endpoints
```
GET /api/admin/dashboard - Dashboard stats
GET /api/admin/orders - Manage orders
POST /api/admin/products - Create product
PUT /api/admin/products/{id} - Update product
```

---

## 🔒 Security

### Security Measures
- **CSRF Protection**: All forms protected
- **SQL Injection Prevention**: Eloquent ORM
- **XSS Protection**: Input sanitization
- **Authentication**: Secure login system
- **Authorization**: Role-based access control

### Satpam Security System
- **Real-time Monitoring**: System health checks
- **Access Control**: User access validation
- **Incident Reporting**: Security incident tracking
- **Activity Logging**: Comprehensive audit trail

### Security Best Practices
- Regular security updates
- Strong password policies
- Session management
- File upload security
- Database encryption

---

## 🤝 Contributing

We welcome contributions! Please follow these steps:

1. **Fork the Repository**
2. **Create Feature Branch**
   ```bash
   git checkout -b feature/amazing-feature
   ```
3. **Commit Changes**
   ```bash
   git commit -m 'Add amazing feature'
   ```
4. **Push to Branch**
   ```bash
   git push origin feature/amazing-feature
   ```
5. **Open Pull Request**

### Development Guidelines
- Follow PSR-12 coding standards
- Write tests for new features
- Update documentation
- Use meaningful commit messages

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 🙏 Acknowledgments

- **Laravel Team** - Amazing framework
- **Filament Team** - Powerful admin panel
- **Tailwind CSS** - Beautiful styling
- **Community Contributors** - Valuable feedback

---

## 📞 Support

- **Documentation**: [Wiki](https://github.com/yourusername/enthusias/wiki)
- **Issues**: [GitHub Issues](https://github.com/yourusername/enthusias/issues)
- **Discussions**: [GitHub Discussions](https://github.com/yourusername/enthusias/discussions)
- **Email**: support@enthusias.com

---

## 🚀 Deployment

### Production Deployment
```bash
# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

### Environment Variables
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

---

<p align="center">
  <strong>Built with ❤️ by EnthusiastVerse Team</strong>
</p>

<p align="center">
  <a href="#top">⬆️ Back to Top</a>
</p>