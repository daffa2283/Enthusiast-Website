# EnthusiastVerse E-commerce

Modern e-commerce platform built with Laravel 11, featuring a clean customer interface and powerful admin dashboard.

## 🚀 Features

### Customer Features
- **Product Catalog**: Browse products with categories, search, and filters
- **Shopping Cart**: Add/remove items with real-time updates
- **Secure Checkout**: Multiple payment methods with proof upload
- **Order Tracking**: Real-time order status updates
- **Responsive Design**: Mobile-friendly interface

### Admin Features
- **Dashboard**: Comprehensive analytics and overview
- **Product Management**: CRUD operations with image upload
- **Order Management**: Process orders, confirm payments
- **User Management**: Customer and admin account management
- **Payment Verification**: Review and approve payment proofs

## 🛠️ Tech Stack

- **Backend**: Laravel 11
- **Frontend**: Blade Templates, CSS3, JavaScript
- **Admin Panel**: Filament PHP
- **Database**: MySQL
- **File Storage**: Laravel Storage with symlink support
- **Authentication**: Laravel Breeze + Custom Admin Auth

## 📁 Project Structure

```
EnthusiastVerse-E-commerce/
├── app/                    # Application logic
│   ├── Filament/          # Admin panel resources
│   ├── Helpers/           # Helper classes (ImageHelper)
│   ├── Http/              # Controllers, middleware
│   └── Models/            # Eloquent models
├── config/                # Configuration files
├── database/              # Migrations, seeders
├── docs/                  # 📚 Documentation
├── public/                # Public assets
│   ├── images/           # Static images & fallbacks
│   └── storage/          # Symlink to storage/app/public
├── resources/             # Views, assets
├── routes/                # Route definitions
├── scripts/               # 🔧 Utility scripts
├── storage/               # File storage
└── tests/                 # Test files
```

## 🚀 Quick Start

### Prerequisites
- PHP 8.1+
- Composer
- MySQL
- Node.js & NPM

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd EnthusiastVerse-E-commerce
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Storage setup**
   ```bash
   php artisan storage:link
   ```

6. **Start development server**
   ```bash
   php artisan serve
   npm run dev
   ```

## 📚 Documentation

Comprehensive documentation is available in the `/docs` folder:

- **[Solution Summary](docs/SOLUTION_SUMMARY.md)** - Complete overview of image handling solution
- **[Hosting Setup Guide](docs/HOSTING_SETUP_GUIDE.md)** - Step-by-step hosting deployment
- **[Image Troubleshooting](docs/IMAGE_TROUBLESHOOTING.md)** - Detailed troubleshooting guide
- **[Admin Dashboard Fix](docs/ADMIN_DASHBOARD_FIXED.md)** - Admin image handling solution
- **[Session Separation](docs/SESSION_SEPARATION_SOLUTION.md)** - Customer/Admin session isolation
- **[Admin Auth Separation](docs/ADMIN_AUTH_SEPARATION_SOLUTION.md)** - Authentication system details

## 🔧 Utility Scripts

The `/scripts` folder contains helpful utilities:

- **`final-image-fix.php`** - Comprehensive image setup for hosting
- **`setup-hosting-images.php`** - Basic image setup script
- **`admin-image-verification.php`** - Verify admin dashboard images
- **`setup-hosting.php`** - General hosting setup

## 🌐 Deployment

### For Hosting Deployment

1. **Upload files to hosting**
2. **Update environment**
   ```bash
   # Update .env
   APP_URL=https://yourdomain.com
   APP_ENV=production
   APP_DEBUG=false
   ```

3. **Run setup script**
   ```bash
   php scripts/final-image-fix.php
   ```

4. **Cache configuration**
   ```bash
   php artisan config:cache
   php artisan route:cache
   ```

### Image Handling

This project includes a robust image handling system that works across all hosting environments:

- **Automatic fallbacks** for missing images
- **Cross-platform compatibility** (shared hosting, VPS, cloud)
- **Storage symlink** with manual copy fallback
- **Optimized performance** with lazy loading

## 🔐 Admin Access

- **URL**: `/admin`
- **Default Admin**: Create via `php artisan make:filament-user`

## 🛡️ Security Features

- **Separate authentication** for customers and admins
- **Session isolation** between user types
- **CSRF protection** on all forms
- **Input validation** and sanitization
- **Secure file uploads** with type validation

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## 🆘 Support

If you encounter any issues:

1. Check the [troubleshooting guide](docs/IMAGE_TROUBLESHOOTING.md)
2. Review the [documentation](docs/)
3. Run the verification scripts in `/scripts`
4. Create an issue with detailed information

## 🎯 Key Features Highlights

### Image Handling System
- **Universal compatibility** across hosting providers
- **Automatic fallback** images for better UX
- **Performance optimized** with lazy loading
- **Easy maintenance** with centralized helper class

### Admin Dashboard
- **Modern interface** with Filament PHP
- **Real-time updates** for orders and payments
- **Bulk operations** for efficient management
- **Comprehensive filtering** and search

### Customer Experience
- **Intuitive navigation** and product discovery
- **Seamless checkout** process
- **Order tracking** with status updates
- **Mobile-responsive** design

---

**Built with ❤️ for modern e-commerce needs**