@include('include.header')


<!-- Hero Section Start -->
<div class="hero dark-section parallaxie">
    <!-- Video Start -->
    <div class="hero-bg-video">

        <img src="{{ asset('public/assets/images/home-banner.png') }}" alt="Home Image"
            class="w-100 h-100 hero-video-poster">

        <!-- Selfhosted Video Start -->
        <video autoplay muted playsinline loop preload="auto" id="myvideo">
            <source src="{{ asset('public/assets/images/home-video.mp4') }}" type="video/mp4">
        </video>
        <!-- Selfhosted Video End -->


    </div>
    <!-- Video End -->

    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <!-- Hero Contant Start -->
                <div class="hero-contant">
                    <!-- Hero Sub Heading Start -->
                    <div class="hero-sub-heading wow fadeInUp">

                        <!-- Satisfy Client Content Start -->
                        <div class="satisfy-client-content">
                            <p>AI-Powered Industrial Intelligence</p>
                        </div>
                        <!-- Satisfy Client Content End -->
                    </div>
                    <!-- Hero Sub Heading End -->

                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h1 class="text-anime-style-3" data-cursor="-opaque">Predict Equipment Failures Before They
                            Happen</h1>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Monitor machine health in real time with AI-driven
                            predictive maintenance, live sensor analytics, and intelligent fault detection to reduce
                            downtime and improve operational efficiency.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Hero Content Body Start -->
                    <div class="hero-content-body wow fadeInUp" data-wow-delay="0.4s">
                        <!-- Hero Button Start -->
                        <div class="hero-btn">
                            <a href="{{ route('contact') }}" class="btn-default">Request a Demo</a>
                        </div>
                        <!-- Hero Button End -->

                    </div>
                    <!-- Hero Content Body End -->

                </div>
                <!-- Hero Contant End -->
            </div>


        </div>
    </div>
    <div class="hero-info-list wow fadeInUp" data-wow-delay="0.2s">
        <ul>
            <li>IoT Endpoints</li>
            <li>IoT Edge platform (Gateways)</li>
            <li>IoT Platform Hub</li>
            <li>Enterprise Applications</li>
        </ul>
    </div>
</div>
<!-- Hero Section End -->

<!-- About Us Section Start -->
<div class="about-us">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title section-title-center">
                    <span class="section-sub-title wow fadeInUp">About PredictorMT</span>
                    <h2 class="text-effect wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque">Empowering
                        Industries with AI-Driven Predictive Maintenance & Real-Time Machine Intelligence</h2>
                    <p>PredictorMT enables manufacturers to monitor industrial assets in real time using AI-powered
                        analytics, IoT sensor data, and predictive maintenance. Our platform helps detect equipment
                        issues early, optimize maintenance schedules, and improve operational efficiency.</p>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- About Us Item List Start -->
                <div class="about-us-item-list">
                    <!-- About Us Item Start -->
                    <div class="about-us-item box-1 wow fadeInUp p-0">

                        <img src="{{ asset('public/assets/images/ai-powered-monitoring.png') }}" alt="">

                        <div class="about-us-item-contant">
                            <h3>AI-Powered Monitoring</h3>
                            <p>Monitor machine health with real-time sensor data, intelligent analytics, and continuous
                                performance tracking.</p>
                        </div>
                    </div>
                    <!-- About Us Item End -->

                    <!-- About Us Item Start -->
                    <div class="about-us-item box-2 wow fadeInUp" data-wow-delay="0.2s">
                        <figure class="image-anime">
                            <img src="{{ asset('public/assets/images/about-image.png') }}" alt="" class="w-100 h-100">
                        </figure>

                    </div>
                    <!-- About Us Item End -->

                    <!-- About Us Item Start -->
                    <div class="about-us-item box-3 wow fadeInUp" data-wow-delay="0.4s">
                        <!-- About Rating Box Start -->
                        <div class="about-rating-box">
                            <!-- Satisfy Client Images Start -->

                            <!-- Satisfy Client Images End -->

                            <!-- About Rating Box Body Start -->
                            <div class="about-rating-box-body">
                                <!-- About Rating Counter Start -->
                                <div class="about-rating-counter">
                                    <i class="fa-solid fa-star"></i>
                                    <h2>24/7 Real-Time Monitoring</h2>
                                </div>
                                <!-- About Rating Counter End -->

                                <!-- About Rating Counter Contant Start -->
                                <div class="about-rating-counter-content">
                                    <p>Trusted for secure industrial monitoring with scalable IoT architecture and
                                        real-time machine insights.</p>
                                </div>
                                <!-- About Rating Counter Contant End -->
                            </div>
                            <!-- About Rating Box Body End -->
                        </div>
                        <!-- About Rating Box End -->

                        <!-- Client Rating Button Start -->
                        <div class="about-rating-btn">
                            <a href="{{ route('about') }}" class="btn-default">Learn More About</a>
                        </div>
                        <!-- Client Rating Button End -->
                    </div>
                    <!-- About Us Item End -->
                </div>
                <!-- About Us Item List End -->
            </div>


        </div>
    </div>
</div>
<!-- About Us Section End -->

<!-- Our Service Section Start -->
<div class="our-services-gold bg-section dark-section">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-xl-6">
                <!-- Section Title Start -->
                <div class="section-title">
                    <span class="section-sub-title wow fadeInUp">Predictor MT Services</span>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">AI-Powered Machine Monitoring</h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-xl-6">
                <!-- Section Content Button Start -->
                <div class="section-content-btn">
                    <!-- Section Title Content Start -->
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                        <p>PredictorMT helps industries optimize equipment performance through real-time monitoring,
                            AI-powered analytics, predictive maintenance, and seamless IoT integration.</p>
                    </div>
                    <!-- Section Title Content End -->

                    <!-- Section Button Start -->
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ route('service') }}" class="btn-default">View All Services</a>
                    </div>
                    <!-- Section Button End -->
                </div>
                <!-- Section Content Button End -->
            </div>
        </div>
        <div class="swiper service-slider">
            <div class="swiper-wrapper">

                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="service-item-gold">
                        <div class="icon-box">
                            <i class="fa-solid fa-microchip fa-3x"></i>
                        </div>

                        <div class="service-item-body-gold">
                            <div class="service-item-contant-gold">
                                <h2><a href="#">Device Management</a></h2>
                                <p>Manage, monitor, and configure industrial devices from a centralized platform.</p>
                            </div>

                            <div class="service-item-btn-gold">
                                <a href="#" class="readmore-btn">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="service-item-gold">
                        <div class="icon-box">
                            <i class="fa-solid fa-chart-column fa-3x"></i>
                        </div>

                        <div class="service-item-body-gold">
                            <div class="service-item-contant-gold">
                                <h2><a href="#">Reporting & Notifications</a></h2>
                                <p>Receive real-time alerts, detailed reports, and actionable maintenance insights.</p>
                            </div>

                            <div class="service-item-btn-gold">
                                <a href="#" class="readmore-btn">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="service-item-gold">
                        <div class="icon-box">
                            <i class="fa-solid fa-sliders fa-3x"></i>
                        </div>

                        <div class="service-item-body-gold">
                            <div class="service-item-contant-gold">
                                <h2><a href="#">Custom Functionality</a></h2>
                                <p>Configure machines, sensors, dashboards, and workflows to fit your operations.</p>
                            </div>

                            <div class="service-item-btn-gold">
                                <a href="#" class="readmore-btn">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="swiper-slide">
                    <div class="service-item-gold">
                        <div class="icon-box">
                            <i class="fa-solid fa-chart-line fa-3x"></i>
                        </div>

                        <div class="service-item-body-gold">
                            <div class="service-item-contant-gold">
                                <h2><a href="#">Advanced Data Analytics</a></h2>
                                <p>Transform live sensor data into predictive insights with AI-powered analytics.</p>
                            </div>

                            <div class="service-item-btn-gold">
                                <a href="#" class="readmore-btn">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="swiper-pagination"></div>
        </div>


    </div>
</div>
<!-- Our Service Section End -->

<!-- Why Choose Us Section Start  -->
<div class="our-achievement-prime">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <!-- Achivments Content Start -->
                <div class="achievement-content-prime">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <span class="section-sub-title wow fadeInUp">Why Choose Us</span>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Smarter Monitoring. Reliable Performance.
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Reduce downtime with AI-powered monitoring and
                            predictive maintenance.</p>
                        <img src="{{ asset('public/assets/images/1.jpeg') }}" alt="" class="mt-3 rounded-5">
                    </div>
                    <!-- Section Title End -->

                </div>
                <!--  Achivments Content End -->
            </div>

            <div class="col-xl-6">
                <div class="achievement-item-list-prime">

                    <!-- Item 1 -->
                    <div class="achievement-item-prime wow fadeInUp">
                        <div class="icon-box">
                            <i class="fa-solid fa-microchip fa-2x"></i>
                        </div>
                        <div class="achievement-item-content-prime">
                            <h3>A Full IoT Solution</h3>
                            <p>Complete IoT platform connecting devices, sensors, applications, and industrial systems
                                seamlessly.</p>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="achievement-item-prime wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <i class="fa-solid fa-chart-line fa-2x"></i>
                        </div>
                        <div class="achievement-item-content-prime">
                            <h3>Business Domain Solution</h3>
                            <p>Integrated gateways, software, and networking for reliable industrial IoT deployment.</p>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="achievement-item-prime wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <i class="fa-solid fa-clock-rotate-left fa-2x"></i>
                        </div>
                        <div class="achievement-item-content-prime">
                            <h3>Quick Deployment</h3>
                            <p>Deploy industrial monitoring solutions quickly with minimal setup and configuration
                                effort.</p>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="achievement-item-prime wow fadeInUp" data-wow-delay="0.6s">
                        <div class="icon-box">
                            <i class="fa-solid fa-cubes fa-2x"></i>
                        </div>
                        <div class="achievement-item-content-prime">
                            <h3>Modular & Scalable</h3>
                            <p>Flexible architecture supporting business growth with scalable industrial IoT
                                infrastructure.</p>
                        </div>
                    </div>

                    <!-- Item 5 -->
                    <div class="achievement-item-prime wow fadeInUp" data-wow-delay="0.8s">
                        <div class="icon-box">
                            <i class="fa-solid fa-brain fa-2x"></i>
                        </div>
                        <div class="achievement-item-content-prime">
                            <h3>Capability Development</h3>
                            <p>Continuously improving industrial intelligence through adaptive learning and AI
                                capabilities.</p>
                        </div>
                    </div>

                    <!-- Item 6 -->
                    <div class="achievement-item-prime wow fadeInUp" data-wow-delay="1s">
                        <div class="icon-box">
                            <i class="fa-solid fa-chart-simple fa-2x"></i>
                        </div>
                        <div class="achievement-item-content-prime">
                            <h3>Pattern Recognition</h3>
                            <p>Automatically identify data patterns for smarter decisions and predictive maintenance.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Why Choose Us Section End  -->






<!-- Our Service Section Start -->
<div class="our-services bg-section dark-section">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title section-title-center">
                    <span class="section-sub-title wow fadeInUp">Product</span>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">Advanced Products for Connected Industries</h2>
                    <p>Explore intelligent solutions for predictive maintenance, industrial electronics, and real-time
                        data analytics.</p>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6">
                <!-- Service Item Start -->
                <div class="service-item wow fadeInUp">
                    <!-- Service Item Image Start -->
                    <div class="service-item-image">
                        <a href="{{ route('service') }}" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="{{ asset('public/assets/images/maintenance-solutions.jpeg') }}" alt="">
                            </figure>
                        </a>
                    </div>
                    <!-- Service Item Image End -->

                    <!-- Service Item Title Start -->
                    <div class="service-item-title">
                        <h2><a href="{{ route('service') }}">Maintenance & Solutions</a></h2>
                    </div>
                    <!-- Service Item Title End -->
                </div>
                <!-- Service Item End -->
            </div>

            <div class="col-xl-4 col-md-6">
                <!-- Service Item Start -->
                <div class="service-item wow fadeInUp" data-wow-delay="0.2s">
                    <!-- Service Item Image Start -->
                    <div class="service-item-image">
                        <a href="{{ route('service') }}" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="{{ asset('public/assets/images/industrial-electronics.jpeg') }}" alt="">
                            </figure>
                        </a>
                    </div>
                    <!-- Service Item Image End -->

                    <!-- Service Item Title Start -->
                    <div class="service-item-title">
                        <h2><a href="{{ route('service') }}">Industrial Electronics</a></h2>
                    </div>
                    <!-- Service Item Title End -->
                </div>
                <!-- Service Item End -->
            </div>

            <div class="col-xl-4 col-md-6 m-auto">
                <!-- Service Item Start -->
                <div class="service-item wow fadeInUp" data-wow-delay="0.4s">
                    <!-- Service Item Image Start -->
                    <div class="service-item-image">
                        <a href="{{ route('service') }}" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="{{ asset('public/assets/images/data-analytics-software.jpeg') }}" alt="">
                            </figure>
                        </a>
                    </div>
                    <!-- Service Item Image End -->

                    <!-- Service Item Title Start -->
                    <div class="service-item-title">
                        <h2><a href="{{ route('service') }}">Data & Analytics Software</a></h2>
                    </div>
                    <!-- Service Item Title End -->
                </div>
                <!-- Service Item End -->
            </div>


        </div>
    </div>
</div>
<!-- Our Service Section End -->



<!-- Our Project Section Start -->
<div class="our-projects">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title section-title-center">
                    <span class="section-sub-title wow fadeInUp">Our Projects</span>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">The Internet of Things for original equipment
                        manufacturers (OEMs)</h2>
                    <p>Digital skills are essential to maximise productivity and efficiency to a new level across a
                        company or environment. A full IoT solution can help you discover new potential revenue streams
                        and enable you to produce products (equipment) that are specifically tailored to your customers'
                        needs.</p>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <!-- Project Item Start -->
                <div class="project-item wow fadeInUp">
                    <!-- Project Item Image Start -->
                    <div class="project-item-image">
                        <a href="{{ route('subscription') }}" data-cursor-text="View">
                            <figure>
                                <img src="{{ asset('public/assets/images/thumb-1.jpg') }}" alt="">
                            </figure>
                        </a>
                    </div>
                    <!-- Project Item Image End -->

                    <!-- Project Item Body Start -->
                    <div class="project-item-body">


                        <!-- Project Item Contant Start -->
                        <div class="project-item-contant">
                            <h2><a href="https://techiedom.in/predictorMT/pricing">Differentiate Product</a></h2>
                            <p>With IoT-enabled items, you gain an advantage over rivals.</p>
                        </div>
                        <!-- Project Item Contant End -->
                    </div>
                    <!-- Project Item Body End -->
                </div>
                <!-- Project Item Start -->
            </div>

            <div class="col-xl-3 col-md-6">
                <!-- Project Item Start -->
                <div class="project-item wow fadeInUp" data-wow-delay="0.2s">
                    <!-- Project Item Image Start -->
                    <div class="project-item-image">
                        <a href="https://techiedom.in/predictorMT/pricing" data-cursor-text="View">
                            <figure>
                                <img src="{{ asset('public/assets/images/thumb-2.jpg') }}" alt="">
                            </figure>
                        </a>
                    </div>
                    <!-- Project Item Image End -->

                    <!-- Project Item Body Start -->
                    <div class="project-item-body">

                        <!-- Project Item Contant Start -->
                        <div class="project-item-contant">
                            <h2><a href="https://techiedom.in/predictorMT/pricing">Optimize efficiency</a></h2>
                            <p>Increase profitability by automating the procedures and cutting operating costs.</p>
                        </div>
                        <!-- Project Item Contant End -->
                    </div>
                    <!-- Project Item Body End -->
                </div>
                <!-- Project Item Start -->
            </div>

            <div class="col-xl-3 col-md-6">
                <!-- Project Item Start -->
                <div class="project-item wow fadeInUp" data-wow-delay="0.4s">
                    <!-- Project Item Image Start -->
                    <div class="project-item-image">
                        <a href="https://techiedom.in/predictorMT/pricing" data-cursor-text="View">
                            <figure>
                                <img src="{{ asset('public/assets/images/thumb-3.jpg') }}" alt="">
                            </figure>
                        </a>
                    </div>
                    <!-- Project Item Image End -->

                    <!-- Project Item Body Start -->
                    <div class="project-item-body">


                        <!-- Project Item Contant Start -->
                        <div class="project-item-contant">
                            <h2><a href="https://techiedom.in/predictorMT/pricing">Optimize efficiency</a></h2>
                            <p>Increase profitability by automating the procedures and cutting operating costs.</p>
                        </div>
                        <!-- Project Item Contant End -->
                    </div>
                    <!-- Project Item Body End -->
                </div>
                <!-- Project Item Start -->
            </div>

            <div class="col-xl-3 col-md-6">
                <!-- Project Item Start -->
                <div class="project-item wow fadeInUp" data-wow-delay="0.4s">
                    <!-- Project Item Image Start -->
                    <div class="project-item-image">
                        <a href="https://techiedom.in/predictorMT/pricing" data-cursor-text="View">
                            <figure>
                                <img src="{{ asset('public/assets/images/thumb-4.jpg') }}" alt="">
                            </figure>
                        </a>
                    </div>
                    <!-- Project Item Image End -->

                    <!-- Project Item Body Start -->
                    <div class="project-item-body">

                        <!-- Project Item Contant Start -->
                        <div class="project-item-contant">
                            <h2><a href="https://techiedom.in/predictorMT/pricing">Reduce downtime</a></h2>
                            <p>By using preventive maintenance, you may minimise production downtime.</p>
                        </div>
                        <!-- Project Item Contant End -->
                    </div>
                    <!-- Project Item Body End -->
                </div>
                <!-- Project Item Start -->
            </div>



        </div>
    </div>
</div>
<!-- Our Project Section End -->

<!-- Our Industries Section Start -->
<div class="our-industries p-0 pb-5">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-xl-6">
                <!-- Our Industries Contant Start -->
                <div class="our-industries-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <span class="section-sub-title wow fadeInUp">Industries We Serve</span>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Empowering Industries with AI-Driven
                            Predictive Maintenance</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">PredictorMT delivers intelligent monitoring,
                            predictive analytics, and real-time insights across diverse industrial sectors.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Industries Body Item List Start -->
                    <div class="industries-body-item-list wow fadeInUp" data-wow-delay="0.4s">

                        <!-- Warehousing -->
                        <div class="industries-body-item">
                            <div class="icon-box icon-box-color-2">
                                <i class="fa-solid fa-warehouse"></i>
                            </div>
                            <div class="industries-body-item-content">
                                <p>Warehousing</p>
                            </div>
                        </div>

                        <!-- Agriculture -->
                        <div class="industries-body-item">
                            <div class="icon-box icon-box-color-6">
                                <i class="fa-solid fa-seedling"></i>
                            </div>
                            <div class="industries-body-item-content">
                                <p>Agriculture</p>
                            </div>
                        </div>

                        <!-- Mining -->
                        <div class="industries-body-item">
                            <div class="icon-box icon-box-color-3">
                                <i class="fa-solid fa-mountain"></i>
                            </div>
                            <div class="industries-body-item-content">
                                <p>Mining</p>
                            </div>
                        </div>

                        <!-- Healthcare -->
                        <div class="industries-body-item">
                            <div class="icon-box icon-box-color-4">
                                <i class="fa-solid fa-hospital"></i>
                            </div>
                            <div class="industries-body-item-content">
                                <p>Healthcare</p>
                            </div>
                        </div>

                        <!-- Manufacturing -->
                        <div class="industries-body-item">
                            <div class="icon-box icon-box-color-1">
                                <i class="fa-solid fa-industry"></i>
                            </div>
                            <div class="industries-body-item-content">
                                <p>Manufacturing</p>
                            </div>
                        </div>

                        <!-- Logistics & Trucking -->
                        <div class="industries-body-item">
                            <div class="icon-box icon-box-color-5">
                                <i class="fa-solid fa-truck"></i>
                            </div>
                            <div class="industries-body-item-content">
                                <p>Logistics & Trucking</p>
                            </div>
                        </div>

                    </div>
                    <!-- Industries Body List Item End -->


                </div>
                <!-- Our Industries Contant End -->
            </div>

            <div class="col-xl-6">
                <!-- Industries Image Box Start -->
                <div class="industries-image-box wow fadeInUp" data-wow-delay="0.2s">
                    <!-- Industries Image Box 1 Start -->
                    <div class="industries-image-box1">
                        <!-- Industries Image Start -->
                        <div class="industries-image">
                            <figure class="image-anime">
                                <img src="{{ asset('public/assets/images/industries-image-1.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- Industries Image End -->
                    </div>
                    <!-- Industries Image Box 1 End -->

                    <!-- Industries Image Box 2 Start -->

                    <!-- Industries Image Box 2 End -->
                </div>
                <!-- Industries Image Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Our Industries Section End -->





<!-- Our Testimonials Section Start -->
<div class="our-testimonials">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-xl-6">
                <!-- Section Title Start -->
                <div class="section-title">
                    <span class="section-sub-title wow fadeInUp">Our Team</span>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">Meet the Experts Behind PredictorMT's
                        Innovation</h2>
                </div>
                <!-- Section Title End -->
            </div>


        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Testimonial Slider Start -->
                <div class="testimonial-slider wow fadeInUp">
                    <div class="swiper" data-cursor-text="Drag">
                        <div class="swiper-wrapper">
                            <!-- Testimonial Slide Start -->
                            <div class="swiper-slide">
                                <!-- Testimonial Item Start -->
                                <div class="testimonial-item">
                                    <!-- Testimonial Item Image Start -->
                                    <div class="testimonial-item-image">
                                        <figure>
                                            <img src="{{ asset('public/assets/images/team-1.png') }}" alt="">
                                        </figure>
                                    </div>
                                    <!-- Testimonial Item Image End -->

                                    <!-- Testimonial Item Body Start -->
                                    <div class="testimonial-item-body">
                                        <div class="testimonial-item-content">
                                            <p>Fellow of the Society of Actuaries (USA) with 30+ years of insurance,
                                                risk management, and executive leadership experience as CEO.</p>
                                        </div>
                                        <div class="testimonial-author-content">
                                            <h2>Mr. Javed Ahmed </h2>
                                            <small>Co-Founder & CEO</small>
                                        </div>
                                    </div>
                                    <!-- Testimonial Item Body End -->
                                </div>
                                <!-- Testimonial Item End -->
                            </div>
                            <!-- Testimonial Slide End -->

                            <!-- Testimonial Slide Start -->
                            <div class="swiper-slide">
                                <!-- Testimonial Item Start -->
                                <div class="testimonial-item">
                                    <!-- Testimonial Item Image Start -->
                                    <div class="testimonial-item-image">
                                        <figure>
                                            <img src="{{ asset('public/assets/images/team-2.png') }}" alt="">
                                        </figure>
                                    </div>
                                    <!-- Testimonial Item Image End -->

                                    <!-- Testimonial Item Body Start -->
                                    <div class="testimonial-item-body">
                                        <div class="testimonial-item-content">
                                            <p>Bachelor of Commerce with 18+ years of experience in business
                                                development, operations management, transportation, logistics, and
                                                industrial client relations.</p>
                                        </div>
                                        <div class="testimonial-author-content">
                                            <h2>Mr. Muhammad Aboobakar</h2>
                                            <small>Co-Founder & CBO</small>
                                        </div>
                                    </div>
                                    <!-- Testimonial Item Body End -->
                                </div>
                                <!-- Testimonial Item End -->
                            </div>
                            <!-- Testimonial Slide End -->

                            <!-- Testimonial Slide Start -->
                            <div class="swiper-slide">
                                <!-- Testimonial Item Start -->
                                <div class="testimonial-item">
                                    <!-- Testimonial Item Image Start -->
                                    <div class="testimonial-item-image">
                                        <figure>
                                            <img src="{{ asset('public/assets/images/team-3.png') }}" alt="">
                                        </figure>
                                    </div>
                                    <!-- Testimonial Item Image End -->

                                    <!-- Testimonial Item Body Start -->
                                    <div class="testimonial-item-body">
                                        <div class="testimonial-item-content">
                                            <p>Bachelor of Engineering in Electronics with 20+ years of expertise in
                                                predictive maintenance, technology development, operations management,
                                                and industrial consulting.</p>
                                        </div>
                                        <div class="testimonial-author-content">
                                            <h2>Mr. Aamir Aslam</h2>
                                            <small>Co-Founder & COO</small>
                                        </div>
                                    </div>
                                    <!-- Testimonial Item Body End -->
                                </div>
                                <!-- Testimonial Item End -->
                            </div>
                            <!-- Testimonial Slide End -->

                            <!-- Testimonial Slide Start -->
                            <div class="swiper-slide">
                                <!-- Testimonial Item Start -->
                                <div class="testimonial-item">
                                    <!-- Testimonial Item Image Start -->
                                    <div class="testimonial-item-image">
                                        <figure>
                                            <img src="{{ asset('public/assets/images/team-4.png') }}" alt="">
                                        </figure>
                                    </div>
                                    <!-- Testimonial Item Image End -->

                                    <!-- Testimonial Item Body Start -->
                                    <div class="testimonial-item-body">
                                        <div class="testimonial-item-content">
                                            <p>Mechanical Engineer with an M.Eng. in Machine Design and extensive
                                                expertise in predictive maintenance, data analytics, technical
                                                leadership, and system implementation.</p>
                                        </div>
                                        <div class="testimonial-author-content">
                                            <h2>Mr. Fahad Ahmed</h2>
                                            <small>Co-Founder & CTO</small>
                                        </div>
                                    </div>
                                    <!-- Testimonial Item Body End -->
                                </div>
                                <!-- Testimonial Item End -->
                            </div>
                            <!-- Testimonial Slide End -->
                        </div>
                    </div>

                    <div class="testimonial-pagination"></div>
                </div>
                <!-- Testimonial Slider End -->
            </div>


        </div>
    </div>
</div>
<!-- Our Testimonials Section End -->

@include('include.footer')