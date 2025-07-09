@extends('layouts.app')

@section('title', 'About Us - EnthusiastVerse')

@section('content')
<!-- Hero Section -->
<section class="about-hero">
    <div class="about-hero-content">
        <h1>About EnthusiastVerse</h1>
        <p class="hero-subtitle">Where Passion Meets Fashion</p>
    </div>
    <div class="hero-overlay"></div>
</section>

<!-- Main About Content -->
<section class="about-main">
    <div class="container">
        <!-- Brand Story -->
        <div class="about-section">
            <div class="section-header">
                <h2>Our Story</h2>
                <div class="section-line"></div>
            </div>
            <div class="story-content">
                <p class="lead-text">
                    EnthusiastVerse is more than just a clothing brand. We're a movement — a reflection of passion, resistance, and love transformed into a statement. Each piece in our collection tells a story of boldness, creativity, and identity.
                </p>
                <p>
                    Born from the belief that fashion should be a form of self-expression, EnthusiastVerse creates clothing for those who dare to be different. We understand that what you wear is an extension of who you are, and we're here to help you tell your story.
                </p>
            </div>
        </div>

        <!-- Mission, Vision, Values -->
        <div class="mvv-section">
            <div class="mvv-grid">
                <div class="mvv-card">
                    <div class="mvv-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h3>Our Mission</h3>
                    <p>To create clothing that speaks to the soul of every individual who refuses to conform to society's expectations. We believe in the power of self-expression through fashion.</p>
                </div>

                <div class="mvv-card">
                    <div class="mvv-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </div>
                    <h3>Our Vision</h3>
                    <p>To build a community of enthusiasts who embrace their authentic selves and inspire others to do the same. Fashion is our medium, but authenticity is our message.</p>
                </div>

                <div class="mvv-card">
                    <div class="mvv-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                        </svg>
                    </div>
                    <h3>Our Values</h3>
                    <div class="values-list">
                        <div class="value-item">
                            <strong>Authenticity:</strong> Be true to yourself, always.
                        </div>
                        <div class="value-item">
                            <strong>Quality:</strong> Every piece is crafted with care and attention to detail.
                        </div>
                        <div class="value-item">
                            <strong>Community:</strong> We're stronger together than apart.
                        </div>
                        <div class="value-item">
                            <strong>Innovation:</strong> Constantly pushing boundaries in design and concept.
                        </div>
                    </div>
                </div>

                <div class="mvv-card">
                    <div class="mvv-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </div>
                    <h3>Our Contact</h3>
                    <div class="contact-list">
                        <div class="contact-item">
                            <strong>Phone:</strong> +62 878-4399-7805
                        </div>
                        <div class="contact-item">
                            <strong>WhatsApp:</strong> +62 878-4399-7805
                        </div>
                        <div class="contact-item">
                            <strong>Email:</strong> vibewithenthusiast@gmail.com
                        </div>
                        <div class="contact-item">
                            <strong>Customer Service:</strong> Available 24/7
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- What Makes Us Different -->
        <div class="about-section">
            <div class="section-header">
                <h2>What Makes Us Different</h2>
                <div class="section-line"></div>
            </div>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                            <path d="M2 17l10 5 10-5"/>
                            <path d="M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <h4>Premium Materials</h4>
                    <p>We use only the finest cotton fleece and premium fabrics to ensure comfort and durability.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 12l2 2 4-4"/>
                            <path d="M21 12c-1 0-3-1-3-3s2-3 3-3 3 1 3 3-2 3-3 3"/>
                            <path d="M3 12c1 0 3-1 3-3s-2-3-3-3-3 1-3 3 2 3 3 3"/>
                            <path d="M13 12h3"/>
                            <path d="M8 12H5"/>
                        </svg>
                    </div>
                    <h4>Unique Designs</h4>
                    <p>Each design is carefully crafted to make a statement and reflect the wearer's personality.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h4>Community Driven</h4>
                    <p>We listen to our community and create designs that resonate with our enthusiasts.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                            <polyline points="3.27,6.96 12,12.01 20.73,6.96"/>
                            <line x1="12" y1="22.08" x2="12" y2="12"/>
                        </svg>
                    </div>
                    <h4>Sustainable Practices</h4>
                    <p>We're committed to ethical production and sustainable fashion practices.</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="about-cta">
            <h2>Join the EnthusiastVerse Community</h2>
            <p>Ready to express your authentic self? Explore our collection and find pieces that speak to your soul.</p>
            <div class="cta-buttons">
                <a href="{{ route('products') }}" class="btn-primary">Shop Now</a>
                <a href="{{ route('home') }}#products" class="btn-secondary">View Collection</a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* About Hero Section */
.about-hero {
    height: 60vh;
    background: linear-gradient(135deg, rgba(0,0,0,0.8), rgba(255,59,63,0.3)), 
                url('{{ asset("images/about-hero-bg.jpg") }}') center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-top: 80px;
}

.about-hero-content {
    text-align: center;
    color: white;
    z-index: 2;
    position: relative;
}

.about-hero h1 {
    font-size: 4rem;
    font-weight: 900;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 3px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
}

.hero-subtitle {
    font-size: 1.5rem;
    font-weight: 300;
    letter-spacing: 2px;
    opacity: 0.9;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.3);
    z-index: 1;
}

/* Main About Content */
.about-main {
    padding: 6rem 0;
    background: #fff;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.about-section {
    margin-bottom: 6rem;
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-header h2 {
    font-size: 3rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.section-line {
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--accent-color), #ff6b6b);
    margin: 0 auto;
    border-radius: 2px;
}

.story-content {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}

.lead-text {
    font-size: 1.3rem;
    font-weight: 500;
    line-height: 1.8;
    color: #333;
    margin-bottom: 2rem;
}

.story-content p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #666;
    margin-bottom: 1.5rem;
}

/* Mission, Vision, Values Grid */
.mvv-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 6rem 2rem;
    border-radius: 20px;
    margin: 6rem 0;
}

.mvv-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 3rem;
    max-width: 1200px;
    margin: 0 auto;
}

.mvv-card {
    background: white;
    padding: 3rem 2rem;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05);
}

.mvv-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.mvv-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--accent-color), #ff6b6b);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    color: white;
}

.mvv-card h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.mvv-card p {
    font-size: 1.1rem;
    line-height: 1.7;
    color: #666;
}

.values-list, .contact-list {
    text-align: left;
    margin-top: 1rem;
}

.value-item, .contact-item {
    padding: 0.75rem 0;
    border-bottom: 1px solid #eee;
    font-size: 1rem;
    line-height: 1.6;
}

.value-item:last-child, .contact-item:last-child {
    border-bottom: none;
}

.value-item strong, .contact-item strong {
    color: var(--accent-color);
    font-weight: 600;
}

/* Features Grid */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2.5rem;
    margin-top: 3rem;
}

.feature-item {
    text-align: center;
    padding: 2rem 1rem;
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #1a1a1a, #333);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
}

.feature-item h4 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 1rem;
}

.feature-item p {
    font-size: 1rem;
    line-height: 1.6;
    color: #666;
}

/* Call to Action */
.about-cta {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    color: white;
    padding: 4rem 2rem;
    border-radius: 20px;
    text-align: center;
    margin-top: 6rem;
}

.about-cta h2 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.about-cta p {
    font-size: 1.2rem;
    line-height: 1.7;
    margin-bottom: 2.5rem;
    opacity: 0.9;
}

.cta-buttons {
    display: flex;
    gap: 1.5rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-primary, .btn-secondary {
    padding: 1rem 2rem;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    display: inline-block;
}

.btn-primary {
    background: linear-gradient(135deg, var(--accent-color), #ff6b6b);
    color: white;
    box-shadow: 0 4px 15px rgba(255, 59, 63, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 59, 63, 0.4);
}

.btn-secondary {
    background: transparent;
    color: white;
    border: 2px solid white;
}

.btn-secondary:hover {
    background: white;
    color: #1a1a1a;
    transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .about-hero {
        height: 50vh;
        margin-top: 70px;
    }
    
    .about-hero h1 {
        font-size: 2.5rem;
        letter-spacing: 2px;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
    }
    
    .about-main {
        padding: 4rem 0;
    }
    
    .container {
        padding: 0 1rem;
    }
    
    .section-header h2 {
        font-size: 2.2rem;
    }
    
    .mvv-section {
        padding: 4rem 1rem;
        margin: 4rem 0;
    }
    
    .mvv-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .mvv-card {
        padding: 2rem 1.5rem;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .about-cta {
        padding: 3rem 1rem;
        margin-top: 4rem;
    }
    
    .about-cta h2 {
        font-size: 2rem;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-primary, .btn-secondary {
        width: 100%;
        max-width: 300px;
    }
}

@media (max-width: 480px) {
    .about-hero h1 {
        font-size: 2rem;
    }
    
    .section-header h2 {
        font-size: 1.8rem;
    }
    
    .lead-text {
        font-size: 1.1rem;
    }
    
    .mvv-card {
        padding: 1.5rem 1rem;
    }
    
    .mvv-icon {
        width: 60px;
        height: 60px;
    }
    
    .about-cta h2 {
        font-size: 1.6rem;
    }
}
</style>
@endpush