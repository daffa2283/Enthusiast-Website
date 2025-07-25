<div class="payment-proof-modal">
    <div class="text-center">
        <div class="mb-4">
            <img src="{{ \App\Helpers\ImageHelper::getPaymentProofUrl($paymentProof) }}" 
                 alt="Payment Proof" 
                 class="max-w-full h-auto rounded-lg shadow-lg mx-auto"
                 style="max-height: 500px;"
                 onerror="this.src='{{ asset('images/no-payment-proof.svg') }}'">
        </div>
        <p class="text-sm text-gray-600 mt-2">
            Click and drag to move the image. Use mouse wheel to zoom.
        </p>
    </div>
</div>

<style>
.payment-proof-modal img {
    cursor: grab;
    transition: transform 0.2s ease;
}

.payment-proof-modal img:active {
    cursor: grabbing;
}

.payment-proof-modal img:hover {
    transform: scale(1.02);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const img = document.querySelector('.payment-proof-modal img');
    if (img) {
        let scale = 1;
        let isDragging = false;
        let startX, startY, translateX = 0, translateY = 0;

        // Zoom functionality
        img.addEventListener('wheel', function(e) {
            e.preventDefault();
            const delta = e.deltaY > 0 ? 0.9 : 1.1;
            scale *= delta;
            scale = Math.min(Math.max(0.5, scale), 3);
            img.style.transform = `translate(${translateX}px, ${translateY}px) scale(${scale})`;
        });

        // Drag functionality
        img.addEventListener('mousedown', function(e) {
            isDragging = true;
            startX = e.clientX - translateX;
            startY = e.clientY - translateY;
            img.style.cursor = 'grabbing';
        });

        document.addEventListener('mousemove', function(e) {
            if (!isDragging) return;
            translateX = e.clientX - startX;
            translateY = e.clientY - startY;
            img.style.transform = `translate(${translateX}px, ${translateY}px) scale(${scale})`;
        });

        document.addEventListener('mouseup', function() {
            isDragging = false;
            img.style.cursor = 'grab';
        });
    }
});
</script>