-- Insert HOODIE ENTHUSIAST THEY ALL HATE US product
-- Migration sudah dijalankan, kolom back_image sudah tersedia

INSERT INTO `products` (`name`, `description`, `price`, `stock`, `category`, `size`, `color`, `is_active`, `image`, `back_image`, `updated_at`, `created_at`) 
VALUES ('HOODIE ENTHUSIAST THEY ALL HATE US', 'Using Materials Cotton Fleece 330 GSM', 399000, 36, 'hoodie', 'M,L,XL', 'Black', 1, 'products/LefI2XEQ9k38UrXH1B12QpJLlLxDTF-metaTU9DS1VQIERFUEFOIEhPT0RJRSBWNC5qcGVnLmpwZw==-.jpg', 'products/sKNs67YFhtGS3wACHzwPFz5gbbHGy3-metaTU9DS1VQIEJFTEFLQU5HIEhPT0RJRSBWNC5qcGVnLmpwZw==-.jpg', NOW(), NOW());