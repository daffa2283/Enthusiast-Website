// Improved Size Selection Modal HTML
function createImprovedSizeSelectionModal(productId, productName, sizes) {
    return `
        <div id="sizeSelectionModal" class="size-selection-modal">
            <div class="modal-overlay"></div>
            <div class="modal-content">
                <button class="modal-close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <div class="modal-header">
                    <div class="product-info">
                        <h3>${productName}</h3>
                        <p class="modal-subtitle">Select your preferences</p>
                    </div>
                    <div class="modal-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3h2l.4 2m0 0L6 13h11l1.5-8H5.4z"></path>
                            <circle cx="9" cy="20" r="1"></circle>
                            <circle cx="20" cy="20" r="1"></circle>
                        </svg>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="selection-section">
                        <div class="section-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="9" cy="9" r="2"></circle>
                                <path d="M21 15.5c-.3-1.1-1.2-2-2.4-2.5"></path>
                            </svg>
                            <h4>Choose Size</h4>
                        </div>
                        <div class="size-selection-buttons">
                            ${sizes.map(size => `
                                <button type="button" class="size-selection-btn" data-size="${size}">
                                    ${size}
                                </button>
                            `).join('')}
                        </div>
                    </div>
                    
                    <div class="selection-section">
                        <div class="section-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="15" height="13"></rect>
                                <polygon points="16,8 20,8 23,11 23,16 16,16 16,8"></polygon>
                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                            </svg>
                            <h4>Quantity</h4>
                        </div>
                        <div class="quantity-controls">
                            <button type="button" class="quantity-btn minus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>
                            <input type="number" id="simpleQuantity" value="1" min="1" max="10">
                            <button type="button" class="quantity-btn plus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel-btn" onclick="closeSizeSelectionModal()">
                        Cancel
                    </button>
                    <button id="confirmSizeSelection" class="confirm-btn" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3h2l.4 2m0 0L6 13h11l1.5-8H5.4z"></path>
                            <circle cx="9" cy="20" r="1"></circle>
                            <circle cx="20" cy="20" r="1"></circle>
                        </svg>
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    `;
}

// Improved CSS for Size Selection Modal
const improvedModalCSS = `
/* Size Selection Modal Improvements */
.size-selection-modal .modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 30px 30px 20px 30px;
    border-bottom: 1px solid #f0f0f0;
}

.size-selection-modal .product-info h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 5px 0;
}

.size-selection-modal .modal-subtitle {
    color: #666;
    font-size: 0.9rem;
    margin: 0;
}

.size-selection-modal .modal-icon {
    color: var(--accent-color);
}

.size-selection-modal .modal-body {
    padding: 30px;
}

.size-selection-modal .selection-section {
    margin-bottom: 25px;
}

.size-selection-modal .section-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}

.size-selection-modal .section-header svg {
    color: var(--accent-color);
}

.size-selection-modal .section-header h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0;
}

.size-selection-btn:hover {
    border-color: var(--accent-color);
    background: rgba(255, 59, 63, 0.1);
    transform: translateY(-2px);
}

.size-selection-btn.active {
    border-color: var(--accent-color);
    background: var(--accent-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 59, 63, 0.3);
}

.size-selection-modal .modal-footer {
    display: flex;
    gap: 15px;
    padding: 20px 30px 30px 30px;
    border-top: 1px solid #f0f0f0;
}

.confirm-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 15px 30px;
}

.cancel-btn {
    padding: 15px 25px;
}

.cancel-btn:hover {
    transform: translateY(-2px);
}
`;