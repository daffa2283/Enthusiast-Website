#!/bin/bash
echo "=== HOSTING SETUP SCRIPT ==="
echo "Run this script on your hosting server after uploading files"
echo ""

echo "1. Setting up storage link..."
php artisan storage:link

echo "2. Setting permissions..."
chmod -R 755 storage/
chmod -R 755 public/storage/
chmod -R 644 storage/app/public/products/*
chmod -R 644 storage/app/public/payment_proofs/*

echo "3. Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "4. Testing image access..."
if [ -f "public/storage/products" ]; then
    echo "✅ Product images accessible"
else
    echo "❌ Product images not accessible"
fi

if [ -f "public/storage/payment_proofs" ]; then
    echo "✅ Payment proof images accessible"
else
    echo "❌ Payment proof images not accessible"
fi

echo ""
echo "Setup complete! Test your website images now."
