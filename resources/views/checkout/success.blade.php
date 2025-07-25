@extends('layouts.app')

@section('title', 'Order Status - EnthusiastVerse')

@push('styles')
<style>
.success-container {
    margin-top: 100px;
    padding: 2rem 1rem;
    min-height: 70vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.success-wrapper {
    max-width: 800px;
    margin: 0 auto;
}

.success-card {
    background: white;
    border-radius: 16px;
    padding: 3rem 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    text-align: center;
}

.success-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #10B981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    animation: successPulse 2s ease-in-out infinite;
}

.pending-icon {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
}

.rejected-icon-main {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

@keyframes successPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.success-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.success-subtitle {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.payment-confirmation-card {
    background: linear-gradient(135deg, #fff3cd, #ffeaa7);
    border: 2px solid #fbbf24;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    text-align: center;
}

.payment-confirmation-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #856404;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.payment-confirmation-text {
    color: #856404;
    font-size: 1rem;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.payment-steps {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    margin: 1.5rem 0;
    text-align: left;
}

.payment-step {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1rem;
    padding: 0.5rem 0;
}

.payment-step:last-child {
    margin-bottom: 0;
}

.step-number {
    background: #fbbf24;
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: 600;
    margin-right: 1rem;
    flex-shrink: 0;
}

.step-text {
    color: #856404;
    font-size: 0.9rem;
    line-height: 1.4;
}

.confirm-payment-btn {
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    margin-top: 1rem;
}

.confirm-payment-btn:hover {
    background: linear-gradient(135deg, #059669, #10B981);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
    color: white;
}

.confirm-payment-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
    transform: none;
    background: linear-gradient(135deg, #9CA3AF, #6B7280) !important;
}

.confirm-payment-btn.disabled {
    opacity: 0.4;
    cursor: not-allowed;
    transform: none;
    background: linear-gradient(135deg, #9CA3AF, #6B7280) !important;
}

.confirm-payment-btn.disabled:hover {
    background: linear-gradient(135deg, #9CA3AF, #6B7280) !important;
    transform: none !important;
    box-shadow: none !important;
}

.payment-proof-status {
    background: #f3f4f6;
    border: 2px solid #d1d5db;
    border-radius: 12px;
    padding: 1.5rem;
    margin: 1.5rem 0;
    text-align: center;
    transition: all 0.3s ease;
}

.payment-proof-status.sent {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    border-color: #10b981;
}

.proof-status-icon {
    width: 48px;
    height: 48px;
    margin: 0 auto 1rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e5e7eb;
    transition: all 0.3s ease;
}

.proof-status-icon.sent {
    background: #10b981;
}

.proof-status-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #6b7280;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
}

.proof-status-title.sent {
    color: #065f46;
}

.proof-status-text {
    font-size: 0.9rem;
    color: #9ca3af;
    transition: all 0.3s ease;
}

.proof-status-text.sent {
    color: #047857;
}

.countdown-timer {
    font-size: 0.8rem;
    color: #6b7280;
    margin-top: 0.5rem;
    font-weight: 500;
}

.countdown-timer.active {
    color: #10b981;
}

.order-details {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    text-align: left;
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e9ecef;
}

.order-number {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1a1a1a;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.copy-btn {
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
    border: none;
    padding: 0.5rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    position: relative;
}

.copy-btn:hover {
    background: linear-gradient(135deg, #059669, #10B981);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.copy-btn:active {
    transform: translateY(0);
}

.copy-btn.copied {
    background: linear-gradient(135deg, #10B981, #059669);
    animation: copySuccess 0.3s ease;
}

@keyframes copySuccess {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.copy-tooltip {
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: #1a1a1a;
    color: white;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 500;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    margin-bottom: 0.5rem;
    z-index: 1000;
}

.copy-tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 4px solid transparent;
    border-top-color: #1a1a1a;
}

.copy-btn:hover .copy-tooltip {
    opacity: 1;
    visibility: visible;
}

.order-status {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}

.status-pending {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: white;
}

.status-paid {
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
}

.customer-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.info-group {
    background: white;
    padding: 1rem;
    border-radius: 8px;
    border-left: 4px solid #10B981;
}

.info-label {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.25rem;
}

.info-value {
    font-weight: 600;
    color: #1a1a1a;
}

.order-items {
    margin-bottom: 2rem;
}

.items-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
}

.order-item {
    display: flex;
    align-items: center;
    padding: 1.5rem;
    background: white;
    border-radius: 12px;
    margin-bottom: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    border: 1px solid #f0f0f0;
    transition: all 0.3s ease;
}

.order-item:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transform: translateY(-1px);
}

.order-item:last-child {
    margin-bottom: 0;
}

.item-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 12px;
    margin-right: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    flex-shrink: 0;
}

.item-details {
    flex: 1;
    min-width: 0;
}

.item-name {
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    font-size: 1rem;
    line-height: 1.4;
}

.item-attributes {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    flex-wrap: wrap;
}

.attribute-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.2rem 0.6rem;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 500;
    border: 1px solid;
}

.size-badge {
    background: linear-gradient(135deg, #e3f2fd, #bbdefb);
    color: #1565c0;
    border-color: #90caf9;
}

.color-badge {
    background: linear-gradient(135deg, #f3e5f5, #e1bee7);
    color: #7b1fa2;
    border-color: #ce93d8;
}

.item-quantity {
    color: #666;
    font-size: 0.9rem;
    background: #f8f9fa;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    display: inline-block;
    font-weight: 500;
}

.item-price {
    font-weight: 700;
    color: #1a1a1a;
    font-size: 1.1rem;
    text-align: right;
    flex-shrink: 0;
    margin-left: 1rem;
}

.item-unit-price {
    font-size: 0.8rem;
    color: #666;
    font-weight: 400;
    display: block;
    margin-top: 0.25rem;
}

.order-totals {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 2rem;
    border-radius: 12px;
    border: 2px solid #10B981;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
}

.totals-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 1rem;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(16, 185, 129, 0.1);
}

.total-row:last-child {
    border-bottom: none;
    padding-top: 1rem;
    margin-top: 1rem;
    border-top: 2px solid #10B981;
    background: white;
    margin: 1rem -2rem -2rem;
    padding: 1.5rem 2rem;
    border-radius: 0 0 12px 12px;
}

.total-label {
    color: #666;
    font-weight: 500;
    font-size: 0.95rem;
}

.total-value {
    font-weight: 600;
    color: #1a1a1a;
    font-size: 0.95rem;
}

.grand-total {
    font-size: 1.3rem;
    font-weight: 700;
    color: #10B981;
}

.grand-total-label {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a1a1a;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
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
    background: linear-gradient(135deg, #1a1a1a, #333);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #333, #1a1a1a);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(26, 26, 26, 0.3);
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

.btn-whatsapp {
    background: linear-gradient(135deg, #25D366, #128C7E);
    color: white;
}

.btn-whatsapp:hover {
    background: linear-gradient(135deg, #128C7E, #25D366);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(37, 211, 102, 0.3);
    color: white;
}

.wa-confirm-card {
    background: #e7fbe9;
    border: 2px solid #25D366;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    text-align: center;
}

.wa-confirm-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #128C7E;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.wa-confirm-text {
    color: #128C7E;
    font-size: 1rem;
    margin-bottom: 1.5rem;
}

.loading {
    opacity: 0.6;
    pointer-events: none;
}

.loading::after {
    content: '';
    width: 20px;
    height: 20px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    display: inline-block;
    margin-left: 10px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* File Upload Styles */
.upload-section {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    margin: 1.5rem 0;
    border: 2px solid #e9ecef;
}

.upload-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #856404;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.upload-description {
    color: #856404;
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
}

.file-upload-area {
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    margin-bottom: 1.5rem;
}

.file-upload-area:hover {
    border-color: #fbbf24;
    background: #fffbeb;
}

.file-upload-area.dragover {
    border-color: #fbbf24;
    background: #fffbeb;
    transform: scale(1.02);
}

.upload-placeholder {
    color: #6b7280;
}

.upload-placeholder svg {
    color: #d1d5db;
    margin-bottom: 1rem;
}

.upload-text {
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

.upload-hint {
    font-size: 0.8rem;
    color: #9ca3af;
}

.file-preview {
    display: flex;
    align-items: center;
    gap: 1rem;
    text-align: left;
}

.file-preview img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #e9ecef;
}

.file-info {
    flex: 1;
}

.file-name {
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.remove-file {
    background: #ef4444;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-size: 0.8rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    transition: all 0.3s ease;
}

.remove-file:hover {
    background: #dc2626;
}

.upload-btn {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
}

.upload-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(251, 191, 36, 0.3);
}

.upload-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

.upload-btn.loading {
    opacity: 0.7;
    pointer-events: none;
}

.upload-btn.loading::after {
    content: '';
    width: 16px;
    height: 16px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-left: 0.5rem;
}

.payment-proof-uploaded {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    border: 2px solid #10b981;
    border-radius: 12px;
    padding: 2rem;
    margin: 1.5rem 0;
    text-align: center;
}

.uploaded-icon {
    width: 60px;
    height: 60px;
    background: #10b981;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}

.uploaded-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #065f46;
    margin-bottom: 0.5rem;
}

.uploaded-text {
    color: #047857;
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
}

.uploaded-image {
    margin-top: 1rem;
}

.uploaded-image img {
    max-width: 200px;
    height: auto;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid #10b981;
}

.uploaded-image img:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
}

/* Image Modal */
.image-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.9);
    z-index: 10000;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.image-modal.show {
    display: flex;
}

.image-modal-content {
    position: relative;
    max-width: 90%;
    max-height: 90%;
}

.image-modal img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.image-modal-close {
    position: absolute;
    top: -40px;
    right: 0;
    background: white;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.image-modal-close:hover {
    background: #f3f4f6;
    transform: rotate(90deg);
}

/* Payment Status Tracker */
.payment-status-tracker {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    border: 2px solid #e9ecef;
}

.status-step {
    display: flex;
    align-items: flex-start;
    margin-bottom: 2rem;
    position: relative;
    opacity: 0.5;
    transition: all 0.3s ease;
}

.status-step:last-child {
    margin-bottom: 0;
}

.status-step.active {
    opacity: 1;
}

.status-step.completed {
    opacity: 1;
}

.status-step.completed .step-icon {
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
}

.status-step.active .step-icon {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: white;
    animation: pulse 2s infinite;
}

/* Special styling for rejected status in step 2 */
.status-step.rejected .step-icon {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.status-step.rejected .step-title {
    color: #991b1b;
}

.status-step.rejected .step-description {
    color: #dc2626;
}

.step-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e5e7eb;
    color: #6b7280;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-right: 1rem;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.step-content {
    flex: 1;
    padding-top: 0.5rem;
}

.step-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.step-description {
    font-size: 0.9rem;
    color: #666;
    line-height: 1.4;
}

.status-step.completed .step-title {
    color: #065f46;
}

.status-step.completed .step-description {
    color: #047857;
}

.status-step.active .step-title {
    color: #856404;
}

.status-step.active .step-description {
    color: #a16207;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

/* Auto-refresh indicator */
.auto-refresh-indicator {
    position: fixed;
    top: 20px;
    left: 20px;
    background: rgba(59, 130, 246, 0.9);
    color: white;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 500;
    z-index: 1000;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    opacity: 0;
    transform: translateY(-20px);
    transition: all 0.3s ease;
}

.auto-refresh-indicator.show {
    opacity: 1;
    transform: translateY(0);
}

.refresh-spinner {
    width: 16px;
    height: 16px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

.payment-confirmed-banner {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    border: 2px solid #10b981;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    text-align: center;
    animation: slideInFromTop 0.5s ease-out;
}

.confirmed-icon {
    width: 80px;
    height: 80px;
    background: #10b981;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    animation: bounceIn 0.6s ease-out;
}

.confirmed-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #065f46;
    margin-bottom: 0.5rem;
}

.confirmed-text {
    color: #047857;
    font-size: 1rem;
    line-height: 1.6;
}

/* Payment Rejected Banner */
.payment-rejected-banner {
    background: linear-gradient(135deg, #fee2e2, #fecaca);
    border: 2px solid #ef4444;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    text-align: center;
    animation: slideInFromTop 0.5s ease-out;
}

.rejected-icon {
    width: 80px;
    height: 80px;
    background: #ef4444;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    animation: bounceIn 0.6s ease-out;
}

.rejected-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #991b1b;
    margin-bottom: 1rem;
}

.rejected-text {
    color: #dc2626;
    font-size: 1rem;
    line-height: 1.6;
    text-align: left;
    margin-bottom: 1rem;
}

.rejection-reasons {
    list-style: none;
    padding: 0;
    margin: 1rem 0;
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    border-left: 4px solid #ef4444;
}

.rejection-reasons li {
    position: relative;
    padding-left: 1.5rem;
    margin-bottom: 0.75rem;
    color: #dc2626;
    font-size: 0.9rem;
    line-height: 1.4;
}

.rejection-reasons li:last-child {
    margin-bottom: 0;
}

.rejection-reasons li::before {
    content: '•';
    position: absolute;
    left: 0;
    color: #ef4444;
    font-weight: bold;
    font-size: 1.2rem;
}

/* Update order status for rejected payments */
.status-rejected {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

/* Update success icon for rejected status */
.success-icon.rejected-icon-main {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

@keyframes slideInFromTop {
    0% {
        opacity: 0;
        transform: translateY(-30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes bounceIn {
    0% {
        opacity: 0;
        transform: scale(0.3);
    }
    50% {
        opacity: 1;
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .success-card {
        padding: 2rem 1rem;
    }
    
    .success-title {
        font-size: 1.4rem;
        line-height: 1.3;
    }
    
    .order-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .customer-info {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        width: 100%;
        display: flex;
        justify-content: center;
    }
    
    .action-buttons .btn {
        width: 100%;
        max-width: 280px;
        justify-content: center;
        text-align: center;
        padding: 1rem 1.5rem;
        font-size: 0.95rem;
        margin: 0 auto;
    }
    
    .order-item {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
        padding: 1rem;
    }
    
    .item-image {
        margin-right: 0;
        margin-bottom: 0.5rem;
        width: 100px;
        height: 100px;
    }
    
    .item-details {
        text-align: center;
        margin-bottom: 0.5rem;
    }
    
    .item-price {
        margin-left: 0;
        text-align: center;
    }
    
    .items-title {
        font-size: 1.1rem;
    }
    
    /* Mobile responsive adjustments for file upload and images */
    .file-upload-area {
        padding: 1.5rem 1rem;
    }
    
    .upload-placeholder svg {
        width: 36px;
        height: 36px;
    }
    
    .upload-text {
        font-size: 0.9rem;
    }
    
    .upload-hint {
        font-size: 0.75rem;
    }
    
    .file-preview {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .file-preview img {
        width: 120px;
        height: 120px;
        margin: 0 auto;
    }
    
    .file-info {
        text-align: center;
    }
    
    .file-name {
        font-size: 0.9rem;
        word-break: break-all;
        margin-bottom: 1rem;
        line-height: 1.3;
    }
    
    .remove-file {
        padding: 0.75rem 1.5rem;
        font-size: 0.9rem;
        margin: 0 auto;
        min-width: 120px;
        justify-content: center;
    }
    
    .remove-file svg {
        width: 18px;
        height: 18px;
    }
    
    /* Payment proof uploaded section mobile adjustments */
    .payment-proof-uploaded {
        padding: 1.5rem 1rem;
    }
    
    .uploaded-title {
        font-size: 1.1rem;
    }
    
    .uploaded-text {
        font-size: 0.85rem;
        line-height: 1.4;
    }
    
    .uploaded-image img {
        max-width: 150px;
        border-radius: 12px;
    }
    
    /* Image modal mobile adjustments */
    .image-modal {
        padding: 10px;
    }
    
    .image-modal-content {
        max-width: 95%;
        max-height: 85%;
    }
    
    .image-modal-close {
        top: -35px;
        right: -5px;
        width: 35px;
        height: 35px;
    }
    
    .image-modal-close svg {
        width: 18px;
        height: 18px;
    }
    
    /* Payment confirmation card mobile adjustments */
    .payment-confirmation-card {
        padding: 1.5rem 1rem;
        margin: 1.5rem 0;
        border-radius: 16px;
    }
    
    .payment-confirmation-title {
        font-size: 1.1rem;
        flex-direction: column;
        gap: 0.75rem;
        text-align: center;
        margin-bottom: 1.5rem;
    }
    
    .payment-confirmation-title svg {
        margin: 0 auto;
    }
    
    .payment-confirmation-text {
        font-size: 0.9rem;
        text-align: center;
        margin-bottom: 2rem;
        line-height: 1.5;
    }
    
    .payment-steps {
        padding: 1.25rem;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(251, 191, 36, 0.2);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    
    .payment-step {
        flex-direction: row;
        align-items: flex-start;
        text-align: left;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: rgba(251, 191, 36, 0.05);
        border-radius: 10px;
        border: 2px solid rgba(251, 191, 36, 0.2);
    }
    
    .payment-step:last-child {
        margin-bottom: 0;
    }
    
    .step-number {
        margin-right: 1rem;
        flex-shrink: 0;
        width: 32px;
        height: 32px;
        font-size: 0.9rem;
        font-weight: 700;
        box-shadow: 0 2px 6px rgba(251, 191, 36, 0.3);
    }
    
    .step-text {
        font-size: 0.85rem;
        text-align: left;
        line-height: 1.4;
        color: #856404;
        font-weight: 500;
        width: 100%;
        margin-top: 0;
    }
    
    /* Upload section mobile adjustments */
    .upload-section {
        padding: 1.5rem 1rem;
    }
    
    .upload-title {
        font-size: 1.1rem;
        justify-content: center;
        text-align: center;
    }
    
    .upload-description {
        font-size: 0.85rem;
        text-align: center;
    }
    
    .upload-btn {
        padding: 1rem 1.5rem;
        font-size: 0.9rem;
    }
    
    /* Status tracker mobile adjustments */
    .payment-status-tracker {
        padding: 1.5rem 1rem;
    }
    
    .status-step {
        flex-direction: row;
        align-items: flex-start;
        text-align: left;
        margin-bottom: 2rem;
    }
    
    .step-icon {
        margin-right: 1rem;
        width: 40px;
        height: 40px;
    }
    
    .step-content {
        padding-top: 0.5rem;
        text-align: left;
        flex: 1;
    }
    
    .step-title {
        font-size: 1rem;
        margin-bottom: 0.75rem;
    }
    
    .step-description {
        font-size: 0.85rem;
        line-height: 1.4;
    }
    
    /* Order totals mobile adjustments */
    .order-totals {
        padding: 1.5rem 1rem;
    }
    
    .totals-title {
        font-size: 1rem;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .total-row {
        padding: 1rem 0;
    }
    
    .total-row:last-child {
        margin: 1rem -1rem -1.5rem;
        padding: 1.5rem 1rem;
    }
    
    .total-label,
    .total-value {
        font-size: 0.9rem;
    }
    
    .grand-total {
        font-size: 1.2rem;
    }
    
    .grand-total-label {
        font-size: 1rem;
    }
}

/* Additional mobile adjustments for very small screens */
@media (max-width: 480px) {
    .success-container {
        padding: 1rem 0.5rem;
    }
    
    .success-card {
        padding: 1.5rem 0.75rem;
    }
    
    .success-title {
        font-size: 1.75rem;
    }
    
    .success-subtitle {
        font-size: 1rem;
    }
    
    /* File upload adjustments for very small screens */
    .file-upload-area {
        padding: 1rem 0.75rem;
    }
    
    .file-preview img {
        width: 100px;
        height: 100px;
    }
    
    .file-name {
        font-size: 0.8rem;
    }
    
    .remove-file {
        padding: 0.6rem 1.2rem;
        font-size: 0.8rem;
        min-width: 100px;
    }
    
    .remove-file svg {
        width: 16px;
        height: 16px;
    }
    
    /* Uploaded image adjustments */
    .uploaded-image img {
        max-width: 120px;
    }
    
    .uploaded-title {
        font-size: 1rem;
    }
    
    .uploaded-text {
        font-size: 0.8rem;
    }
    
    /* Payment confirmation adjustments */
    .payment-confirmation-card {
        padding: 1rem 0.75rem;
    }
    
    .payment-confirmation-title {
        font-size: 1rem;
    }
    
    .payment-confirmation-text {
        font-size: 0.85rem;
    }
    
    .payment-steps {
        padding: 0.75rem;
    }
    
    .step-text {
        font-size: 0.8rem;
    }
    
    /* Upload section adjustments */
    .upload-section {
        padding: 1rem 0.75rem;
    }
    
    .upload-title {
        font-size: 1rem;
    }
    
    .upload-description {
        font-size: 0.8rem;
    }
    
    .upload-btn {
        padding: 0.9rem 1.2rem;
        font-size: 0.85rem;
    }
    
    /* Status tracker adjustments */
    .payment-status-tracker {
        padding: 1rem 0.75rem;
    }
    
    .step-icon {
        width: 40px;
        height: 40px;
    }
    
    .step-title {
        font-size: 0.9rem;
    }
    
    .step-description {
        font-size: 0.8rem;
    }
    
    /* Order item adjustments */
    .order-item {
        padding: 0.75rem;
    }
    
    .item-image {
        width: 80px;
        height: 80px;
    }
    
    .item-name {
        font-size: 0.9rem;
    }
    
    .item-price {
        font-size: 1rem;
    }
    
    .item-unit-price {
        font-size: 0.75rem;
    }
    
    /* Button adjustments */
    .btn {
        padding: 0.9rem 1.5rem;
        font-size: 0.9rem;
    }
    
    .confirm-payment-btn,
    .btn-whatsapp {
        padding: 0.9rem 1.5rem;
        font-size: 0.9rem;
    }
    
    /* Copy button adjustments */
    .copy-btn {
        width: 32px;
        height: 32px;
        padding: 0.4rem;
    }
    
    .copy-btn svg {
        width: 14px;
        height: 14px;
    }
    
    .copy-tooltip {
        font-size: 0.7rem;
        padding: 0.4rem 0.6rem;
    }
}
</style>
@endpush

@section('content')
<section class="success-container">
    <div class="success-wrapper">
        <div class="success-card">
            <div class="success-icon {{ $order->payment_status === 'pending' ? 'pending-icon' : ($order->payment_status === 'rejected' ? 'rejected-icon-main' : '') }}">
                @if($order->payment_status === 'pending')
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="white">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                    </svg>
                @elseif($order->payment_status === 'rejected')
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="white">
                        <path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"/>
                    </svg>
                @else
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="white">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                @endif
            </div>
            
            @if($order->payment_status === 'pending')
                <h1 class="success-title">Order Successfully Created!</h1>
                <p class="success-subtitle">
                    Thank you for your order! Please confirm your payment via WhatsApp and send a photo of your payment proof to process your order.
                </p>
            @elseif($order->payment_status === 'paid')
                <h1 class="success-title">Payment Confirmed!</h1>
                <p class="success-subtitle">
                    Great news! Your payment has been confirmed by our admin. Your order is now being processed and will be shipped soon.
                </p>
            @else
                <h1 class="success-title">Payment Rejected</h1>
                <p class="success-subtitle">
                    Unfortunately, your payment proof has been rejected by our admin. Please upload a new payment proof or contact our support team.
                </p>
            @endif
                
            <!-- Payment Status Tracker -->
            <div class="payment-status-tracker" id="paymentStatusTracker">
                <!-- Step 1: Upload Payment Proof -->
                <div class="status-step {{ $order->payment_proof ? 'completed' : 'active' }}">
                    <div class="step-icon">
                        @if($order->payment_proof)
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                        @else
                            <span>1</span>
                        @endif
                    </div>
                    <div class="step-content">
                        <div class="step-title">Upload Payment Proof</div>
                        <div class="step-description">
                            @if($order->payment_proof)
                                Payment proof uploaded successfully
                            @else
                                Upload your payment receipt
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Step 2: Admin Verification -->
                <div class="status-step {{ 
                    $order->payment_status === 'paid' ? 'completed' : 
                    ($order->payment_status === 'rejected' ? 'completed rejected' : 
                    ($order->payment_proof ? 'active' : '')) 
                }}">
                    <div class="step-icon">
                        @if($order->payment_status === 'paid')
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                        @elseif($order->payment_status === 'rejected')
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"/>
                            </svg>
                        @else
                            <span>2</span>
                        @endif
                    </div>
                    <div class="step-content">
                        <div class="step-title">Admin Verification</div>
                        <div class="step-description">
                            @if($order->payment_status === 'paid')
                                Admin has verified and approved your payment
                            @elseif($order->payment_status === 'rejected')
                                Admin has reviewed and rejected your payment
                            @elseif($order->payment_proof)
                                Waiting for admin to verify payment
                            @else
                                Admin will verify your payment
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Step 3: Payment Confirmed -->
                <div class="status-step {{ $order->payment_status === 'paid' ? 'completed' : '' }}">
                    <div class="step-icon">
                        @if($order->payment_status === 'paid')
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                        @else
                            <span>3</span>
                        @endif
                    </div>
                    <div class="step-content">
                        <div class="step-title">Payment Confirmed</div>
                        <div class="step-description">
                            @if($order->payment_status === 'paid')
                                Payment confirmed - Order is being processed
                            @else
                                Order will be processed after payment confirmation
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            @if($order->payment_status === 'pending')
                <div class="payment-confirmation-card">
                    <div class="payment-confirmation-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        Payment Confirmation Required
                    </div>
                    <div class="payment-confirmation-text">
                        To process your order, please follow these steps:
                    </div>
                    
                    <div class="payment-steps">
                        <div class="payment-step">
                            <div class="step-number">1</div>
                            <div class="step-text">Make payment according to your selected payment method</div>
                        </div>
                        <div class="payment-step">
                            <div class="step-number">2</div>
                            <div class="step-text">Take a photo/screenshot of your payment proof</div>
                        </div>
                        <div class="payment-step">
                            <div class="step-number">3</div>
                            <div class="step-text">Upload your payment proof using the form below</div>
                        </div>
                        <div class="payment-step">
                            <div class="step-number">4</div>
                            <div class="step-text">Wait for admin confirmation of your payment</div>
                        </div>
                    </div>
                    
                    <!-- Payment Proof Upload Form -->
                    @if(!$order->payment_proof)
                        <form id="paymentProofForm" enctype="multipart/form-data" style="margin-top: 2rem;">
                            @csrf
                            <div class="upload-section">
                                <div class="upload-title">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                    </svg>
                                    Upload Payment Proof
                                </div>
                                <div class="upload-description">
                                    Please upload a clear photo or screenshot of your payment receipt
                                </div>
                                
                                <div class="file-upload-area" id="fileUploadArea">
                                    <input type="file" id="paymentProofFile" name="payment_proof" accept="image/*" style="display: none;">
                                    <div class="upload-placeholder" id="uploadPlaceholder">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                        </svg>
                                        <div class="upload-text">
                                            <strong>Click to upload</strong> or drag and drop
                                        </div>
                                        <div class="upload-hint">PNG, JPG, GIF up to 5MB</div>
                                    </div>
                                    <div class="file-preview" id="filePreview" style="display: none;">
                                        <img id="previewImage" src="" alt="Payment Proof Preview">
                                        <div class="file-info">
                                            <div class="file-name" id="fileName"></div>
                                            <button type="button" class="remove-file" id="removeFile">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"/>
                                                </svg>
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="upload-btn" id="uploadBtn" disabled>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M9,16V10H5L12,3L19,10H15V16H9M5,20V18H19V20H5Z"/>
                                    </svg>
                                    Upload Payment Proof
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="payment-proof-uploaded">
                            <div class="uploaded-icon">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="white">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                            </div>
                            <div class="uploaded-title">Payment Proof Uploaded</div>
                            <div class="uploaded-text">Your payment proof has been uploaded successfully. Please wait for admin confirmation.</div>
                            <div class="uploaded-image">
                                <img src="{{ \App\Helpers\ImageHelper::getPaymentProofUrl($order->payment_proof) }}" alt="Payment Proof" onclick="openImageModal(this.src)" onerror="this.src='{{ asset('images/no-payment-proof.svg') }}'">
                            </div>
                        </div>
                    @endif
                    
                    <a href="https://wa.me/6287843997805?text=Hello%2C%20I%20have%20made%20payment%20for%20order%20{{ $order->order_number }}%20and%20uploaded%20payment%20proof" target="_blank" class="btn btn-whatsapp" style="margin-top: 1rem;">
                        <svg width="20" height="20" viewBox="0 0 32 32" fill="currentColor">
                            <path d="M16 3C9.373 3 4 8.373 4 15c0 2.637.844 5.086 2.438 7.188L4 29l7.031-2.375C13.086 27.156 14.52 27.5 16 27.5c6.627 0 12-5.373 12-12S22.627 3 16 3zm0 22c-1.313 0-2.594-.219-3.813-.656l-.273-.094-4.188 1.406 1.406-4.094-.094-.281C6.844 19.094 6 17.094 6 15c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10zm5.406-7.594c-.297-.148-1.758-.867-2.031-.969-.273-.102-.469-.148-.664.148-.195.297-.758.969-.93 1.164-.172.195-.344.219-.641.07-.297-.148-1.258-.463-2.398-1.477-.887-.789-1.484-1.766-1.656-2.062-.172-.297-.018-.457.13-.605.133-.133.297-.344.445-.516.148-.172.195-.297.297-.492.102-.195.051-.367-.025-.516-.078-.148-.664-1.602-.91-2.195-.24-.578-.484-.5-.664-.508-.172-.008-.367-.01-.562-.01-.195 0-.516.074-.789.367-.273.297-1.04 1.016-1.04 2.477 0 1.461 1.065 2.875 1.213 3.07.148.195 2.098 3.203 5.086 4.367.711.305 1.266.488 1.699.625.715.227 1.367.195 1.883.117.574-.086 1.758-.719 2.008-1.414.25-.695.25-1.289.176-1.414-.074-.125-.27-.195-.566-.344z"/>
                        </svg>
                        Contact Admin via WhatsApp
                    </a>
                </div>
                                    @endif
            
            <div class="order-details">
                <div class="order-header">
                    <div class="order-number">
                        Order #{{ $order->order_number }}
                        <button class="copy-btn" onclick="copyOrderNumber('{{ $order->order_number }}')" id="copyBtn">
                            <div class="copy-tooltip">Copy Order Number</div>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="order-status {{ $order->payment_status === 'pending' ? 'status-pending' : ($order->payment_status === 'rejected' ? 'status-rejected' : 'status-paid') }}">
                        @if($order->payment_status === 'pending')
                            Awaiting Payment
                        @elseif($order->payment_status === 'rejected')
                            Payment Rejected
                        @else
                            Payment Confirmed
                        @endif
                    </div>
                </div>
                
                {{-- Customer info hidden as requested --}}
                
                <div class="order-items">
                    <div class="items-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 0.5rem; vertical-align: middle;">
                            <path d="M19 7h-3V6a4 4 0 0 0-8 0v1H5a1 1 0 0 0-1 1v11a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V8a1 1 0 0 0-1-1zM10 6a2 2 0 0 1 4 0v1h-4V6zm8 13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V9h2v1a1 1 0 0 0 2 0V9h4v1a1 1 0 0 0 2 0V9h2v10z"/>
                        </svg>
                        Order Items ({{ $order->orderItems->count() }} {{ Str::plural('item', $order->orderItems->count()) }})
                    </div>
                    @foreach($order->orderItems as $item)
                        <div class="order-item">
                            <img src="{{ $item->product && $item->product->image ? asset('storage/' . $item->product->image) : asset('images/MOCKUP DEPAN.jpeg.jpg') }}" 
                                 alt="{{ $item->product_name }}" 
                                 class="item-image">
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
                                <div class="item-quantity">Qty: {{ $item->quantity }}</div>
                            </div>
                            <div class="item-price">
                                Rp. {{ number_format($item->total, 0, ',', '.') }}
                                <span class="item-unit-price">
                                    @ Rp. {{ number_format($item->product_price, 0, ',', '.') }} each
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="order-totals">
                    <div class="totals-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                        Order Summary
                    </div>
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
            
            <div class="action-buttons">
                <a href="{{ route('checkout.track') }}?order_number={{ $order->order_number }}" class="btn btn-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    Track Order
                </a>
                <a href="{{ route('products') }}" class="btn btn-secondary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 7h-3V6a4 4 0 0 0-8 0v1H5a1 1 0 0 0-1 1v11a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V8a1 1 0 0 0-1-1zM10 6a2 2 0 0 1 4 0v1h-4V6zm8 13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V9h2v1a1 1 0 0 0 2 0V9h4v1a1 1 0 0 0 2 0V9h2v10z"/>
                    </svg>
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Global variables
let countdownInterval;
let proofSentTime = null;
let autoRefreshInterval;
let refreshIndicator;

// Check if proof was already sent (from localStorage)
document.addEventListener('DOMContentLoaded', function() {
    const orderId = {{ $order->id }};
    const savedProofTime = localStorage.getItem(`proof_sent_${orderId}`);
    
    if (savedProofTime) {
        const sentTime = new Date(savedProofTime);
        const now = new Date();
        const timeDiff = now - sentTime;
        
        // If less than 5 minutes have passed, consider proof as sent
        if (timeDiff < 5 * 60 * 1000) {
            markProofAsSent(sentTime);
        } else {
            // Clear old data
            localStorage.removeItem(`proof_sent_${orderId}`);
        }
    }
    
    // Initialize file upload functionality
    initFileUpload();
    
    // Initialize auto-refresh for pending orders with payment proof
    @if($order->payment_status === 'pending' && $order->payment_proof)
        initAutoRefresh();
    @endif
});

// Auto-refresh functionality
function initAutoRefresh() {
    createRefreshIndicator();
    
    // Check for payment confirmation every 1 second
    autoRefreshInterval = setInterval(() => {
        checkPaymentStatus();
    }, 1000);
    
    // Show initial refresh indicator
    showRefreshIndicator();
}

function createRefreshIndicator() {
    refreshIndicator = document.createElement('div');
    refreshIndicator.className = 'auto-refresh-indicator';
    refreshIndicator.id = 'autoRefreshIndicator';
    refreshIndicator.innerHTML = `
        <div class="refresh-spinner"></div>
        <span>Checking payment status...</span>
    `;
    document.body.appendChild(refreshIndicator);
}

function showRefreshIndicator() {
    if (refreshIndicator) {
        refreshIndicator.classList.add('show');
        setTimeout(() => {
            refreshIndicator.classList.remove('show');
        }, 3000);
    }
}

function checkPaymentStatus() {
    showRefreshIndicator();
    
    fetch(`/checkout/check-payment-status/{{ $order->id }}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.payment_status === 'paid' || data.payment_status === 'rejected') {
                // Payment status has changed! Reload page to show updated content
                clearInterval(autoRefreshInterval);
                showToast('info', 'Status Updated!', 'Payment status has been updated. Refreshing page...');
                
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        }
    })
    .catch(error => {
        console.error('Error checking payment status:', error);
    });
}

function showPaymentConfirmedBanner() {
    // Remove refresh indicator
    if (refreshIndicator) {
        refreshIndicator.remove();
    }
    
    // Create and show payment confirmed banner
    const banner = document.createElement('div');
    banner.className = 'payment-confirmed-banner';
    banner.innerHTML = `
        <div class="confirmed-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="white">
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
            </svg>
        </div>
        <div class="confirmed-title">Payment Confirmed!</div>
        <div class="confirmed-text">
            Great news! Your payment has been confirmed by our admin. 
            Your order is now being processed and will be shipped soon.
        </div>
    `;
    
    // Insert banner after the status tracker
    const statusTracker = document.getElementById('paymentStatusTracker');
    if (statusTracker) {
        statusTracker.parentNode.insertBefore(banner, statusTracker.nextSibling);
    }
    
    // Show success toast
    showToast('success', 'Payment Confirmed!', 'Your payment has been verified and approved!');
}

function showPaymentRejectedBanner() {
    // Remove refresh indicator
    if (refreshIndicator) {
        refreshIndicator.remove();
    }
    
    // Create and show payment rejected banner
    const banner = document.createElement('div');
    banner.className = 'payment-rejected-banner';
    banner.innerHTML = `
        <div class="rejected-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="white">
                <path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"/>
            </svg>
        </div>
        <div class="rejected-title">Payment Rejected!</div>
        <div class="rejected-text">
            Unfortunately, your payment proof has been rejected by our admin team. 
            You will be redirected to upload a new payment proof.
        </div>
    `;
    
    // Insert banner after the status tracker
    const statusTracker = document.getElementById('paymentStatusTracker');
    if (statusTracker) {
        statusTracker.parentNode.insertBefore(banner, statusTracker.nextSibling);
    }
    
    // Show error toast
    showToast('error', 'Payment Rejected!', 'Your payment proof has been rejected. Please upload a new one.');
}

function updateStatusTracker() {
    const statusTracker = document.getElementById('paymentStatusTracker');
    if (!statusTracker) return;
    
    // Update all steps to completed
    const steps = statusTracker.querySelectorAll('.status-step');
    steps.forEach((step, index) => {
        step.classList.remove('active');
        step.classList.add('completed');
        
        const stepIcon = step.querySelector('.step-icon');
        stepIcon.innerHTML = `
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
            </svg>
        `;
        
        const stepDescription = step.querySelector('.step-description');
        if (index === 0) {
            stepDescription.textContent = 'Payment proof uploaded successfully';
        } else if (index === 1) {
            stepDescription.textContent = 'Admin has verified your payment';
        } else if (index === 2) {
            stepDescription.textContent = 'Payment confirmed - Order is being processed';
        }
    });
}

// File upload functionality
function initFileUpload() {
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileInput = document.getElementById('paymentProofFile');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const filePreview = document.getElementById('filePreview');
    const previewImage = document.getElementById('previewImage');
    const fileName = document.getElementById('fileName');
    const removeFileBtn = document.getElementById('removeFile');
    const uploadBtn = document.getElementById('uploadBtn');
    const uploadForm = document.getElementById('paymentProofForm');
    
    if (!fileUploadArea) return; // Exit if upload form is not present
    
    // Click to upload
    fileUploadArea.addEventListener('click', () => {
        fileInput.click();
    });
    
    // Drag and drop functionality
    fileUploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        fileUploadArea.classList.add('dragover');
    });
    
    fileUploadArea.addEventListener('dragleave', (e) => {
        e.preventDefault();
        fileUploadArea.classList.remove('dragover');
    });
    
    fileUploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        fileUploadArea.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            handleFileSelect(files[0]);
        }
    });
    
    // File input change
    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            handleFileSelect(e.target.files[0]);
        }
    });
    
    // Remove file
    removeFileBtn.addEventListener('click', () => {
        fileInput.value = '';
        uploadPlaceholder.style.display = 'block';
        filePreview.style.display = 'none';
        uploadBtn.disabled = true;
    });
    
    // Form submission
    uploadForm.addEventListener('submit', (e) => {
        e.preventDefault();
        uploadPaymentProof();
    });
    
    function handleFileSelect(file) {
        // Validate file type
        if (!file.type.startsWith('image/')) {
            showToast('error', 'Invalid File!', 'Please select an image file.');
            return;
        }
        
        // Validate file size (5MB)
        if (file.size > 5 * 1024 * 1024) {
            showToast('error', 'File Too Large!', 'Please select a file smaller than 5MB.');
            return;
        }
        
        // Show preview
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImage.src = e.target.result;
            fileName.textContent = file.name;
            uploadPlaceholder.style.display = 'none';
            filePreview.style.display = 'flex';
            uploadBtn.disabled = false;
        };
        reader.readAsDataURL(file);
    }
    
    function uploadPaymentProof() {
        const formData = new FormData();
        formData.append('payment_proof', fileInput.files[0]);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        
        // Add loading state
        uploadBtn.classList.add('loading');
        uploadBtn.disabled = true;
        
        fetch(`/checkout/upload-payment-proof/{{ $order->id }}`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            uploadBtn.classList.remove('loading');
            
            if (data.success) {
                showToast('success', 'Upload Successful!', data.message);
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                showToast('error', 'Upload Failed!', data.message);
                uploadBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            uploadBtn.classList.remove('loading');
            uploadBtn.disabled = false;
            showToast('error', 'Upload Failed!', 'An error occurred while uploading the file.');
        });
    }
}

// Image modal functionality
function openImageModal(src) {
    // Remove existing modal
    const existingModal = document.getElementById('imageModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Create modal
    const modal = document.createElement('div');
    modal.id = 'imageModal';
    modal.className = 'image-modal';
    modal.innerHTML = `
        <div class="image-modal-content">
            <img src="${src}" alt="Payment Proof">
            <button class="image-modal-close" onclick="closeImageModal()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"/>
                </svg>
            </button>
        </div>
    `;
    
    document.body.appendChild(modal);
    setTimeout(() => modal.classList.add('show'), 10);
    
    // Close on overlay click
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeImageModal();
        }
    });
    
    // Close on ESC key
    document.addEventListener('keydown', function escHandler(e) {
        if (e.key === 'Escape') {
            closeImageModal();
            document.removeEventListener('keydown', escHandler);
        }
    });
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => modal.remove(), 300);
    }
}

// Function to mark proof as sent when WhatsApp button is clicked
function markProofSent() {
    const orderId = {{ $order->id }};
    const now = new Date();
    
    // Save to localStorage
    localStorage.setItem(`proof_sent_${orderId}`, now.toISOString());
    
    // Start countdown after a short delay (to allow WhatsApp to open)
    setTimeout(() => {
        markProofAsSent(now);
        showToast('info', 'WhatsApp Opened!', 'Please send your payment proof. Confirmation button will be active in 30 seconds.');
    }, 2000);
}

// Function to update UI when proof is marked as sent
function markProofAsSent(sentTime) {
    proofSentTime = sentTime;
    
    // Update status display
    const statusContainer = document.getElementById('paymentProofStatus');
    const statusIcon = document.getElementById('proofStatusIcon');
    const statusTitle = document.getElementById('proofStatusTitle');
    const statusText = document.getElementById('proofStatusText');
    const countdownTimer = document.getElementById('countdownTimer');
    
    statusContainer.classList.add('sent');
    statusIcon.classList.add('sent');
    statusTitle.classList.add('sent');
    statusText.classList.add('sent');
    
    statusIcon.innerHTML = `
        <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
        </svg>
    `;
    statusTitle.textContent = 'Payment Proof Sent';
    statusText.textContent = 'Waiting for confirmation time...';
    
    // Show countdown
    countdownTimer.style.display = 'block';
    countdownTimer.classList.add('active');
    
    // Start countdown (30 seconds)
    startCountdown(30);
}

// Function to start countdown
function startCountdown(seconds) {
    let timeLeft = seconds;
    const countdownTimer = document.getElementById('countdownTimer');
    
    countdownInterval = setInterval(() => {
        countdownTimer.textContent = `Confirmation button will be active in ${timeLeft} seconds`;
        timeLeft--;
        
        if (timeLeft < 0) {
            clearInterval(countdownInterval);
            enableConfirmButton();
        }
    }, 1000);
}

// Function to enable confirm button
function enableConfirmButton() {
    const confirmBtn = document.getElementById('confirmPaymentBtn');
    const countdownTimer = document.getElementById('countdownTimer');
    const statusText = document.getElementById('proofStatusText');
    
    // Enable button
    confirmBtn.disabled = false;
    confirmBtn.classList.remove('disabled');
    
    // Update status
    statusText.textContent = 'Please click the payment confirmation button below';
    countdownTimer.textContent = 'Confirmation button is now active!';
    countdownTimer.style.color = '#10b981';
    
    // Show success toast
    showToast('success', 'Button Active!', 'You can now confirm your payment.');
}

function confirmPayment(orderId) {
    const btn = document.getElementById('confirmPaymentBtn');
    
    // Check if button is disabled
    if (btn.disabled || btn.classList.contains('disabled')) {
        showToast('warning', 'Please Wait!', 'Please send payment proof via WhatsApp first.');
        return;
    }
    
    // Add loading state
    btn.classList.add('loading');
    btn.disabled = true;
    btn.innerHTML = `
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
        </svg>
        Processing...
    `;
    
    // Send AJAX request to confirm payment
    fetch(`/checkout/confirm-payment/${orderId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Clear localStorage
            localStorage.removeItem(`proof_sent_${orderId}`);
            
            // Show success message
            showToast('success', 'Payment Confirmed!', 'Order status has been changed to confirmed.');
            
            // Reload page after 2 seconds to show updated status
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
            // Show error message
            showToast('error', 'Failed!', data.message || 'An error occurred while confirming payment.');
            
            // Reset button
            btn.classList.remove('loading');
            btn.disabled = false;
            btn.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                </svg>
                Payment Confirmed
            `;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Error!', 'A network error occurred. Please try again.');
        
        // Reset button
        btn.classList.remove('loading');
        btn.disabled = false;
        btn.innerHTML = `
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
            </svg>
            Payment Confirmed
        `;
    });
}

// Function to copy order number
function copyOrderNumber(orderNumber) {
    // Extract only the part after "#"
    const orderNumberOnly = orderNumber;
    
    // Try to use the modern clipboard API
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(orderNumberOnly).then(() => {
            showCopySuccess();
        }).catch(() => {
            // Fallback to older method
            fallbackCopyTextToClipboard(orderNumberOnly);
        });
    } else {
        // Fallback for older browsers
        fallbackCopyTextToClipboard(orderNumberOnly);
    }
}

// Fallback copy function for older browsers
function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    
    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";
    textArea.style.opacity = "0";
    
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        const successful = document.execCommand('copy');
        if (successful) {
            showCopySuccess();
        } else {
            showToast('error', 'Copy Failed!', 'Unable to copy order number.');
        }
    } catch (err) {
        showToast('error', 'Copy Failed!', 'Unable to copy order number.');
    }
    
    document.body.removeChild(textArea);
}

// Function to show copy success feedback
function showCopySuccess() {
    const copyBtn = document.getElementById('copyBtn');
    const tooltip = copyBtn.querySelector('.copy-tooltip');
    
    // Add copied class for animation
    copyBtn.classList.add('copied');
    
    // Change tooltip text temporarily
    const originalText = tooltip.textContent;
    tooltip.textContent = 'Copied!';
    
    // Change icon to checkmark temporarily
    const originalIcon = copyBtn.querySelector('svg').innerHTML;
    copyBtn.querySelector('svg').innerHTML = `
        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
    `;
    
    // Show success toast
    showToast('success', 'Copied!', 'Order number copied to clipboard.');
    
    // Reset after 2 seconds
    setTimeout(() => {
        copyBtn.classList.remove('copied');
        tooltip.textContent = originalText;
        copyBtn.querySelector('svg').innerHTML = originalIcon;
    }, 2000);
}

// Toast notification function
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

