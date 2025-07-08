# Stock Management Documentation

## Overview
This document describes how the application handles product stock display for different user types and pages.

## Stock Display Rules

### Home Page (`/`)
- **Rule**: Only show products that are **in stock** (stock > 0)
- **Reasoning**: Home page should showcase available products to encourage purchases
- **Implementation**: Uses `Product::active()->inStock()` scope
- **Sorting**: Newest products first

### Products Page (`/products`)
- **Rule**: Show all active products, but **out-of-stock products appear at the bottom**
- **Reasoning**: Users should see all products but prioritize available ones
- **Implementation**: Uses `orderByRaw('CASE WHEN stock > 0 THEN 0 ELSE 1 END')` 
- **Sorting**: In-stock products first, then by creation date (newest first)

### Search Results (`/search`)
- **Rule**: Show all matching products, but **prioritize in-stock products**
- **Implementation**: Same ordering as products page
- **Sorting**: In-stock products first, then by creation date

### Search Suggestions (AJAX)
- **Rule**: Prioritize in-stock products in suggestions
- **Implementation**: Same ordering logic
- **Limit**: Top 5 results

## Visual Indicators

### In-Stock Products
- Normal appearance
- Functional "Add to Cart" button
- Full opacity and color

### Low Stock Products (1-5 items)
- Orange badge: "Only X left!"
- Normal functionality
- Encourages urgency

### Out-of-Stock Products
- Red badge: "Out of Stock"
- Grayed out appearance (70% opacity, 20% grayscale)
- Disabled "Out of Stock" button
- Reduced hover effects

## Technical Implementation

### Database Scopes
```php
// In Product model
public function scopeActive($query)
{
    return $query->where('is_active', true);
}

public function scopeInStock($query)
{
    return $query->where('stock', '>', 0);
}
```

### Controller Logic
```php
// Home page - only in-stock products
$products = Product::active()->inStock()->orderBy('created_at', 'desc')->get();

// Products page - all products, out-of-stock at bottom
$products = $productsQuery->orderByRaw('CASE WHEN stock > 0 THEN 0 ELSE 1 END')
                         ->orderBy('created_at', 'desc')
                         ->get();
```

### CSS Classes
```css
/* Out of stock product styling */
.product-card.out-of-stock-card {
    opacity: 0.7;
    filter: grayscale(20%);
}

.product-card.out-of-stock-card:hover {
    opacity: 0.85;
    transform: translateY(-5px);
}
```

## User Experience Benefits

1. **Home Page**: Clean, focused display of available products
2. **Products Page**: Complete catalog visibility with clear stock status
3. **Visual Hierarchy**: In-stock products are visually prominent
4. **Clear Indicators**: Users immediately know product availability
5. **Consistent Ordering**: Predictable product arrangement across pages

## Admin Panel Integration

- Products can be marked as active/inactive via admin panel
- Stock levels are managed through admin interface
- Out-of-stock products remain visible to admins for management
- Stock badges automatically update based on current stock levels

## Future Enhancements

1. **Stock Notifications**: Email alerts when products go out of stock
2. **Restock Notifications**: Allow users to request notifications when items are back in stock
3. **Inventory Tracking**: More detailed stock management features
4. **Bulk Stock Updates**: Admin tools for managing multiple product stocks

## Testing Scenarios

1. **Home Page**: Verify only in-stock products appear
2. **Products Page**: Verify out-of-stock products appear at bottom
3. **Search**: Verify in-stock products appear first in results
4. **Visual Indicators**: Verify stock badges and styling work correctly
5. **Admin Panel**: Verify stock changes reflect immediately on frontend