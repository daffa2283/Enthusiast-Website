@extends('layouts.app')

@section('title', 'Order Details - Admin')

@push('styles')
<style>
.admin-container {
    margin-top: 100px;
    padding: 2rem 1rem;
    min-height: 70vh;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.admin-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.admin-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a1a1a;
}

.order-details-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
    flex-wrap: wrap;
    gap: 1rem;
}

.order-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--accent-color);
}

.order-status {
    padding: 0.6rem 1.2rem;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-pending {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: white;
}

.status-paid {
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
}

.status-processing {
    background: linear-gradient(135deg, #3B82F6, #2563EB);
    color: white;
}

.order-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.info-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 12px;
    border-left: 4px solid var(--accent-color);
}

.info-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-item {
    margin-bottom: 0.75rem;
}

.info-label {
    font-weight: 600;
    color: #666;
    font-size: 0.9rem;
    display: block;
    margin-bottom: 0.25rem;
}

.info-value {
    color: #1a1a1a;
    font-size: 1rem;
}

.payment-proof-section {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.section-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.payment-proof-container {
    display: flex;
    gap: 2rem;
    align-items: flex-start;
    flex-wrap: wrap;
}

.payment-proof-image {
    flex: 1;
    min-width: 300px;
    max-width: 500px;
}

.payment-proof-image img {
    width: 100%;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border: 2px solid #e9ecef;
}

.payment-proof-actions {
    flex: 1;
    min-width: 250px;
}

.no-payment-proof {
    text-align: center;
    padding: 3rem;
    color: #666;
    background: #f8f9fa;
    border-radius: 12px;
    border: 2px dashed #ddd;
}

.no-proof-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 1rem;
    background: #e9ecef;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #999;
}

.order-items-section {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.order-item {
    display: flex;
    align-items: center;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 12px;
    margin-bottom: 1rem;
    border: 1px solid #e9ecef;
}

.order-item:last-child {
    margin-bottom: 0;
}

.item-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 1.5rem;
    flex-shrink: 0;
}

.item-details {
    flex: 1;
}

.item-name {
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    font-size: 1rem;
}

.item-attributes {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    flex-wrap: wrap;
}

.attribute-badge {
    padding: 0.2rem 0.6rem;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 500;
    border: 1px solid;
}

.size-badge {
    background: #e3f2fd;
    color: #1565c0;
    border-color: #90caf9;
}

.color-badge {
    background: #f3e5f5;
    color: #7b1fa2;
    border-color: #ce93d8;
}

.item-quantity {
    color: #666;
    font-size: 0.9rem;
}

.item-price {
    font-weight: 700;
    color: #1a1a1a;
    font-size: 1.1rem;
    text-align: right;
    flex-shrink: 0;
    margin-left: 1rem;
}

.order-totals {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 2rem;
    border-radius: 12px;
    border: 2px solid var(--accent-color);
    margin-top: 2rem;
}

.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(44, 62, 80, 0.1);
}

.total-row:last-child {
    border-bottom: none;
    padding-top: 1rem;
    margin-top: 1rem;
    border-top: 2px solid var(--accent-color);
    background: white;
    margin: 1rem -2rem -2rem;
    padding: 1.5rem 2rem;
    border-radius: 0 0 12px 12px;
}

.total-label {
    color: #666;
    font-weight: 500;
}

.total-value {
    font-weight: 600;
    color: #1a1a1a;
}

.grand-total {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--accent-color);
}

.grand-total-label {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a1a1a;
}

.admin-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
    flex-wrap: wrap;
}

.btn {
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    border: none;
    cursor: pointer;
    font-size: 1rem;
}

.btn-primary {
    background: linear-gradient(135deg, var(--accent-color), #507191);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #507191, var(--accent-color));
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(44, 62, 80, 0.3);
    color: white;
}

.btn-success {
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
}

.btn-success:hover {
    background: linear-gradient(135deg, #059669, #047857);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
    color: white;
}

.btn-secondary {
    background: white;
    color: #1a1a1a;
    border: 2px solid #1a1a1a;
}

.btn-secondary:hover {
    background: #1a1a1a;
    color: white;
}

.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
    box-shadow: none !important;
}

.status-update-section {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.status-form {
    display: flex;
    gap: 1rem;
    align-items: end;
    flex-wrap: wrap;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-label {
    font-weight: 600;
    color: #1a1a1a;
    font-size: 0.9rem;
}

.form-select {
    padding: 0.75rem 1rem;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 0.95rem;
    min-width: 200px;
}

.form-select:focus {
    outline: none;
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(44, 62, 80, 0.1);
}

@media (max-width: 768px) {
    .admin-container {
        padding: 1rem 0.5rem;
        margin-top: 80px;
    }
    
    .admin-title {
        font-size: 2rem;
    }
    
    .admin-header {
        flex-direction: column;
        align-items: stretch;
    }
    
    .order-header {
        flex-direction: column;
        align-items: stretch;
        text-align: center;
    }
    
    .order-info-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .payment-proof-container {
        flex-direction: column;
    }
    
    .payment-proof-image {
        min-width: auto;
    }
    
    .order-item {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .item-image {
        margin-right: 0;
        margin-bottom: 0.5rem;
    }
    
    .item-price {
        margin-left: 0;
        text-align: center;
    }
    
    .admin-actions {
        flex-direction: column;
    }
    
    .status-form {
        flex-direction: column;
    }
    
    .form-select {
        min-width: auto;
        width: 100%;
    }
}
</style>
@endpush

@section('content')
<section class="admin-container">
    <div class="admin-wrapper">
        <div class="admin-header">
            <h1 class="admin-title">Order Details</h1>
            <a href="{{ route('admin.orders') }}" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.42-1.41L7.83 13H20v-2z"/>
                </svg>
                Back to Orders
            </a>
        </div>
        
        <div class="order-details-card">
            <div class="order-header">
                <div class="order-number">Order #{{ $order->order_number }}</div>
                <div class="order-status status-{{ $order->payment_status }}">
                    {{ ucfirst($order->payment_status) }}
                </div>
            </div>
            
            <div class="order-info-grid">
                <div class="info-section">
                    <div class="info-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        Customer Information
                    </div>
                    <div class="info-item">
                        <span class="info-label">Name</span>
                        <span class="info-value">{{ $order->customer_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $order->customer_email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Phone</span>
                        <span class="info-value">{{ $order->customer_phone }}</span>
                    </div>
                </div>
                
                <div class="info-section">
                    <div class="info-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                        Order Information
                    </div>
                    <div class="info-item">
                        <span class="info-label">Order Date</span>
                        <span class="info-value">{{ $order->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Payment Method</span>
                        <span class="info-value">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Shipping Address</span>
                        <span class="info-value">{{ $order->shipping_address }}</span>
                    </div>
                    @if($order->notes)
                        <div class="info-item">
                            <span class="info-label">Notes</span>
                            <span class="info-value">{{ $order->notes }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="payment-proof-section">
            <div class="section-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                </svg>
                Payment Proof
            </div>
            
            @if($order->payment_proof)
                <div class="payment-proof-container">
                    <div class="payment-proof-image">
                        <img src="{{ \App\Helpers\ImageHelper::getPaymentProofUrl($order->payment_proof) }}" alt="Payment Proof" onclick="openImageModal(this.src)" onerror="this.src='{{ asset('images/no-payment-proof.svg') }}'">
                    </div>
                    <div class="payment-proof-actions">
                        <div class="info-section">
                            <div class="info-title">Payment Status</div>
                            <div class="info-item">
                                <span class="info-label">Current Status</span>
                                <span class="info-value">
                                    <span class="order-status status-{{ $order->payment_status }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Proof Uploaded</span>
                                <span class="info-value">{{ \Carbon\Carbon::parse($order->updated_at)->format('M d, Y H:i') }}</span>
                            </div>
                            
                            @if($order->payment_status === 'pending')
                                <div style="margin-top: 1.5rem;">
                                    <button class="btn btn-success" onclick="confirmPayment({{ $order->id }})">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                        </svg>
                                        Confirm Payment
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="no-payment-proof">
                    <div class="no-proof-icon">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <h3>No Payment Proof Uploaded</h3>
                    <p>Customer has not uploaded payment proof yet.</p>
                </div>
            @endif
        </div>
        
        <div class="status-update-section">
            <div class="section-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                </svg>
                Update Order Status
            </div>
            
            <form class="status-form" onsubmit="updateOrderStatus(event, {{ $order->id }})">
                <div class="form-group">
                    <label class="form-label">Order Status</label>
                    <select name="status" class="form-select" required>
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                        Update Status
                    </button>
                </div>
            </form>
        </div>
        
        <div class="order-items-section">
            <div class="section-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 7h-3V6a4 4 0 0 0-8 0v1H5a1 1 0 0 0-1 1v11a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V8a1 1 0 0 0-1-1zM10 6a2 2 0 0 1 4 0v1h-4V6zm8 13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V9h2v1a1 1 0 0 0 2 0V9h4v1a1 1 0 0 0 2 0V9h2v10z"/>
                </svg>
                Order Items ({{ $order->orderItems->count() }} {{ Str::plural('item', $order->orderItems->count()) }})
            </div>
            
            @foreach($order->orderItems as $item)
                <div class="order-item">
                    <img src="{{ $item->product && $item->product->image ? \App\Helpers\ImageHelper::getProductImageUrl($item->product->image) : asset('images/MOCKUP DEPAN.jpeg.jpg') }}" 
                         alt="{{ $item->product_name }}" 
                         class="item-image"
                         onerror="this.src='{{ asset('images/MOCKUP DEPAN.jpeg.jpg') }}'">
                    <div class="item-details">
                        <div class="item-name">{{ $item->product_name }}</div>
                        @if($item->size || $item->color)
                            <div class="item-attributes">
                                @if($item->size)
                                    <span class="attribute-badge size-badge">Size: {{ $item->size }}</span>
                                @endif
                                @if($item->color)
                                    <span class="attribute-badge color-badge">Color: {{ $item->color }}</span>
                                @endif
                            </div>
                        @endif
                        <div class="item-quantity">Quantity: {{ $item->quantity }}</div>
                    </div>
                    <div class="item-price">
                        Rp. {{ number_format($item->total, 0, ',', '.') }}
                        <div style="font-size: 0.8rem; color: #666; font-weight: 400; margin-top: 0.25rem;">
                            @ Rp. {{ number_format($item->product_price, 0, ',', '.') }} each
                        </div>
                    </div>
                </div>
            @endforeach
            
            <div class="order-totals">
                <div class="total-row">
                    <span class="total-label">Subtotal</span>
                    <span class="total-value">{{ $order->formatted_subtotal }}</span>
                </div>
                <div class="total-row">
                    <span class="total-label">Shipping Cost</span>
                    <span class="total-value">
                        @if($order->shipping_cost == 0)
                            <span style="color: #10B981; font-weight: 600;">FREE</span>
                        @else
                            {{ $order->formatted_shipping_cost }}
                        @endif
                    </span>
                </div>
                <div class="total-row">
                    <span class="grand-total-label">Total Amount</span>
                    <span class="grand-total">{{ $order->formatted_total }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Image Modal -->
<div id="imageModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 10000; align-items: center; justify-content: center;">
    <div style="position: relative; max-width: 90%; max-height: 90%;">
        <img id="modalImage" style="width: 100%; height: auto; border-radius: 8px;">
        <button onclick="closeImageModal()" style="position: absolute; top: -40px; right: 0; background: white; border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
            </svg>
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmPayment(orderId) {
    if (!confirm('Are you sure you want to confirm this payment?')) {
        return;
    }
    
    fetch(`/admin/orders/${orderId}/confirm-payment`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('success', 'Success!', data.message);
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            showToast('error', 'Error!', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Error!', 'Something went wrong. Please try again.');
    });
}

function updateOrderStatus(event, orderId) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const status = formData.get('status');
    
    if (!confirm(`Are you sure you want to update the order status to "${status}"?`)) {
        return;
    }
    
    fetch(`/admin/orders/${orderId}/update-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('success', 'Success!', data.message);
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            showToast('error', 'Error!', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Error!', 'Something went wrong. Please try again.');
    });
}

function openImageModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').style.display = 'flex';
}

function closeImageModal() {
    document.getElementById('imageModal').style.display = 'none';
}

// Close modal when clicking outside the image
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

function showToast(type, title, message) {
    // Remove existing toasts
    const existingToasts = document.querySelectorAll('.toast');
    existingToasts.forEach(toast => toast.remove());
    
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    let bgColor = '#10B981'; // success
    if (type === 'error') bgColor = '#EF4444';
    if (type === 'warning') bgColor = '#F59E0B';
    if (type === 'info') bgColor = '#3B82F6';
    
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${bgColor};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        z-index: 10000;
        transform: translateX(400px);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        max-width: 350px;
    `;
    
    toast.innerHTML = `
        <div style="font-weight: 600; margin-bottom: 0.25rem;">${title}</div>
        <div style="font-size: 0.9rem; opacity: 0.9;">${message}</div>
    `;
    
    // Add to page
    document.body.appendChild(toast);
    
    // Show toast
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 100);
    
    // Auto hide after 4 seconds
    setTimeout(() => {
        toast.style.transform = 'translateX(400px)';
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }, 4000);
}
</script>
@endpush