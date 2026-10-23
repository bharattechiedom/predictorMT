@include('include.header')

<style>

#team-section {

  background: #000000;

  padding: 80px 0;

}



.team-subtitle {

color: #51ade5;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: 1px;

    margin-bottom: 10px;

    font-size: 20px;

}



.team-title {

  font-size: 30px;

  font-weight: 700;

  color: #222;

  line-height: 1.3;

}



.team-text {

  font-size: 16px;

  color: white;

  line-height: 1.8;

  margin-top: 15px;

}



.team-box {

  border: 1px solid #51ade5;

  text-align: center;

  position: relative;

  border-radius: 15px;

  background: #fff;

  height: 100%;

  padding: 10px;

  transition: all 0.3s ease;

  box-shadow: 8px 8px 0 #51ade5;

  display: flex;

  flex-direction: column;

  justify-content: space-between;

}





.team-img {

  position: relative;

  overflow: hidden;

  border-radius: 10px;

  height: auto; 

}

.team-img img {

  width: 100%;

  height: 100%;

  object-fit: cover;

  border-radius: 10px;

  transition: 0.4s ease;

}

.team-img .overlay {

  position: absolute;

  inset: 0;

  background: rgb(81 173 229 / 64%);

  color: #fff;

  opacity: 0;

  display: flex;

  justify-content: flex-start; /* top align */

  align-items: flex-start; /* top align */

  text-align: left;

  padding: 15px;

  transition: 0.4s ease;

  border-radius: 10px;

  overflow-y: auto; /* enables scroll if text is long */

  scrollbar-width: thin;

  scrollbar-color: #fff rgba(255, 255, 255, 0.2);

}

.team-img .overlay::-webkit-scrollbar {

  width: 6px;

}



.team-img:hover .overlay {

  opacity: 1;

}



.team-img:hover img {

  transform: scale(1.05);

}



.team-info {

  background: aliceblue;

  border-radius: 10px;

  padding: 12px 5px;

  margin-top: 10px;

  flex-grow: 0;

}



.team-info h5 {

  font-size: 18px;

  font-weight: 600;

  color: #222;

  margin-bottom: 5px;

}



.team-info p {

  color: #777;

  font-size: 14px;

  margin-bottom: 0;

}

/* --- NEW SOCIAL ICONS --- */

.team-social {

  margin-top: 8px;

  display: flex;

  justify-content: center;

  gap: 8px;

}

.team-social a {

  width: 30px;

  height: 30px;

  display: inline-flex;

  justify-content: center;

  align-items: center;

  background-color: #51ade5;

  color: white;

  border-radius: 50%;

  font-size: 14px;

  transition: 0.3s ease;

  text-decoration: none;

}

.team-social a:hover {

  background-color: #3a8ec2;

}





@media (max-width: 768px) {

  .team-title {

    font-size: 28px;

  }



  .team-text {

    text-align: center;

  }



  .team-box {

    margin-bottom: 30px;

  }

}



</style>

<div class="condition-div">
  <div class="custom-breadcrumb mt-0">
    <span class="home-icon"><i class="fa-solid fa-house"></i></span>
    <a href="{{ route('home') }}">Home</a>
    <span class="arrow">›</span>
    <a href="#">Our Team</a>
    <span class="arrow">›</span>
  </div>

<section id="team-section" class="py-5">

  <div class="container">

    <div class="row align-items-center mb-5">

      <div class="col-lg-6 col-md-12">

        <div class="team-header">

   <div class="logo">
        <div class="logo-text">Our Team</div>
      </div>

      <img src="{{ asset('public/assets/images/9.png') }}" alt=""
        class="mrt-31 arwimg"
        style="width: 18%;margin-left:0;position:relative;bottom: 20px;">
      <h6 class="p-1 text-white"> The Creative Minds Behind the <br><span>Work We Love</span> </h3>

        </div>

      </div>

      <div class="col-lg-6 col-md-12">

        <p class="team-text">

         PredictorMT is an innovative platform revolutionizing predictive maintenance with cutting-edge technology.

          By seamlessly integrating IoT sensors, historical data, and external factors, PredictorMT offers real-time

          insights into asset health. Organizations benefit from proactive maintenance scheduling, cost reduction, and

          optimized asset performance. With PredictorMT, businesses can transition from reactive to proactive maintenance

          strategies, ensuring operational efficiency and minimizing downtime.

        </p>

      </div>

    </div>



    <div class="row g-4">

      <div class="col-md-3 col-sm-6">

        <div class="team-box">

          <div class="team-img">

            <img src="{{ asset('public/assets/images/PM1.png') }}" alt="John Doe">

            <div class="overlay">

 <ul class="text-white p-3 text-start" style="list-style-type: disc;">

                            <li>Fellow of Society of Actuaries, USA</li>

                            <li> 30 years experience in Insurance and Risk Management</li>

                            <li>As CEO, I am responsible for overseeing all the affairs of the company from product and

                              services design, launch, customer service to regulatory compliance.

                            </li>

                          </ul>            </div>

          </div>

          <div class="team-info">

            <h5>Mr. Javed Ahmed </h5>

            <p>Co-Founder & CEO</p>

             <div class="team-social">

              <a href="#"><i class="fab fa-facebook-f"></i></a>

              <a href="#"><i class="fab fa-twitter"></i></a>

              <a href="#"><i class="fab fa-linkedin-in"></i></a>

              <a href="#"><i class="fab fa-instagram"></i></a>

            </div>

          </div>

        </div>

      </div>



      <div class="col-md-3 col-sm-6">

        <div class="team-box">

          <div class="team-img">

            <img src="{{ asset('public/assets/images/PM2.png') }}" alt="Jane Smith">

            <div class="overlay">

<ul class="text-white p-3 text-start" style="list-style-type: disc;">

                            <li>Bringing to the Predictor team over 18 years of experience in business development and

                              operations management in transportation and logistics, where I have worked with several

                              clients from the industrial and manufacturing sectors

                            </li>

                            <li>Bachelor of Commerce</li>

                          </ul>            </div>

          </div>

          <div class="team-info">

            <h5> Mr. Muhammad Aboobakar</h5>

            <p>Co-Founder & CBO</p>

             <div class="team-social">

              <a href="#"><i class="fab fa-facebook-f"></i></a>

              <a href="#"><i class="fab fa-twitter"></i></a>

              <a href="#"><i class="fab fa-linkedin-in"></i></a>

              <a href="#"><i class="fab fa-instagram"></i></a>

            </div>

          </div>

        </div>

      </div>



      <div class="col-md-3 col-sm-6">

        <div class="team-box">

          <div class="team-img">

            <img src="{{ asset('public/assets/images/PM3.png') }}" alt="Alex Brown">

            <div class="overlay">

<ul class="text-white p-3 text-start" style="list-style-type: disc;">

                              <li>Bachelor of Engineering - Electronics</li>

    

                              <li> Over 20 years industrial experience in preventative and predictive maintenance.</li>

    

                              <li>At PredictorMT, he has continued to use his expertise to manage the company's operations,

                                including developing business plans, overseeing technology development, alpha testing of

                                platform modules, and consulting with industry partners and the Founding team for the

                                launch.</li>

                            </ul>            </div>

          </div>

          <div class="team-info">

            <h5> Mr. Aamir Aslam</h5>

            <p>Co-Founder & COO</p>

             <div class="team-social">

              <a href="#"><i class="fab fa-facebook-f"></i></a>

              <a href="#"><i class="fab fa-twitter"></i></a>

              <a href="#"><i class="fab fa-linkedin-in"></i></a>

              <a href="#"><i class="fab fa-instagram"></i></a>

            </div>

          </div>

        </div>

      </div>



      <div class="col-md-3 col-sm-6">

        <div class="team-box">

          <div class="team-img">

            <img src="{{ asset('public/assets/images/PM4.png') }}" alt="Emily White">

            <div class="overlay">

 <ul class="text-white p-3 text-start" style="list-style-type: disc;">

                            <li>M. Eng. in Machine Designing & B. Eng. Mechanical

  

                            <li> 12 years at Mecha Tronic International - Engineer</li>

  

                            <li>Managing teams for implementation, testing, maintenance, and system improvements.</li>

  

                            <li>Leading development of PredictorMT’s technical data lake, and statistical analysis for

                              preventative and predictive maintenance modelling.</li>

                          </ul>            </div>

          </div>

          <div class="team-info">

            <h5>Mr. Fahad Ahmed</h5>

            <p>Co-Founder & CBO</p>

             <div class="team-social">

              <a href="#"><i class="fab fa-facebook-f"></i></a>

              <a href="#"><i class="fab fa-twitter"></i></a>

              <a href="#"><i class="fab fa-linkedin-in"></i></a>

              <a href="#"><i class="fab fa-instagram"></i></a>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</section>

</div>



@include('include.footer')

