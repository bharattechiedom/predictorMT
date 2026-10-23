@include('include.header')



<div class="condition-div">


  <div class="custom-breadcrumb mt-0">
    <span class="home-icon">
      <i class="fa-solid fa-house"></i>
    </span>

    <a href="{{ route('home')}}">Home</a>
    <span class="arrow">›</span>

    <a href="#">About Us</a>
    <span class="arrow">›</span>

  </div>
  <div class="clearfix"></div>

  <div class="aboutus-container">

    <!-- LEFT : IMAGE -->
    <div class="left image-side">
      <img src="{{ asset('public/assets/user/images/solution.png') }}" alt="" width="100%">
    </div>

    <!-- RIGHT : TEXT -->
    <div class="right text-side">
      <div class="logo">
        <h3 class="title text-left p-3 aos-init aos-animate">About Us</h3>
      </div>

      <img src="{{ asset('public/assets/images/9.png') }}" alt=""
        class="mrt-31 arwimg"
        style="width: 22%;margin-left:15px;position:relative;">

      <h6 class="p-1 text-white solution-h6"> (An End-To-End IoT Business Solution) <span>PredictorMT</span> </h6>


      <p class="text-white justify-content-start" data-aos="fade-left">
        PredictorMT is an innovative platform revolutionizing predictive maintenance with cutting-edge
        technology. By seamlessly integrating IoT sensors, historical data, and external factors,
        PredictorMT offers real-time insights into asset health. Organizations benefit from proactive
        maintenance scheduling, cost reduction, and optimized asset performance.
      </p>
    </div>

  </div>

 <section class="reason-section">
  <div class="container-fluid">
    <div class="row reason-container g-5">

      <!-- LEFT IMAGE -->
      <div class="col-lg-4 col-md-6">
        <div class="reason-image">
          <img src="{{ asset('public/assets/images/whychoose.jpg') }}" alt="whychoose">
        </div>
      </div>

      <!-- RIGHT CONTENT -->
      <div class="col-lg-8 col-md-6">
        <div class="reason-content">

          <h6>Why <span>PredictorMt</span> <span class="qmark">?</span></h6>
          <h2>Reason for chosen us</h2>

          <p class="desc">
            We deliver professional, reliable, and cost-effective solutions for your business.
          </p>

          <div class="reason-grid">

            <div class="reason-box">
              <i class="fa-solid fa-microchip"></i>
              <div>
                <h4>End-to-End IoT Solution</h4>
                <p>Complete IoT ecosystem covering sensors, analytics, and predictive maintenance.</p>
              </div>
            </div>

            <div class="reason-box">
              <i class="fa-solid fa-chart-line"></i>
              <div>
                <h4>Predictive Maintenance</h4>
                <p>Prevent failures before they happen with intelligent predictions.</p>
              </div>
            </div>

            <div class="reason-box">
              <i class="fa-solid fa-wave-square"></i>
              <div>
                <h4>Real-Time Sensor Data</h4>
                <p>Live asset monitoring through seamless IoT sensor integration.</p>
              </div>
            </div>

            <div class="reason-box">
              <i class="fa-solid fa-coins"></i>
              <div>
                <h4>Cost Optimization</h4>
                <p>Reduce downtime and maintenance costs efficiently.</p>
              </div>
            </div>

            <div class="reason-box">
              <i class="fa-solid fa-database"></i>
              <div>
                <h4>Data-Driven Insights</h4>
                <p>Actionable insights using historical and real-time data.</p>
              </div>
            </div>

            <div class="reason-box">
              <i class="fa-solid fa-brain"></i>
              <div>
                <h4>Automatic Data Pattern Recognition And Learning</h4>
                <p>Solutions for automatic data pattern recognition with built-in domain-specific learning.</p>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</section>






</div>


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
<div class="clearfix"></div>










@include('include.footer')