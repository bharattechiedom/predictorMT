@include('include.header')



<section class="banner-video mx-0 px-0 ">

  <div id="hero" class="d-flex align-items-center  col-sm-12">

    <video autoplay muted loop id="myVideo" width="100%">

      <source src="{{ asset('public/assets/media/1.mp4') }}" type="video/mp4">

    </video>

  </div>

</section>



<div class="clearfix"></div>







<section class="bg-black py-5" id="solutions">
  <div class="container">
    <div class="row">
      <div class="col-md-6  col-sm-12 pt-4" data-aos="fade-right">
        <img src="{{ asset('public/assets/user/images/solution.png') }}" alt="" width="100%" style="
    /* right: 30px; */
    position: relative;
    width: 550px;
    height: auto;
" class="solution-img">
      </div>
      <div class="col-md-6  col-sm-12 pt-4">
        <h3 class="title  p-3" data-aos="fade-up">Solutions</h3>
        <div class="" data-aos="fade-down">
          <img src="{{ asset('public/assets/images/9.png') }}" alt="" class="mrt-31 arwimg" style=" margin-left: 36px; width: 34%;bottom: 16px;position: relative;padding: 0px 0px 0px 50px;margin: 0;">
        </div>
        <h6 class="p-1 text-white solution-h6"> (An End-To-End IoT Business Solution) <span>PredictorMT</span> </h6>
        <p class="text-white justify-content-start" data-aos="fade-left">PredictorMT is an innovative platform
          revolutionizing predictive maintenance with cutting-edge
          technology. By seamlessly integrating IoT sensors, historical data, and external factors, PredictorMT
          offers real-time insights into asset health. Organizations benefit from proactive maintenance
          scheduling, cost reduction, and optimized asset performance. With PredictorMT, businesses can
          transition from reactive to proactive maintenance strategies.
        </p>
        <div class="soution">
          <a href="{{route('solution')}}">
            <button class="btn solution-btn">Know More</button>

          </a>
        </div>
      </div>
    </div>
  </div>

</section>
<div class="clearfix"></div>



<section class="container-fluid bg-black" id="predictor">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <h3 class="title text-center p-3">Why Predictor MT</h3>
        <div class="text-center " data-aos="fade-down">
          <img src="{{ asset('public/assets/images/9.png')}}" alt="" class="mrt-31 arwimg">
        </div>


      </div>
    </div>
    <div class="row  ">

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


<div class="clearfix"></div>

<section class="testi_home" id="team">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="testi_slider">
          <div class="owl-carousel owl-theme owl-loaded owl-drag">
            <div class="owl-stage-outer">
              <div class="owl-stage"
                style="transform: translate3d(-2232px, 0px, 0px); transition: all 0.25s ease 0s; width: 8928px;">
                <div class="owl-item cloned" style="width: 1116px;">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="post-thumb">
                        <a href="#" class="post-image-link  team-img-box">
                          <img src="{{ asset('public/assets/images/PM1.png') }}" class="img-fluid squared">
                        </a>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="media-body">
                        <div class="post-excerpt">
                          <h3 class="title  p-3" data-aos="fade-up">Our Team</h3>
                          <div class="heding-team-img" data-aos="fade-down">
                            <img src="{{ asset('public/assets/images/9.png') }}" alt="arrow" style="
    padding: 0;
    display: block;
    width: 100%;
    max-width: 120px;
    height: auto;
    object-fit: cover;
    justify-content: flex-start;
    /* margin: 0 auto; */
    position: relative;
        margin-left: 50px;
    margin-right: auto;
    bottom: 15px;
">
                          </div>
                          <ul class="text-white pt-4">
                            <li>Fellow of Society of Actuaries, USA</li>
                            <li> 30 years experience in Insurance and Risk Management</li>
                            <li>As CEO, I am responsible for overseeing all the affairs of the company from product and
                              services design, launch, customer service to regulatory compliance.
                            </li>
                          </ul>
                        </div>
                        <div class="col-md-12 col-sm-12">
                          <div class="post_desig">
                            <h4 class="post-title-head"><a href="{{route('team')}}">Mr. Javed Ahmed </a></h4>
                            <h5 class="testimonial-designation text-white">Co-Founder & CEO
                            </h5>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="owl-item cloned" style="width: 1116px;">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="post-thumb">
                        <a href="#" class="post-image-link">
                          <img src="{{ asset('public/assets/images/PM2.png') }}" class="img-fluid squared">
                        </a>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="media-body">
                        <div class="post-excerpt">
                          <h3 class="title  p-3" data-aos="fade-up">Our Team</h3>
                          <div class="heding-team-img" data-aos="fade-down">
                            <img src="{{ asset('public/assets/images/9.png') }}" alt="arrow" style="
    padding: 0;
    display: block;
    width: 100%;
    max-width: 120px;
    height: auto;
    object-fit: cover;
    justify-content: flex-start;
    /* margin: 0 auto; */
    position: relative;
        margin-left: 50px;
    margin-right: auto;
    bottom: 15px;
">
                          </div>
                          <ul class="text-white pt-4">
                            <li>Bringing to the Predictor team over 18 years of experience in business development and
                              operations management in transportation and logistics, where I have worked with several
                              clients from the industrial and manufacturing sectors
                            </li>
                            <li>Bachelor of Commerce</li>
                          </ul>
                        </div>
                        <div class="col-md-12 col-sm-12">
                          <div class="post_desig">
                            <h4 class="post-title-head"><a href="{{route('team')}}">Mr. Muhammad Aboobakar</a></h4>
                            <h5 class="testimonial-designation  text-white">Co-Founder & CBO </h5>
                          </div>
                        </div>


                      </div>
                    </div>

                  </div>
                </div>
                <div class="owl-item active" style="width: 1116px;">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="post-thumb">

                        <a href="#" class="post-image-link">
                          <img src="{{ asset('public/assets/images/PM3.png') }}" class="img-fluid squared">
                        </a>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="media-body">
                        <div class="col-md-12 col-sm-12">
                          <div class="post-excerpt">

                            <h3 class="title  p-3" data-aos="fade-up">Our Team</h3>
                            <div class="heding-team-img" data-aos="fade-down">
                              <img src="{{ asset('public/assets/images/9.png') }}" alt="arrow" style="width: 100%;margin-left: 39px;margin-top: -6px;/* height: 47px !important; */object-fit: cover;max-width: 168px;height: auto !important;">
                            </div>
                            <ul class="text-white pt-4">
                              <li>Bachelor of Engineering - Electronics</li>

                              <li> Over 20 years industrial experience in preventative and predictive maintenance.</li>

                              <li>At PredictorMT, he has continued to use his expertise to manage the company's operations,
                                including developing business plans, overseeing technology development, alpha testing of
                                platform modules, and consulting with industry partners and the Founding team for the
                                launch.</li>
                            </ul>
                          </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                          <div class="post_desig">
                            <h4 class="post-title-head"><a href="{{route('team')}}">Mr. Aamir Aslam</a></h4>
                            <h5 class="testimonial-designation  text-white">Co-Founder & COO</h5>
                          </div>
                        </div>

                      </div>
                    </div>

                  </div>
                </div>
                <div class="owl-item" style="width: 1116px;">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="post-thumb">
                        <a href="#" class="post-image-link">
                          <img src="{{ asset('public/assets/images/PM4.png') }}" class="img-fluid squared">
                        </a>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="media-body">
                        <div class="post-excerpt">
                          <div class="team-heading" data-aos="fade-up">
                            <h3 class="title p-3">Our Team</h3>

                            <div class="heding-team-img" data-aos="fade-down">
                              <img src="{{ asset('public/assets/images/9.png') }}" alt="arrow" style="width: 100%;margin-left: 39px;margin-top: -6px;/* height: 47px !important; */object-fit: cover;max-width: 168px;height: auto !important;">
                            </div>
                          </div>

                          <ul class="text-white pt-4">
                            <li>M. Eng. in Machine Designing & B. Eng. Mechanical

                            <li> 12 years at Mecha Tronic International - Engineer</li>

                            <li>Managing teams for implementation, testing, maintenance, and system improvements.</li>

                            <li>Leading development of PredictorMT’s technical data lake, and statistical analysis for
                              preventative and predictive maintenance modelling.</li>
                          </ul>
                        </div>
                        <div class="col-md-12 col-sm-12">
                          <div class="post_desig">
                            <h4 class="post-title-head"><a href="{{route('team')}}">Mr. Fahad Ahmed</a></h4>
                            <h5 class="testimonial-designation text-white">Co-Founder & CTO</h5>
                          </div>
                        </div>

                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span
                  aria-label="Previous">‹</span></button><button type="button" role="presentation"
                class="owl-next"><span aria-label="Next">›</span></button></div>
            <div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button
                role="button" class="owl-dot"><span></span></button><button role="button"
                class="owl-dot"><span></span></button><button role="button" class="owl-dot"><span></span></button></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="clearfix"></div>



<section class="testi_home service-section service-feature" >


  <style>

  </style>

  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <h3 class="title text-center p-3" data-aos="fade-up">Predictor MT Services</h3>
        <div class="text-center " data-aos="fade-down">
          <img src="{{ asset('public/assets/images/9.png') }}" alt="" class="mrt-31 arwimg">
        </div>
      </div>

    </div>
  </div>
  <section class="services-section">

    <div class="services-left">
      <div class="circle-outer"></div>
      <div class="circle-middle"></div>
      <div class="circle-inner">
        <h2>OUR<br>SERVICES</h2>
        <div class="yellow-line"></div>

        <p>WHAT WE DO</p>
      </div>
      <div class="container">
        <svg class="d-arc-svg" width="400" height="400" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M0 0 
         A185 185 0 0 1 0 370"
            fill="none"
            stroke="#004d62"
            stroke-width="2"
            stroke-dasharray="15,15" />
        </svg>
      </div>

      <div class="connecting-lines">
        <div class="line line1 cyan">
          <div class="dot-start cyan"></div>
        </div>
        <div class="line line2 orange">
          <div class="dot-start orange"></div>
        </div>
        <div class="line line3 blue">
          <div class="dot-start blue"></div>
        </div>
        <div class="line line4 yellow">
          <div class="dot-start yellow"></div>
        </div>
      </div>
    </div>

    <div class="services-right">

      <div class="service-card card1">
        <div class="img-left">
          <img src="{{ asset('public/assets/images/device.png') }}">
        </div>

        <h4><span>Device</span> Management</h4>

        <div class="img-right">
          <img src="{{ asset('public/assets/images/device-right.png') }}">
        </div>
      </div>
      <div class="service-card card2">
        <div class="img-left">
          <img src="{{ asset('public/assets/images/reporting.png') }}">
        </div>

        <h4><span>Reporting & Notification </span> Management</h4>

        <div class="img-right">
          <img src="{{ asset('public/assets/images/reporting-right.png') }}">
        </div>
      </div>
      <div class="service-card card3">
        <div class="img-left">
          <img src="{{ asset('public/assets/images/custom.png') }}">
        </div>

        <h4><span>Custom</span> Functionality</h4>

        <div class="img-right">
          <img src="{{ asset('public/assets/images/custom-right.png') }}">
        </div>
      </div>
      <div class="service-card card4">
        <div class="img-left">
          <img src="{{ asset('public/assets/images/data analytics.png') }}">
        </div>

        <h4><span>Advance</span> Data Analysis</h4>

        <div class="img-right">
          <img src="{{ asset('public/assets/images/data-right.png') }}">
        </div>
      </div>

    </div>


    </div>
  </section>

</section>



<section class=" py-0">



  <div class="clearfix"></div>




  <section class="bg-black py-5">
    <div class="container">
      <div class="row">
        <h3 class="title text-center p-3" data-aos="fade-up">The Internet of Things for original equipment<br>
          manufacturers (OEMs)</h3>
        <div class="text-center " data-aos="fade-down">
          <img src="{{ asset('public/assets/images/9.png') }}" alt="" class="mrt-31 arwimg">
        </div>
      </div>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <p class="text-center text-white p-3">Digital skills are essential to maximise productivity and efficiency to a
            new level across a company or environment. A full IoT solution can help you discover new potential revenue
            streams and enable you to produce products (equipment) that are specifically tailored to your customers'
            needs.</p>
        </div>
        <div class="col-md-2"></div>

      </div>
      <div class="row">
        <div class="col-md-3 col-sm-12">
          <div class="card bg-dark text-white hover-half-shadow" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
            <img src="{{ asset('public/assets/images/re1.jpg') }}" class="card-img" alt="Stony Beach" />
            <div class="card-img-overlay" style="background-color: rgba(0, 0, 0, 0.3);padding: 238px 26px 0px 26px;z-index: 9999;">
              <h5 class="card-title text-center">Differentiate Product</h5>
              <p class="card-text text-center">
                With IoT-enabled items, you gain an advantage over rivals.
              </p>

            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-12">
          <div class="card bg-dark text-white hover-half-shadow" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
            <img src="{{ asset('public/assets/images/re2.jpg') }}" class="card-img" alt="Stony Beach" />
            <div class="card-img-overlay" style="background-color: rgba(0, 0, 0, 0.3);padding: 238px 0px 0px 0px;z-index: 9999;">
              <h5 class="card-title text-center">Increase service-level</h5>
              <p class="card-text text-center">
                By producing IoT-enabled items, you can raise the after-sale service standard.</p>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-12">
          <div class="card bg-dark text-white hover-half-shadow" style="height:auto; width:auto;" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
            <img src="{{ asset('public/assets/images/re4.jpg') }}" class="card-img" alt="Stony Beach" />
            <div class="card-img-overlay" style="background-color: rgba(0, 0, 0, 0.3);padding: 238px 0px 0px 0px;z-index: 9999;">
              <h5 class="card-title text-center">Optimize efficiency</h5>
              <p class="card-text text-center">Increase profitability by automating the procedures and cutting operating
                costs.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-12">
          <div class="card bg-dark text-white hover-half-shadow" style="height:auto;width:auto;" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
            <img src="{{ asset('public/assets/images/re3.jpg') }}" class="card-img" alt="Stony Beach" />
            <div class="card-img-overlay" style="background-color: rgba(0, 0, 0, 0.3);padding: 238px 0px 0px 0px;z-index: 9999;">
              <h5 class="card-title text-center">Reduce downtime</h5>
              <p class="card-text text-center">By using preventive maintenance, you may minimise production downtime.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




  <!-- Font Awesome -->











  <section class="bg-black py-3" id="industries ">
    <div class="container">
      <div class="row">
        <div class="col-md-12 pt-0">
          <h3 class="title text-center p-3" data-aos="fade-up">Industries We Serve</h3>
          <div class="text-center " data-aos="fade-down">
            <img src="{{ asset('public/assets/images/9.png') }}" alt="" class="mrt-31 arwimg">
          </div>
        </div>
      </div>
      <div class="row ">
        <div class="world-section">
          <div class="infinite-slider">
            <div class="slide-track" id="track">

              <div class="img-wrap blue">
                <img src="{{ asset('public/assets/images/industry_serve1.png') }}" alt="">
              </div>

              <div class="img-wrap orange">
                <img src="{{ asset('public/assets/images/industry_serve2.png') }}" alt="">
              </div>

              <div class="img-wrap darkblue ">
                <img src="{{ asset('public/assets/images/industry_serve3.png') }}" alt="">
              </div>

              <div class="img-wrap green">
                <img src="{{ asset('public/assets/images/industry_serve4.png') }}" alt="">
              </div>

              <div class="img-wrap red ">
                <img src="{{ asset('public/assets/images/industry_serve5.png') }}" alt="">
              </div>

              <div class="img-wrap pink">
                <img src="{{ asset('public/assets/images/industry_serve6.png') }}" alt="">
              </div>

            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="bg-black py-5">


    <div class="container">
      <div class="row">
        <div class="col-md-12 pt-4">
          <h3 class="title text-center p-3" data-aos="fade-up">Architecture For End To End IoT Solutions</h3>
          <div class="text-center " data-aos="fade-down">
            <img src="{{ asset('public/assets/images/9.png') }}" alt="" class="mrt-31 arwimg">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2 col-sm-6 col-xs-12" data-aos="fade-left" data-aos-offset="300">
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12" data-aos="fade-left" data-aos-offset="300"
          data-aos-easing="ease-in-sine">
          <div class="work-detail wow fadeInLeft" data-wow-delay="0.2s"
            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
            <h6>IoT
              <br>
              Endpoints
            </h6>
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12" data-aos="fade-left" data-aos-offset="300"
          data-aos-easing="ease-in-sine">
          <div class="work-detail wow fadeInLeft" data-wow-delay="0.4s"
            style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
            <h6>IoT Edge platform <br>(Gateways)</h6>
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12" data-aos="fade-left" data-aos-offset="300"
          data-aos-easing="ease-in-sine">
          <div class="work-detail wow fadeInLeft" data-wow-delay="0.6s"
            style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInLeft;">
            <h6>IoT Platform<br>
              Hub</h6>
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12" data-aos="fade-left" data-aos-offset="300"
          data-aos-easing="ease-in-sine">
          <div class="work-detail last-one wow fadeInLeft" data-wow-delay="0.8s"
            style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInLeft;">
            <h6>Enterprise
              <br>
              Applications
            </h6>
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12" data-aos="fade-left" data-aos-offset="300">
        </div>
      </div>
    </div>
  </section>




















  <section class="py-5 dataIngestion" style="background-image: url(public/assets/images/bg4.png);">

    <div class="container">

      <div class="row ">

        <div class="col-md-12 col-sm-12">

          <div data-aos="zoom-in-up" class="solution-bg">

            <img src="{{ asset('public/assets/images/123.png') }}" alt="">



          </div>

        </div>

      </div>

    </div>

  </section>

  <section style="background-image:url('public/assets/images/bg3.png');  background-position: center; background-repeat: no-repeat;   background-size: cover;">

    <div class="container py-5">

      <div class="row">

        <div class="col-md-12 pt-4 pb-2">

          <div class="col-md-6 col-sm-12">

            <h3 class="title" style="padding:0;" data-aos="fade-up">Begin Your IoT Journey</h3>


          </div>

          <div class="col-md-4"></div>

          <div class="col-md-4"></div>

        </div>

        <div class="col-md-12 pb-4">

          <div class="col-md-7 col-sm-12">

            <p class="text-white p-2  iot-section-p" data-aos="fade-down-left">

              Do you want to discover how the IoT may help you grow your company? Are you interested in the pricing and

              the installation process of the intel IoT business solution?

            </p>

            <a href="{{ route('contact') }}" class="btn btn-light ios-btn" data-aos="fade-down-right">Contact Our IoT Expert</a>

          </div>

          <div class="col-md-6s"></div>

        </div>

      </div>

  </section>





  <script>
    const video = document.querySelector('.center-circle video');

    const img = document.querySelector('.center-circle img');

    let showVideo = true;



    setInterval(() => {

      if (showVideo) {

        video.classList.remove('active');

        img.classList.add('active');

      } else {

        img.classList.remove('active');

        video.classList.add('active');

      }

      showVideo = !showVideo;

    }, 4000);
  </script>

  <script>
    function openTab(evt, tabName) {
      document.querySelectorAll(".tab-content").forEach(t => t.classList.remove("active"));
      document.getElementById(tabName).classList.add("active");

      document.querySelectorAll(".tab-buttons button").forEach(b => b.classList.remove("active"));
      evt.currentTarget.classList.add("active");
    }
  </script>



  <script>
    const track = document.getElementById("track");
    let slides = Array.from(track.children);

    // 🔁 clone all slides ONCE
    slides.forEach(slide => {
      track.appendChild(slide.cloneNode(true));
    });

    let index = 0;

    function visibleCount() {
      return window.innerWidth <= 768 ? 1 : 4;
    }

    function slide() {
      const slideWidth = slides[0].offsetWidth;
      index++;

      track.style.transition = "transform 0.8s ease-in-out";
      track.style.transform = `translateX(-${slideWidth * index}px)`;

      // 🧠 invisible reset (NO JUMP)
      if (index === slides.length) {
        setTimeout(() => {
          track.style.transition = "none";
          track.style.transform = "translateX(0)";
          index = 0;
        }, 900);
      }
    }

    // ⏸️ 1 sec pause + slide
    setInterval(slide, 1800);
  </script>


  <style>
    .world-section {
      width: 100%;
      height: 350px;
      background-image: url("public/assets/images/worldmap.png");
      background-size: cover;
      background-position: center;
      overflow: hidden;
      display: flex;
      align-items: center;
    }
  </style>

  @include('include.footer')