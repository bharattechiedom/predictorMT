@include('include.header')

<div class="our-services-gold bg-section dark-section mb-5">
        <div class="container h-100">
          <div class="row section-row align-items-center">
                <div class="col-xl-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <span class="section-sub-title wow fadeInUp">Why Book a Demo?</span>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Book Your Personalized AI Demo</h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-xl-6">
                    <!-- Section Content Button Start -->
                    <div class="section-content-btn">
                        <!-- Section Title Content Start -->
                        <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                            <p>  Experience our platform in action. Get a personalized walkthrough from our experts, explore key features, and see how our solutions fit your business needs.</p>
                        </div>
                        <!-- Section Title Content End -->
    
                       
                        <!-- Section Button End -->
                    </div>   
                    <!-- Section Content Button End -->
                </div>
            </div>
                   
    <div class="row mb-0 contact-form ">

      <!-- Left Section -->

      <div class="col-lg-6 left-section d-flex flex-column ">

        <form method="POST" action="{{ route('demo.submit') }}" class="demo-form">
        @csrf
          <div class="row mb-3">

            <div class="col-md-6 mb-3 mb-md-0">

              <input type="text" class="form-control" name="first_name" placeholder="First Name *" required>

            </div>

            <div class="col-md-6">

              <input type="text" class="form-control" name="last_name" placeholder="Last Name *" required>

            </div>

          </div>

          <div class="mb-3">

            <input type="email" class="form-control" name="email" placeholder="Your Email *" required>

          </div>

          <div class="mb-3">

            <input type="tel" class="form-control" name="phone" placeholder="Your Phone *" required>

          </div>

          <div class="mb-3">

            <input type="text" class="form-control" name="company_name" placeholder="Company Name *" required>

          </div>

          <div class="mb-3">

            <input type="date" class="form-control" name="preferred_date" placeholder="Preferred Date *" required>

          </div>

          <div class="mb-3">

            <select class="form-control" required>

              <option selected disabled>Choose Service *</option>

              <option value="SEO">SEO</option>

              <option value="Paid Search">Paid Search</option>

              <option value="Design & Development">Design & Development</option>

              <option value="Custom Demo">Custom Demo</option>

            </select>

          </div>

          <div class="mb-3">

            <textarea class="form-control" rows="4" name="additional_notes" placeholder="Additional Notes" required></textarea>

          </div>

          <button type="submit" class="btn btn-default">Request Demo</button>

        </form>

      </div>



      <!-- Right Section -->

      <div class="col-lg-6 right-section d-flex flex-column ps-0 ps-md-5 ">

        <h3 class="text-white">Demo Schedule & Support</h3>
        <p class="text-white">Everything you need to know before your personalized demo.</p>

       
       


        <div class="contact-info">

          <p class="text-white">
            <i class="fa-regular fa-calendar me-1"></i> <strong>Schedule:</strong><br> Monday – Friday, 8:30am – 5:30pm CST
          </p>

          <p class="text-white">
            <i class="fa-regular fa-clock me-1"></i> <strong>Duration:</strong><br> 30–45 minutes live demo
          </p>

          <p class="text-white">
            <i class="fa-regular fa-circle-question me-1"></i><strong>Support:</strong><br> Live Q&A with our experts
          </p>

         <p class="text-white"><i class="fa-regular fa-envelope me-1"></i><strong>Email:</strong><br> <a href="mailto:ceo@predictormt.ca" itemprop="email" style="text-decoration: none; color:white">ceo@predictormt.ca</a>
</p>
</div>

        </div>

      </div>

    </div>

  </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
document.addEventListener("DOMContentLoaded", function () {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
});
</script>
@endif


@include('include.footer')

