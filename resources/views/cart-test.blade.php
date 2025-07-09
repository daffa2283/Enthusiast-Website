<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cart Count Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .status {
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            font-weight: bold;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }
        button:hover {
            background: #0056b3;
        }
        .cart-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cart Count Endpoint Test</h1>
        <p>This page tests the <code>/cart/count</code> endpoint functionality.</p>
        
        <div class="cart-info">
            <h3>Current Cart Status:</h3>
            <p><strong>Cart Count:</strong> <span id="cartCount">Loading...</span></p>
            <p><strong>Session Cart Count:</strong> {{ session('cart_count', 0) }}</p>
            <p><strong>Cart Items:</strong> {{ count(session('cart', [])) }} unique items</p>
        </div>
        
        <div>
            <button onclick="testCartCount()">Test Cart Count Endpoint</button>
            <button onclick="clearCart()">Clear Cart</button>
            <button onclick="addTestItem()">Add Test Item</button>
        </div>
        
        <div id="results"></div>
        
        <div class="info">
            <h4>Endpoint Information:</h4>
            <p><strong>URL:</strong> {{ route('cart.count') }}</p>
            <p><strong>Method:</strong> GET</p>
            <p><strong>Authentication:</strong> Not required</p>
        </div>
    </div>

    <script>
        function showResult(message, type = 'info') {
            const results = document.getElementById('results');
            const div = document.createElement('div');
            div.className = `status ${type}`;
            div.innerHTML = message;
            results.appendChild(div);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                div.remove();
            }, 5000);
        }
        
        function testCartCount() {
            showResult('Testing cart count endpoint...', 'info');
            
            fetch('{{ route("cart.count") }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('cartCount').textContent = data.count;
                    showResult(`✅ Success! Cart count: ${data.count}`, 'success');
                })
                .catch(error => {
                    document.getElementById('cartCount').textContent = 'Error';
                    showResult(`❌ Error: ${error.message}`, 'error');
                });
        }
        
        function clearCart() {
            // Clear session cart by making a request to remove all items
            fetch('/cart/clear', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(() => {
                showResult('Cart cleared (session reset)', 'info');
                testCartCount();
                setTimeout(() => location.reload(), 1000);
            })
            .catch(error => {
                showResult(`Error clearing cart: ${error.message}`, 'error');
            });
        }
        
        function addTestItem() {
            @auth
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: 1,
                    quantity: 1,
                    size: 'M',
                    color: 'Black'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showResult(`✅ Test item added! New cart count: ${data.cart_count}`, 'success');
                    testCartCount();
                } else {
                    showResult(`❌ Failed to add item: ${data.message}`, 'error');
                }
            })
            .catch(error => {
                showResult(`❌ Error adding item: ${error.message}`, 'error');
            });
            @else
            showResult('❌ You must be logged in to add items to cart', 'error');
            @endauth
        }
        
        // Test on page load
        document.addEventListener('DOMContentLoaded', function() {
            testCartCount();
        });
    </script>
</body>
</html>