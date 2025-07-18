@extends('layouts.app')

@section('title', 'Payment Rejected - EnthusiastVerse')

@push('styles')
<style>
.error-container {
    margin-top: 100px;
    padding: 2rem 1rem;
    min-height: 70vh;
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
}

.error-wrapper {
    max-width: 800px;
    margin: 0 auto;
}

.error-card {
    background: white;
    border-radius: 16px;
    padding: 3rem 2rem;
    box-shadow: 0 10px 30px rgba(239, 68, 68, 0.2);
    text-align: center;
    border: 2px solid #ef4444;
}

.error-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    animation: errorPulse 2s ease-in-out infinite;
    box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
}

@keyframes errorPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.error-title {
    font-size: 2.8rem;
    font-weight: 700;
    color: #991b1b;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(239, 68, 68, 0.1);
}

.error-subtitle {
    font-size: 1.2rem;
    color: #dc2626;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.rejection-banner {
    background: linear-gradient(135deg, #fee2e2, #fecaca);
    border: 2px solid #ef4444;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    text-align: center;
    animation: slideInFromTop 0.5s ease-out;
}

.banner-icon {
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

.banner-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #991b1b;
    margin-bottom: 1rem;
}

.banner-text {
    color: #dc2626;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    text-align: left;
}

.rejection-reasons {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    margin: 1.5rem 0;
    border-left: 4px solid #ef4444;
    text-align: left;
}

.reasons-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #991b1b;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.reasons-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.reasons-list li {
    position: relative;
    padding-left: 1.5rem;
    margin-bottom: 0.75rem;
    color: #dc2626;
    font-size: 0.9rem;
    line-height: 1.4;
}

.reasons-list li:last-child {
    margin-bottom: 0;
}

.reasons-list li::before {
    content: '•';
    position: absolute;
    left: 0;
    color: #ef4444;
    font-weight: bold;
    font-size: 1.2rem;
}

.reupload-section {
    background: linear-gradient(135deg, #fff3cd, #ffeaa7);
    border: 2px solid #fbbf24;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    text-align: center;
}

.reupload-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #856404;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.reupload-text {
    color: #856404;
    font-size: 1rem;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

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

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.order-details {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    text-align: left;
    border: 1px solid #e9ecef;
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
    background: linear-gradient(135deg, #ef4444, #dc2626);
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
    background: linear-gradient(135deg, #dc2626, #ef4444);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
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

.copy-btn:hover .copy-tooltip {
    opacity: 1;
    visibility: visible;
}

.order-status {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
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
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #dc2626, #ef4444);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
    color: white;
}

.btn-secondary {
    background: white;
    color: #ef4444;
    border: 2px solid #ef4444;
}

.btn-secondary:hover {
    background: #ef4444;
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
    .error-card {
        padding: 2rem 1rem;
    }
    
    .error-title {
        font-size: 2.2rem;
    }
    
    .order-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .action-buttons {
        flex-direction: column;
    }
}
</style>
@endpush

@section('content')
<section class="error-container">
    <div class="error-wrapper">
        <div class="error-card">
            <div class="error-icon">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="white">
                    <path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"/>
                </svg>
            </div>
            
            <h1 class="error-title">Payment Rejected</h1>
            <p class="error-subtitle">
                Unfortunately, your payment proof has been rejected by our admin team. Please review the reasons below and upload a new payment proof.
            </p>
            
            <!-- Payment Rejection Banner -->
            <div class="rejection-banner">
                <div class="banner-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="white">
                        <path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"/>
                    </svg>
                </div>
                <div class="banner-title">Payment Proof Rejected</div>
                <div class="banner-text">
                    Your payment proof did not meet our verification requirements. This could be due to several reasons:
                </div>
                
                <div class="rejection-reasons">
                    <div class="reasons-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                        Common Rejection Reasons:
                    </div>
                    <ul class="reasons-list">
                        <li>Unclear or blurry image quality</li>
                        <li>Incorrect payment amount shown</li>
                        <li>Wrong payment method or account details</li>
                        <li>Invalid or expired transaction receipt</li>
                        <li>Payment proof doesn't match order details</li>
                        <li>Incomplete transaction information</li>
                    </ul>
                </div>
            </div>
            
            <!-- Re-upload Section -->
            <div class="reupload-section">
                <div class="reupload-title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                    </svg>
                    Upload New Payment Proof
                </div>
                <div class="reupload-text">
                    Please upload a new, clear payment proof to continue with your order. Make sure the image is clear and shows all necessary transaction details.
                </div>
                
                <form id="paymentProofForm" enctype="multipart/form-data" style="margin-top: 2rem;">
                    @csrf
                    <div class="upload-section">
                        <div class="upload-title">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                            </svg>
                            Upload New Payment Proof
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
                            Upload New Payment Proof
                        </button>
                    </div>
                </form>
                
                <a href="https://wa.me/6287843997805?text=Hello%2C%20my%20payment%20proof%20for%20order%20{{ $order->order_number }}%20was%20rejected.%20Can%20you%20help%20me%3F" target="_blank" class="btn btn-whatsapp" style="margin-top: 1rem;">
                    <svg width="20" height="20" viewBox="0 0 32 32" fill="currentColor">
                        <path d="M16 3C9.373 3 4 8.373 4 15c0 2.637.844 5.086 2.438 7.188L4 29l7.031-2.375C13.086 27.156 14.52 27.5 16 27.5c6.627 0 12-5.373 12-12S22.627 3 16 3zm0 22c-1.313 0-2.594-.219-3.813-.656l-.273-.094-4.188 1.406 1.406-4.094-.094-.281C6.844 19.094 6 17.094 6 15c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10zm5.406-7.594c-.297-.148-1.758-.867-2.031-.969-.273-.102-.469-.148-.664.148-.195.297-.758.969-.93 1.164-.172.195-.344.219-.641.07-.297-.148-1.258-.463-2.398-1.477-.887-.789-1.484-1.766-1.656-2.062-.172-.297-.018-.457.13-.605.133-.133.297-.344.445-.516.148-.172.195-.297.297-.492.102-.195.051-.367-.025-.516-.078-.148-.664-1.602-.91-2.195-.24-.578-.484-.5-.664-.508-.172-.008-.367-.01-.562-.01-.195 0-.516.074-.789.367-.273.297-1.04 1.016-1.04 2.477 0 1.461 1.065 2.875 1.213 3.07.148.195 2.098 3.203 5.086 4.367.711.305 1.266.488 1.699.625.715.227 1.367.195 1.883.117.574-.086 1.758-.719 2.008-1.414.25-.695.25-1.289.176-1.414-.074-.125-.27-.195-.566-.344z"/>
                    </svg>
                    Contact Support via WhatsApp
                </a>
            </div>
            
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
                    <div class="order-status">
                        Payment Rejected
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
// Initialize file upload functionality
document.addEventListener('DOMContentLoaded', function() {
    initFileUpload();
});

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

// Function to copy order number
function copyOrderNumber(orderNumber) {
    // Try to use the modern clipboard API
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(orderNumber).then(() => {
            showCopySuccess();
        }).catch(() => {
            // Fallback to older method
            fallbackCopyTextToClipboard(orderNumber);
        });
    } else {
        // Fallback for older browsers
        fallbackCopyTextToClipboard(orderNumber);
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