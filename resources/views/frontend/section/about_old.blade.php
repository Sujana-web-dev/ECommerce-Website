<!-- Ultra-Modern About Hero Section -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-20 left-20 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-to-r from-blue-500/10 to-purple-500/10 rounded-full blur-3xl animate-spin-slow"></div>
    </div>
    
    <!-- Floating Geometric Shapes -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-4 h-4 bg-white/20 rounded-full animate-float"></div>
        <div class="absolute top-1/3 right-1/3 w-6 h-6 bg-blue-400/30 rounded-full animate-float-delayed"></div>
        <div class="absolute bottom-1/4 left-1/3 w-3 h-3 bg-purple-400/30 rounded-full animate-float-delayed-2"></div>
        <div class="absolute bottom-1/3 right-1/4 w-5 h-5 bg-pink-400/30 rounded-full animate-float"></div>
    </div>

    <div class="container relative z-10">
        <div class="text-center text-white">
            <!-- Enhanced Breadcrumb -->
            <nav class="flex justify-center items-center space-x-2 mb-8" data-aos="fade-up">
                <a href="{{route('dashboard')}}" class="flex items-center px-4 py-2 bg-white/10 backdrop-blur-md rounded-full hover:bg-white/20 transition-all duration-300 text-white/80 hover:text-white">
                    <i class="fas fa-home mr-2"></i>
                    Home
                </a>
                <div class="w-2 h-2 bg-white/50 rounded-full"></div>
                <span class="flex items-center px-4 py-2 bg-gradient-to-r from-blue-500/20 to-purple-500/20 backdrop-blur-md rounded-full text-white font-semibold">
                    <i class="fas fa-users mr-2"></i>
                    About Us
                </span>
            </nav>

            <!-- Hero Title with Advanced Typography -->
            <div class="space-y-6" data-aos="fade-up" data-aos-delay="200">
                <h1 class="text-6xl lg:text-8xl font-bold bg-gradient-to-r from-white via-blue-100 to-purple-100 bg-clip-text text-transparent mb-6 leading-tight">
                    About Us
                </h1>
                <div class="w-32 h-1 bg-gradient-to-r from-blue-400 to-purple-400 mx-auto rounded-full"></div>
                <p class="text-xl lg:text-2xl text-white/80 max-w-3xl mx-auto leading-relaxed font-light">
                    Discover the passion, innovation, and dedication behind our brand
                </p>
            </div>

            <!-- Animated Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce" data-aos="fade-up" data-aos-delay="800">
                <div class="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center">
                    <div class="w-1 h-3 bg-white/70 rounded-full mt-2 animate-pulse"></div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Ultra-Modern Brand Story Section -->
<section class="py-20 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
    <!-- Background Decorative Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-blue-200 to-transparent"></div>
        <div class="absolute top-20 right-10 w-64 h-64 bg-gradient-to-br from-blue-100/50 to-purple-100/50 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-10 w-80 h-80 bg-gradient-to-br from-purple-100/50 to-pink-100/50 rounded-full blur-3xl"></div>
    </div>

    <div class="container relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center bg-gradient-to-r from-blue-100 to-purple-100 rounded-full px-6 py-2 mb-6">
                <i class="fas fa-heart text-red-500 mr-2"></i>
                <span class="text-gray-700 font-semibold text-sm uppercase tracking-wider">Our Story</span>
            </div>
            <h2 class="text-5xl lg:text-6xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-6 leading-tight">
                Wear the Trend. <br>
                <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Be the Brand.</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                We believe fashion should empower you. Our products are selected with love, 
                inspired by global trends but rooted in local style.
            </p>
        </div>

        <!-- Enhanced Image Section -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-20">
            <div class="lg:col-span-7" data-aos="fade-right">
                <div class="relative group">
                    <!-- Main Image Container -->
                    <div class="relative overflow-hidden rounded-3xl shadow-2xl bg-gradient-to-br from-blue-500/10 to-purple-500/10 p-2">
                        <img src="{{asset('assets/images/about.jpg')}}" 
                             alt="About Us" 
                             class="w-full h-[500px] object-cover rounded-2xl transition-transform duration-700 group-hover:scale-105">
                        
                        <!-- Image Overlay Effects -->
                        <div class="absolute inset-2 bg-gradient-to-t from-black/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    
                    <!-- Floating Elements -->
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-gradient-to-br from-blue-400 to-purple-600 rounded-2xl shadow-xl opacity-90 group-hover:rotate-12 transition-transform duration-500"></div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-gradient-to-br from-purple-400 to-pink-600 rounded-full shadow-xl opacity-80 group-hover:scale-110 transition-transform duration-500"></div>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-8" data-aos="fade-left">
                <!-- Vision Card -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100/50">
                    <div class="flex items-center mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fas fa-eye text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Our Vision</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        To become the leading fashion destination that inspires confidence and celebrates individual style while making fashion accessible to everyone.
                    </p>
                </div>

                <!-- Mission Card -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100/50">
                    <div class="flex items-center mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fas fa-rocket text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Our Mission</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        To curate exceptional fashion pieces that blend global trends with local culture, delivering quality, style, and value to our community.
                    </p>
                </div>

                <!-- Values Card -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100/50">
                    <div class="flex items-center mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fas fa-gem text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Our Values</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Quality, authenticity, sustainability, and customer satisfaction are at the heart of everything we do.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


    <section class="about_service">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <h3>We Always Provide Kind Services For Customers</h3>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Customer Services
                            </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"><strong>Need help? We’re always here for you.</strong>  
                                    Our dedicated support team is ready to assist you with size guidance, order tracking, returns, and more — always with a kind and patient approach. Whether you're new to shopping online or a regular fashion lover, we treat every customer with care and respect.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Online Consultation
                            </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"><strong>Not sure what suits you best?</strong>  
                                    Our fashion experts are available for online consultation to help you choose the right outfit, match colors, and recommend styles based on your needs. Just message us, and we’ll help you create your perfect look.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Sales Management
                            </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"><strong>We manage your orders with care and clarity.</strong>  
                                    Our smart sales system ensures you get timely updates on stock availability, delivery schedules, and promotional offers. No confusion, no delays — just smooth, transparent service from cart to doorstep.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-6">
                    <div class="about_serviceImg">
                        <img src="{{asset('assets/images/aboutService.jpg')}}" class="w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="sales_rate py-5">
        <div class="container">
            <div class="row text-center">
                <!-- Products For Sale -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="rate_left">
                        <h2>12 Million+</h2>
                        <h4>Products For Sale</h4>
                        <p>Explore our huge collection of fashion-forward dresses, shoes, accessories & more — all handpicked to inspire your style journey.</p>
                    </div>
                </div>

                <!-- Happy Customers -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="rate_left">
                        <h2>500K+</h2>
                        <h4>Happy Customers</h4>
                        <p>Our growing family of satisfied customers is the heart of our brand — because your trust means everything to us.</p>
                    </div>
                </div>

                <!-- Secure Orders Delivered -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="rate_left">
                        <h2>1 Million+</h2>
                        <h4>Orders Delivered</h4>
                        <p>With fast delivery and secure packaging, we ensure your orders reach you in perfect condition — every time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="leader">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="leader_title">
                        <h3>Meet Our Leader</h3>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </section>