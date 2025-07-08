# Admin System Documentation

## Overview
This system implements role-based access control to separate admin users from regular customers. Admin users have exclusive access to the admin panel, while regular users can only access the customer dashboard.

## Features

### 1. Role-Based Authentication
- **Admin Role**: Can access admin panel (`/admin`)
- **User Role**: Can access customer dashboard (`/dashboard`)

### 2. Admin Panel Access
- URL: `/admin`
- Only users with `role = 'admin'` can access
- Protected by `AdminMiddleware`
- Uses Filament admin panel

### 3. Customer Dashboard
- URL: `/dashboard`
- Only users with `role = 'user'` can access
- Admin users are redirected to admin panel

## Default Admin Account

**Email**: `admin@enthusiastverse.com`  
**Password**: `admin123456`  
**Role**: `admin`

> **Important**: Change the default password after first login!

## Creating Additional Admin Users

### Method 1: Using Artisan Command
```bash
php artisan admin:create
```

Or with parameters:
```bash
php artisan admin:create --name="Admin Name" --email="admin@example.com" --password="securepassword"
```

### Method 2: Using Database Seeder
```bash
php artisan db:seed --class=AdminUserSeeder
```

### Method 3: Manual Database Entry
```sql
INSERT INTO users (name, email, password, role, email_verified_at, created_at, updated_at) 
VALUES ('Admin Name', 'admin@example.com', '$2y$10$...', 'admin', NOW(), NOW(), NOW());
```

## Security Features

### 1. AdminMiddleware
- Checks if user is authenticated
- Verifies user has admin role
- Returns 403 error for unauthorized access

### 2. Role Validation
- User model includes `isAdmin()` and `isUser()` helper methods
- Navigation shows different links based on role
- Dashboard controller redirects admin users to admin panel

### 3. Access Control
- Admin panel: Only admin users
- Customer dashboard: Only regular users
- Automatic redirection based on role

## File Structure

```
app/
├── Console/Commands/
│   └── CreateAdminUser.php          # Command to create admin users
├── Http/
│   ├── Controllers/
│   │   └── DashboardController.php  # Customer dashboard (with admin redirect)
│   └── Middleware/
│       └── AdminMiddleware.php      # Admin access control
├── Models/
│   └── User.php                     # User model with role methods
└── Providers/Filament/
    └── AdminPanelProvider.php       # Filament admin panel config

database/
├── migrations/
│   └── 2025_07_08_113126_add_role_to_users_table.php
└── seeders/
    ├── AdminUserSeeder.php          # Creates default admin user
    └── DatabaseSeeder.php           # Includes admin seeder

resources/views/
└── partials/
    └── header.blade.php             # Navigation with role-based links
```

## Usage Examples

### Check User Role in Blade Templates
```blade
@if(auth()->user()->isAdmin())
    <a href="/admin">Admin Panel</a>
@else
    <a href="/dashboard">Dashboard</a>
@endif
```

### Check User Role in Controllers
```php
if (auth()->user()->isAdmin()) {
    // Admin logic
} else {
    // User logic
}
```

### Protect Routes with Middleware
```php
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin-only', 'AdminController@index');
});
```

## Troubleshooting

### Admin Can't Access Admin Panel
1. Check if user has `role = 'admin'` in database
2. Verify AdminMiddleware is properly registered
3. Clear cache: `php artisan cache:clear`

### Regular User Sees Admin Links
1. Check blade template conditions
2. Verify user role in database
3. Clear view cache: `php artisan view:clear`

### Migration Issues
```bash
php artisan migrate:refresh --seed
```

## Security Best Practices

1. **Change Default Password**: Always change the default admin password
2. **Use Strong Passwords**: Minimum 12 characters with mixed case, numbers, and symbols
3. **Limit Admin Users**: Only create admin accounts when necessary
4. **Regular Audits**: Periodically review admin user list
5. **Environment Variables**: Store sensitive data in `.env` file

## Database Schema

### Users Table
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

## Support

For issues or questions about the admin system:
1. Check this documentation
2. Review error logs in `storage/logs/`
3. Verify database schema and data
4. Test with fresh migration and seeding