@extends('layouts.app')

@section('title', 'Dashboard - EnthusiastVerse')

@section('content')
<div class="dashboard-container">
    <!-- Header Section -->
    <div class="dashboard-header">
        <div class="container">
            <div class="header-content">
                <div class="welcome-section">
                    <div class="greeting">
                        <h1>Welcome back, {{ auth()->check() ? auth()->user()->name : 'User' }}!</h1>
                        <p>Manage your account and track your orders</p>
                    </div>
                    <div class="header-stats">
                        <div class="header-stat">
                            <span class="stat-number">{{ $totalOrders }}</span>
                            <span class="stat-label">Orders</span>
                        </div>
                        <div class="header-stat">
                            <span class="stat-number">{{ $cartCount }}</span>
                            <span class="stat-label">Cart Items</span>
                        </div>
                    </div>
                </div>
                <div class="user-avatar-large">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="dashboard-content">
        <div class="container">
            <!-- Stats Overview -->
            <div class="stats-overview">
                <div class="stat-card primary">
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3h2l.4 2m0 0L6 13h11l1.5-8H5.4z"></path>
                            <circle cx="9" cy="20" r="1"></circle>
                            <circle cx="20" cy="20" r="1"></circle>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $cartCount }}</h3>
                        <p>Items in Cart</p>
                        <div class="stat-action">
                            <a href="{{ route('cart') }}">View Cart →</a>
                        </div>
                    </div>
                </div>

                <div class="stat-card success">
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $totalOrders }}</h3>
                        <p>Total Orders</p>
                        <div class="stat-action">
                            <a href="{{ route('checkout.track') }}">Track Orders →</a>
                        </div>
                    </div>
                </div>

                <div class="stat-card info">
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <h3>Rp. {{ number_format($totalSpent, 0, ',', '.') }}</h3>
                        <p>Total Spent</p>
                        <div class="stat-action">
                            <span class="text-muted">Lifetime spending</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Grid -->
            <div class="dashboard-grid">
                <!-- Quick Actions -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Quick Actions</h2>
                        <p>Shortcuts to common tasks</p>
                    </div>
                    <div class="actions-grid">
                        <a href="{{ route('products') }}" class="action-card">
                            <div class="action-icon shop">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                            </div>
                            <div class="action-content">
                                <h3>Shop Products</h3>
                                <p>Browse our latest collection</p>
                            </div>
                        </a>

                        <a href="{{ route('cart') }}" class="action-card">
                            <div class="action-icon cart">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 3h2l.4 2m0 0L6 13h11l1.5-8H5.4z"></path>
                                    <circle cx="9" cy="20" r="1"></circle>
                                    <circle cx="20" cy="20" r="1"></circle>
                                </svg>
                            </div>
                            <div class="action-content">
                                <h3>View Cart</h3>
                                <p>Review items and checkout</p>
                            </div>
                        </a>

                        <a href="{{ route('profile.edit') }}" class="action-card">
                            <div class="action-icon profile">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="action-content">
                                <h3>Edit Profile</h3>
                                <p>Update your information</p>
                            </div>
                        </a>

                        <a href="{{ route('checkout.track') }}" class="action-card">
                            <div class="action-icon track">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 11l3 3L22 4"></path>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg>
                            </div>
                            <div class="action-content">
                                <h3>Track Orders</h3>
                                <p>Check your order status</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Recent Orders</h2>
                        <p>Your latest transactions</p>
                    </div>
                    <div class="orders-list">
                        @forelse($orders as $order)
                            <div class="order-item">
                                <div class="order-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                        <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                    </svg>
                                </div>
                                <div class="order-content">
                                    <div class="order-header">
                                        <div class="order-number-section">
                                            <h4>Order #{{ $order->order_number }}</h4>
                                            <button class="copy-btn" onclick="copyOrderNumber('{{ $order->order_number }}', event)" title="Copy Order Number">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <span class="status-badge {{ $order->status === 'completed' ? 'completed' : ($order->status === 'pending' ? 'pending' : 'processing') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                    <p class="order-details">{{ $order->orderItems->count() }} {{ Str::plural('item', $order->orderItems->count()) }} • {{ $order->formatted_total }}</p>
                                    <span class="order-date">{{ $order->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                </div>
                                <h4>No Orders Yet</h4>
                                <p>You haven't placed any orders yet. Start shopping to see your order history here!</p>
                                <a href="{{ route('products') }}" class="btn-primary">Start Shopping</a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Account Info -->
                <div class="section-card account-info-card">
                    <div class="section-header">
                        <h2>Account Information</h2>
                        <p>Your profile details</p>
                    </div>
                    <div class="account-info">
                        <div class="info-item">
                            <div class="info-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                Full Name
                            </div>
                            <span class="info-value">{{ auth()->check() ? auth()->user()->name : 'User' }}</span>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                Email Address
                            </div>
                            <span class="info-value">{{ auth()->check() ? auth()->user()->email : 'user@example.com' }}</span>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                Member Since
                            </div>
                            <span class="info-value">{{ auth()->check() && auth()->user()->created_at ? auth()->user()->created_at->format('F Y') : 'Recently' }}</span>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22,4 12,14.01 9,11.01"></polyline>
                                </svg>
                                Account Status
                            </div>
                            <span class="status-badge active">Active</span>
                        </div>
                    </div>
                    <div class="account-actions">
                        <a href="{{ route('profile.edit') }}" class="btn-secondary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Base Styles */
.dashboard-container {
    margin-top: 80px;
    min-height: calc(100vh - 80px);
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

/* Header Section */
.dashboard-header {
    background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
    color: white;
    padding: 3rem 0;
    position: relative;
    overflow: hidden;
}

.dashboard-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.1;
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    z-index: 1;
}

.welcome-section {
    flex: 1;
}

.greeting h1 {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    background: linear-gradient(135deg, #ffffff 0%, #e2e8f0 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.greeting p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 1.5rem;
}

.header-stats {
    display: flex;
    gap: 2rem;
}

.header-stat {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: #fbbf24;
}

.stat-label {
    font-size: 0.8rem;
    opacity: 0.8;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.user-avatar-large {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
}

/* Main Content */
.dashboard-content {
    padding: 3rem 0;
}

/* Stats Overview */
.stats-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.stat-card.primary::before {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.stat-card.success::before {
    background: linear-gradient(135deg, #10b981, #059669);
}

.stat-card.info::before {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

.stat-card .stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-bottom: 1rem;
}

.stat-card.primary .stat-icon {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.stat-card.success .stat-icon {
    background: linear-gradient(135deg, #10b981, #059669);
}

.stat-card.info .stat-icon {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.stat-content h3 {
    font-size: 2.25rem;
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 0.5rem 0;
}

.stat-content p {
    color: #64748b;
    margin: 0 0 1rem 0;
    font-weight: 500;
}

.stat-action a {
    color: #3b82f6;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.stat-action a:hover {
    color: #1d4ed8;
}

.text-muted {
    color: #94a3b8;
    font-size: 0.85rem;
}

/* Main Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.section-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.section-header {
    margin-bottom: 2rem;
}

.section-header h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 0.5rem 0;
}

.section-header p {
    color: #64748b;
    margin: 0;
    font-size: 0.9rem;
}

/* Actions Grid */
.actions-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.action-card {
    background: #f8fafc;
    border-radius: 12px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.action-card:hover {
    background: white;
    border-color: #e2e8f0;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.action-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.action-icon.shop {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.action-icon.cart {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.action-icon.profile {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.action-icon.track {
    background: linear-gradient(135deg, #10b981, #059669);
}

.action-content h3 {
    font-size: 1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 0.25rem 0;
}

.action-content p {
    color: #64748b;
    margin: 0;
    font-size: 0.85rem;
}

/* Orders List */
.orders-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.order-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.order-item:hover {
    background: white;
    border-color: #cbd5e1;
    transform: translateY(-1px);
}

.order-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #1e293b, #334155);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.order-content {
    flex: 1;
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

.order-number-section {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.order-header h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

/* Copy Button Styles */
.copy-btn {
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 0.25rem;
    color: #64748b;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
}

.copy-btn:hover {
    background: #3b82f6;
    color: white;
    border-color: #3b82f6;
    transform: translateY(-1px);
}

.copy-btn:active {
    transform: translateY(0);
}

.copy-btn.copied {
    background: #10b981;
    color: white;
    border-color: #10b981;
}

.order-details {
    color: #64748b;
    margin: 0 0 0.5rem 0;
    font-size: 0.9rem;
}

.order-date {
    color: #94a3b8;
    font-size: 0.8rem;
}

/* Status Badges */
.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge.active {
    background: #dcfce7;
    color: #166534;
}

.status-badge.pending {
    background: #fef3c7;
    color: #92400e;
}

.status-badge.processing {
    background: #dbeafe;
    color: #1e40af;
}

.status-badge.completed {
    background: #dcfce7;
    color: #166534;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 2rem;
}

.empty-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: #f1f5f9;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
}

.empty-state h4 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 0.5rem 0;
}

.empty-state p {
    color: #64748b;
    margin: 0 0 1.5rem 0;
    line-height: 1.6;
}

/* Account Info */
.account-info {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 2rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

.info-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #475569;
    font-size: 0.9rem;
}

.info-value {
    color: #1e293b;
    font-weight: 500;
}

/* Buttons */
.btn-primary {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #1d4ed8, #1e40af);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    color: white;
}

.btn-secondary {
    background: #f8fafc;
    color: #475569;
    border: 2px solid #e2e8f0;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #1e293b;
    color: white;
    border-color: #1e293b;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-overview {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
    
    .actions-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .header-stats {
        gap: 1rem;
    }
}

@media (max-width: 768px) {
    .container {
        padding: 0 1rem;
    }
    
    .header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }
    
    .greeting h1 {
        font-size: 2rem;
    }
    
    .stats-overview {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .actions-grid {
        grid-template-columns: 1fr;
    }
    
    .section-card {
        padding: 1.5rem;
    }
    
    .order-item {
        padding: 1rem;
    }
    
    .info-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .dashboard-header {
        padding: 2rem 0;
    }
    
    .dashboard-content {
        padding: 2rem 0;
    }
    
    .section-card {
        padding: 1rem;
    }
    
    .stat-card {
        padding: 1.5rem;
    }
    
    .action-card {
        padding: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Function to copy order number (only the part after "#")
function copyOrderNumber(orderNumber, event) {
    // Prevent any default behavior
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }
    
    // Extract only the part after "#"
    const orderNumberOnly = orderNumber.toString();
    
    // Get the button element
    const button = event ? event.target.closest('.copy-btn') : document.querySelector('.copy-btn');
    
    console.log('Copying order number:', orderNumberOnly); // Debug log
    
    // Try to use the modern clipboard API
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(orderNumberOnly).then(() => {
            console.log('Copy successful via clipboard API'); // Debug log
            showCopySuccess(button);
        }).catch((err) => {
            console.log('Clipboard API failed, using fallback:', err); // Debug log
            // Fallback to older method
            fallbackCopyTextToClipboard(orderNumberOnly, button);
        });
    } else {
        console.log('Using fallback copy method'); // Debug log
        // Fallback for older browsers
        fallbackCopyTextToClipboard(orderNumberOnly, button);
    }
}

// Fallback copy function for older browsers
function fallbackCopyTextToClipboard(text, button) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.position = "fixed";
    textArea.style.left = "-999999px";
    textArea.style.top = "-999999px";
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        const successful = document.execCommand('copy');
        if (successful) {
            showCopySuccess(button);
        } else {
            showCopyError();
        }
    } catch (err) {
        showCopyError();
    }
    
    document.body.removeChild(textArea);
}

// Function to show copy success feedback
function showCopySuccess(button) {
    // Add copied class for animation
    button.classList.add('copied');
    
    // Change icon to checkmark temporarily
    const originalIcon = button.querySelector('svg').innerHTML;
    button.querySelector('svg').innerHTML = `
        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
    `;
    
    // Update title
    const originalTitle = button.title;
    button.title = 'Copied!';
    
    // Show success notification
    showToast('Order number copied to clipboard!', 'success');
    
    // Reset after 2 seconds
    setTimeout(() => {
        button.classList.remove('copied');
        button.title = originalTitle;
        button.querySelector('svg').innerHTML = originalIcon;
    }, 2000);
}

// Function to show copy error
function showCopyError() {
    showToast('Failed to copy order number', 'error');
}

// Simple toast notification function
function showToast(message, type = 'success') {
    // Remove existing toasts
    const existingToasts = document.querySelectorAll('.toast-notification');
    existingToasts.forEach(toast => toast.remove());
    
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.textContent = message;
    
    // Style the toast
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#10b981' : '#ef4444'};
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 10000;
        animation: slideIn 0.3s ease;
        max-width: 300px;
    `;
    
    // Add animation keyframes if not already added
    if (!document.querySelector('#toast-styles')) {
        const style = document.createElement('style');
        style.id = 'toast-styles';
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }
    
    // Add to page
    document.body.appendChild(toast);
    
    // Remove after 3 seconds
    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }, 3000);
}
</script>
@endpush