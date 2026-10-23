@include('include.header')



<div class="condition-div">
<div class="custom-breadcrumb mt-0">
  <span class="home-icon">
    <i class="fa-solid fa-house"></i>
  </span>

  <a href="{{ route('home')}}">Home</a>
  <span class="arrow">›</span>

  <a href="#">Request Demo </a>
  <span class="arrow">›</span>

</div>
  <div class="container">

    <div class="row mb-0 contact-row">

      <!-- Left Section -->

      <div class="col-lg-6 left-section d-flex flex-column ">

        <h2>Request a Demo</h2>

        <form method="POST" action="{{ route('demo.submit') }}" class="demo-form mt-4">
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

          <button type="submit" class="btn-custom">Request Demo</button>

        </form>

      </div>



      <!-- Right Section -->

      <div class="col-lg-6 right-section d-flex flex-column mb-5">

        <h3>Why Book a Demo?</h3>

        <div class="underline"></div>

        <p>

          Experience our platform in action. Get a personalized walkthrough from our experts, 

          explore key features, and see how our solutions fit your business needs.

        </p>



        <div class="contact-info">

          <p>


            <strong>Schedule:</strong> Monday – Friday, 8:30am – 5:30pm CST

          </p>

          <p>


            <strong>Duration:</strong> 30–45 minutes live demo

          </p>

          <p>


            <strong>Support:</strong> Live Q&A with our experts

          </p>

         <p>
  
  <strong>Email:</strong>
  <a href="mailto:ceo@predictormt.ca" itemprop="email" style="text-decoration: none; color:white">ceo@predictormt.ca</a>
</p>


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

