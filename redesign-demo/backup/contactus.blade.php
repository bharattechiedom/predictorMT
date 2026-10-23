@include('include.header')



<div class="condition-div">

<div class="custom-breadcrumb mt-0">
  <span class="home-icon">
    <i class="fa-solid fa-house"></i>
  </span>

  <a href="{{ route('home')}}">Home</a>
  <span class="arrow">›</span>

  <a href="#">Contact Us</a>
  <span class="arrow">›</span>

</div>


  <div class="container">

    <div class="row contact-row ">

      <!-- Left Section -->

      <div class="col-lg-6">
        <div class="left-section">

        <h2 style="left:0">How Can We Help You?</h2>
        <p class="text-white">Get in touch with us for any queries or support</p>

        <form class="px-0">

          <div class="row mb-3">

            <div class="col-md-6 mb-3 mb-md-0">

              <input type="text" class="form-control" placeholder="Your Name *">

            </div>

            <div class="col-md-6">

              <input type="email" class="form-control" placeholder="Your Email *">

            </div>

          </div>



          <div class="row mb-3">

            <div class="col-md-6 mb-3 mb-md-0">

              <input type="tel" class="form-control" placeholder="Your Phone *">

            </div>

            <div class="col-md-6">

              <input type="text" class="form-control" placeholder="Company Name *">

            </div>

          </div>



          <div class="mb-3">

            <input type="text" class="form-control" placeholder="Company Website *">

          </div>
          <div class="mb-3">

            <textarea name="message" id="MessageBox" placeholder="Message" class="form-control"></textarea>

          </div>



          <button type="submit" class="btn-custom">Submit</button>

        </form>

</div>

      </div>





      <!-- Right Section -->

      <!-- Right Section -->

      <div class="col-lg-6">
        <div class="right-section">


        <div class="underline"></div>

        <p class="text-white">
          Call us to schedule a tour of our Houston office, right inside the 610 Loop in the Galleria/Uptown area.
          We are open Monday through Friday from 8:30 am to 5:30 pm CST.
        </p>

        <div class="contact-info">

         <p>
          <span class="icon-circle"><i class="fa-regular fa-envelope"></i></span>
          <a href="mailto:ceo@predictormt.ca" itemprop="email" style="text-decoration: none; color:white">ceo@predictormt.ca</a>
        </p>


          <p>
            <span class="icon-circle"><i class="fa-solid fa-location-dot"></i></span>
            PREDICTOTMT TECH SOLUTIONS INC.304 8920 <br> Woodbine Avenue Markham, ON, L3R 9W9
          </p>

        </div>



      </div>
      </div>



    </div>

  </div>

</div>



@include('include.footer')