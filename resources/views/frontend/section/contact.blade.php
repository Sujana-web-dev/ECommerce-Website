    <!-- Modern Contact Page -->
<section class="relative min-h-screen bg-gradient-to-br from-gray-50 via-white to-blue-50">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-gray-900 via-blue-900 to-indigo-900 py-20 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center">
                <nav class="flex justify-center items-center space-x-2 mb-6" aria-label="Breadcrumb">
                    <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition-colors duration-300">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                    <i class="fas fa-chevron-right text-gray-500 text-sm"></i>
                    <span class="text-luxury-gold font-medium">Contact Us</span>
                </nav>
                
                <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6 font-serif">
                    Get In <span class="text-luxury-gold">Touch</span>
                </h1>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    We'd love to hear from you. Send us a message and we'll respond as soon as possible.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-16 relative -mt-10 z-20">
        <div class="grid lg:grid-cols-2 gap-12 max-w-7xl mx-auto">
            
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-2xl p-8 lg:p-12">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Send Us a Message</h2>
                    <p class="text-gray-600">Fill out the form below and we'll get back to you within 24 hours.</p>
                </div>

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Full Name *
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 hover:border-gray-400"
                                   placeholder="Enter your full name">
                        </div>

                        <div class="form-group">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address *
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 hover:border-gray-400"
                                   placeholder="Enter your email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                            Subject
                        </label>
                        <input type="text" 
                               id="subject" 
                               name="subject"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 hover:border-gray-400"
                               placeholder="What is this regarding?">
                    </div>

                    <div class="form-group">
                        <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                            Message *
                        </label>
                        <textarea id="message" 
                                  name="message" 
                                  rows="6" 
                                  required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 hover:border-gray-400 resize-none"
                                  placeholder="Tell us more about your inquiry..."></textarea>
                    </div>

                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-4 px-8 rounded-lg hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Send Message
                    </button>
                </form>
            </div>

            <!-- FAQ & Contact Info -->
            <div class="space-y-8">
                <!-- Contact Information Cards -->
                <div class="grid gap-6">
                    <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-2">Visit Our Store</h3>
                                <p class="text-gray-600">Road 12, Sector 10, Uttara Model Town<br>Dhaka, Bangladesh</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-phone text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-2">Call Us</h3>
                                <p class="text-gray-600">+880 123 456 7890<br>Mon-Fri 9AM-6PM</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-2">Email Us</h3>
                                <p class="text-gray-600">support@easycart.com<br>We reply within 24 hours</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Frequently Asked Questions</h3>
                    
                    <div class="space-y-4">
                        <details class="group">
                            <summary class="flex justify-between items-center cursor-pointer p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                                <span class="font-semibold text-gray-900">How do I place an order?</span>
                                <i class="fas fa-chevron-down text-gray-500 group-open:rotate-180 transition-transform duration-300"></i>
                            </summary>
                            <div class="p-4 text-gray-600">
                                Simply browse our products, select your desired item, choose size/quantity, and click "Add to Cart". Then proceed to checkout with your shipping and payment details.
                            </div>
                        </details>

                        <details class="group">
                            <summary class="flex justify-between items-center cursor-pointer p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                                <span class="font-semibold text-gray-900">What payment methods do you accept?</span>
                                <i class="fas fa-chevron-down text-gray-500 group-open:rotate-180 transition-transform duration-300"></i>
                            </summary>
                            <div class="p-4 text-gray-600">
                                We accept Credit/Debit Cards, bKash, Nagad, Rocket, and Cash on Delivery (COD) for selected areas.
                            </div>
                        </details>

                        <details class="group">
                            <summary class="flex justify-between items-center cursor-pointer p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                                <span class="font-semibold text-gray-900">Is Cash on Delivery available?</span>
                                <i class="fas fa-chevron-down text-gray-500 group-open:rotate-180 transition-transform duration-300"></i>
                            </summary>
                            <div class="p-4 text-gray-600">
                                Yes, Cash on Delivery is available for selected locations. Check availability by entering your delivery address at checkout.
                            </div>
                        </details>

                        <details class="group">
                            <summary class="flex justify-between items-center cursor-pointer p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                                <span class="font-semibold text-gray-900">How can I track my order?</span>
                                <i class="fas fa-chevron-down text-gray-500 group-open:rotate-180 transition-transform duration-300"></i>
                            </summary>
                            <div class="p-4 text-gray-600">
                                Once shipped, you'll receive a tracking number via email/SMS. Use it on our "Order Tracking" page to monitor your delivery.
                            </div>
                        </details>

                        <details class="group">
                            <summary class="flex justify-between items-center cursor-pointer p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                                <span class="font-semibold text-gray-900">What is your return policy?</span>
                                <i class="fas fa-chevron-down text-gray-500 group-open:rotate-180 transition-transform duration-300"></i>
                            </summary>
                            <div class="p-4 text-gray-600">
                                We offer a 7-day return policy for unused, undamaged products. Refunds are processed within 5–7 working days after inspection.
                            </div>
                        </details>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Styling -->
<style>
    /* Form enhancements */
    .form-group input:focus,
    .form-group textarea:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    /* Smooth animations */
    details[open] summary {
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 0.5rem;
    }
    
    /* Custom scrollbar for textarea */
    textarea::-webkit-scrollbar {
        width: 6px;
    }
    
    textarea::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    textarea::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    
    textarea::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    /* Gradient background animation */
    @keyframes gradient-shift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    .animate-gradient {
        background-size: 200% 200%;
        animation: gradient-shift 6s ease infinite;
    }
    
    /* Floating animation for background elements */
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    .animate-float {
        animation: float 8s ease-in-out infinite;
    }
</style>

<!-- Enhanced JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation and enhancement
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input, textarea');
        
        // Add floating labels effect
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
        
        // Form submission with loading state
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
            submitBtn.disabled = true;
        });
        
        // Smooth scroll for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observe cards for animation
        document.querySelectorAll('.bg-white').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    });
</script>