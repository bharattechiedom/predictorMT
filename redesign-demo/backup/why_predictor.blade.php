@include('include.header')

<div class="condition-div">
    <div class="custom-breadcrumb mt-0">
        <span class="home-icon">
            <i class="fa-solid fa-house"></i>
        </span>

        <a href="{{ route('home')}}">Home</a>
        <span class="arrow">›</span>

        <a href="#">Why PredictorMT </a>
        <span class="arrow">›</span>

    </div>
    <section class="container-fluid bg-black py-5" id="predictor">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <h3 class="title text-center p-3">Why Predictor MT</h3>
                    <div class="text-center " data-aos="fade-down">
                        <img src="{{ asset('public/assets/images/9.png')}}" alt="" class="mrt-31 arwimg">
                    </div>


                </div>
            </div>
            <div class="row  mt-5">

                <div class="col-md-4 col-sm-12" data-aos="zoom-in">
                    <div class="choose-m bg-light">
                        <img src="{{ asset('public/assets/images/1.png')}}" alt="domain-solution" class="choose-text">
                        <img src="{{ asset('public/assets/images/1_1.png')}}" alt="domain-solution-hover" class="choose-text-hover">
                        <h4 class="pt-1">A Full IoT Solution</h4>
                        <p>The most thorough and complete IoT solutions for connectivity support, security, and end-to-end
                            administration of devices, applications, and devices.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12" data-aos="zoom-in">
                    <div class="choose-m bg-light changecard">
                        <img src="{{ asset('public/assets/images/2.png')}}" alt="domain-solution" class="choose-text">
                        <img src="{{ asset('public/assets/images/2_1.png')}}" alt="domain-solution-hover" class="choose-text-hover">
                        <h4 class="pt-1">Pre-configured vertical business domain solution</h4>
                        <p>Provide gateways, network, comprehensive software and support services for an end-to-end IoT solution.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12" data-aos="zoom-in">
                    <div class="choose-m bg-light">
                        <img src="{{ asset('public/assets/images/3.png')}}" alt="fast-time-market" class="choose-text">
                        <img src="{{ asset('public/assets/images/3_1.png')}}" alt="fast-time-market-hover" class="choose-text-hover">
                        <h4 class="pt-1">Time to market is quick </h4>
                        <p>In five business days, the solution's initial iteration will be released, featuring reports for up to 10
                            devices. effective setup and package management.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12" data-aos="zoom-in">
                    <div class="choose-m bg-light changecard ">
                        <img src="{{ asset('public/assets/images/4.png')}}" alt="flexibility-image" class="choose-text">
                        <img src="{{ asset('public/assets/images/4_1.png')}}" alt="flexibility-image-hover" class="choose-text-hover">
                        <h4 class="pt-1">Modular, flexible, scalable <span>&amp; standardized </span></h4>
                        <p>Take advantage of our modular architecture, repeatable procedures, and qualified resources to achieve the
                            highest levels of flexibility, scalability, and security</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12" data-aos="zoom-in">
                    <div class="choose-m bg-light ">
                        <img src="{{ asset('public/assets/images/5.png')}}" alt="domain-solution" class="choose-text">
                        <img src="{{ asset('public/assets/images/5_1.png')}}" alt="domain-solution-hover" class="choose-text-hover">
                        <h4 class="pt-1">Progressive Capability Development</h4>
                        <p>Even if they veer slightly off-topic, all initiatives and contracts advance the main objective and assist
                            tactics.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12" data-aos="zoom-in">
                    <div class="choose-m bg-light changecard">
                        <img src="{{ asset('public/assets/images/6.png')}}" alt="domain-solution" class="choose-text">
                        <img src="{{ asset('public/assets/images/6_1.png')}}" alt="domain-solution-hover" class="choose-text-hover">
                        <h4 class="pt-1">Automatic Data Pattern Recognition And Learning</h4>
                        <p>solutions for automatic data pattern recognition and built-in domain-specific learning that are specialised
                            to satisfy specific business demands.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@include('include.footer')