@extends('layouts.app')

@section('title', 'Manage Orders - Admin')

@push('styles')
<style>
.admin-container {
    margin-top: 100px;
    padding: 2rem 1rem;
    min-height: 70vh;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.admin-wrapper {
    max-width: 1400px;
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

.filters-section {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.filters-form {
    display: flex;
    gap: 1rem;
    align-items: end;
    flex-wrap: wrap;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.filter-label {
    font-weight: 600;
    color: #1a1a1a;
    font-size: 0.9rem;
}

.filter-input,
.filter-select {
    padding: 0.75rem 1rem;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    min-width: 200px;
}

.filter-input:focus,
.filter-select:focus {
    outline: none;
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(44, 62, 80, 0.1);
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    border: none;
    cursor: pointer;
    font-size: 0.95rem;
}

.btn-primary {
    background: linear-gradient(135deg, var(--accent-color), #507191);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #507191, var(--accent-color));
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(44, 62, 80, 0.3);
}

.btn-secondary {
    background: white;
    color: #666;
    border: 2px solid #e9ecef;
}

.btn-secondary:hover {
    border-color: #ccc;
    color: #333;
}

.orders-table-container {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    overflow-x: auto;
}

.orders-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px;
}

.orders-table th,
.orders-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #f0f0f0;
}

.orders-table th {
    background: #f8f9fa;
    font-weight: 600;
    color: #1a1a1a;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: sticky;
    top: 0;
    z-index: 10;
}

.orders-table tr:hover {
    background: #f8f9fa;
}

.order-number {
    font-weight: 600;
    color: var(--accent-color);
    text-decoration: none;
}

.order-number:hover {
    text-decoration: underline;
}

.order-status {
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
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

.status-shipped {
    background: linear-gradient(135deg, #8B5CF6, #7C3AED);
    color: white;
}

.status-delivered {
    background: linear-gradient(135deg, #059669, #047857);
    color: white;
}

.status-cancelled {
    background: linear-gradient(135deg, #EF4444, #DC2626);
    color: white;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    align-items: center;
    flex-wrap: wrap;
}

.btn-sm {
    padding: 0.5rem 0.75rem;
    font-size: 0.8rem;
    border-radius: 6px;
}

.btn-success {
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
}

.btn-success:hover {
    background: linear-gradient(135deg, #059669, #047857);
    transform: translateY(-1px);
}

.btn-info {
    background: linear-gradient(135deg, #3B82F6, #2563EB);
    color: white;
}

.btn-info:hover {
    background: linear-gradient(135deg, #2563EB, #1D4ED8);
    transform: translateY(-1px);
}

.btn-warning {
    background: linear-gradient(135deg, #F59E0B, #D97706);
    color: white;
}

.btn-warning:hover {
    background: linear-gradient(135deg, #D97706, #B45309);
    transform: translateY(-1px);
}

.pagination-wrapper {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

.no-orders {
    text-align: center;
    padding: 4rem 2rem;
    color: #666;
}

.no-orders-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1rem;
    background: #f0f0f0;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #999;
}

.test-message {
    background: #ff0000;
    color: white;
    padding: 1rem;
    text-align: center;
    font-weight: bold;
    margin-bottom: 1rem;
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
    
    .filters-form {
        flex-direction: column;
    }
    
    .filter-input,
    .filter-select {
        min-width: auto;
        width: 100%;
    }
    
    .orders-table-container {
        padding: 1rem;
    }
    
    .orders-table th,
    .orders-table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.9rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 0.25rem;
    }
}
</style>
@endpush

@section('content')
<section class="admin-container">
    <div class="admin-wrapper">
        <div class="test-message">
            INI ADALAH FILE BARU - KOLOM PAYMENT PROOF SUDAH DIHILANGKAN
        </div>
        
        <div class="admin-header">
            <h1 class="admin-title">Manage Orders (NEW VERSION)</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.42-1.41L7.83 13H20v-2z"/>
                </svg>
                Back to Dashboard
            </a>
        </div>
        
        <div class="filters-section">
            <form method="GET" action="{{ route('admin.orders') }}" class="filters-form">
                <div class="filter-group">
                    <label class="filter-label">Search</label>
                    <input type="text" name="search" class="filter-input" placeholder="Order number, customer name..." value="{{ request('search') }}">
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Payment Status</label>
                    <select name="status" class="filter-select">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                        Filter
                    </button>
                </div>
                
                @if(request()->hasAny(['search', 'status']))
                    <div class="filter-group">
                        <a href="{{ route('admin.orders') }}" class="btn btn-secondary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                            </svg>
                            Clear
                        </a>
                    </div>
                @endif
            </form>
        </div>
        
        <div class="orders-table-container">
            @if($orders->count() > 0)
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Payment Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="order-number">
                                        {{ $order->order_number }}
                                    </a>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $order->customer_name }}</strong><br>
                                        <small class="text-muted">{{ $order->customer_email }}</small>
                                    </div>
                                </td>
                                <td>{{ $order->formatted_total }}</td>
                                <td>
                                    <span class="order-status status-{{ $order->payment_status }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                            </svg>
                                            View Details
                                        </a>
                                        @if($order->payment_proof)
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-warning btn-sm">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                                </svg>
                                                View Payment Proof
                                            </a>
                                        @endif
                                        @if($order->payment_status === 'pending' && $order->payment_proof)
                                            <button class="btn btn-success btn-sm" onclick="confirmPayment({{ $order->id }})">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                                </svg>
                                                Confirm Payment
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="pagination-wrapper">
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            @else
                <div class="no-orders">
                    <div class="no-orders-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 7h-3V6a4 4 0 0 0-8 0v1H5a1 1 0 0 0-1 1v11a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V8a1 1 0 0 0-1-1zM10 6a2 2 0 0 1 4 0v1h-4V6zm8 13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V9h2v1a1 1 0 0 0 2 0V9h4v1a1 1 0 0 0 2 0V9h2v10z"/>
                        </svg>
                    </div>
                    <h3>No Orders Found</h3>
                    <p>No orders match your current filters.</p>
                </div>
            @endif
        </div>
    </div>
</section>
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
            alert('Payment confirmed successfully!');
            window.location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong. Please try again.');
    });
}
</script>
@endpush