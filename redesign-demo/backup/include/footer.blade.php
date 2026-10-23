@if(!auth()->check())
<div itemscope="">
  
  <footer>
    <div class="container">
      <div class="row g-5">
        <div class="col-md-4 col-sm-6">
          <div class="footer-new-contact">
            <div class="footer-logo">
              <img itemprop="logo" class="lazy1" src="{{ asset('public/assets/user/images/footer-logo.png') }}"
                data-src="imgpredictor/PREDICTORMT TECH SOLUTIONS INC white logo.png" alt="Predictor MT">
            </div>
            <div class="footer-social-icon footer-address">
              <ul>
                <li itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                  <i class="fa-solid fa-location-dot"></i>
                  <p><span> PREDICTOTMT TECH SOLUTIONS INC.304 – 8920 Woodbine Avenue Markham, ON, L3R 9W9</span> </p>
                </li>
                <li itemprop="email"><i class="fa-regular fa-envelope"></i>
                <a href="mailto:ceo@predictormt.ca">ceo@predictormt.ca</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">

          <div class="client-rating" style="color: #fff; font-size: 14px;">
            <div class="footer-icons">
              <p>Follow, like, tweet or post. We would love to interact with you</p>
              <ul>
                <li>
                  <a itemprop="sameAs" href="https://www.facebook.com/predictormt" target="_blank" rel="noopener">
                    <img class="lazy1" src="{{ asset('public/assets/user/images/fb-icon.png') }}" alt="Facebook">
                  </a>
                </li>

                <li>
                  <a itemprop="sameAs" href="https://www.linkedin.com/company/predictormt/" target="_blank" rel="noopener">
                    <img class="lazy1" src="{{ asset('public/assets/images/ln-icon.png') }}" alt="LinkedIn">
                  </a>
                </li>

                <!-- <li>
    <a itemprop="sameAs" href="#" target="_blank" rel="noopener">
      <img class="lazy1" src="{{ asset('public/assets/user/images/twitter-icon.png') }}" alt="Twitter">
    </a>
  </li> -->

                <li>
                  <a itemprop="sameAs" href="https://www.instagram.com/predictormt" target="_blank" rel="noopener">
                    <img class="lazy1" src="{{ asset('public/assets/user/images/insta-icon.png') }}" alt="Instagram">
                  </a>
                </li>
              </ul>

            </div>
            <p>We're happy to share our rating!</p>
            <div class="client-rating-box">
              <span>Client Rating</span>
              <span class="rating-icon">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </span>
            </div>

            <div itemprop="aggregateRating" itemscope="" itemtype="#" class="ratig-2-footer">
              <span itemprop="ratingValue">Rated 4.9</span>/5 based on <span itemprop="reviewCount">49</span> reviews
              across the world.
            </div>
          </div>

        </div>
        <div class="col-md-4 col-sm-12">
          <div class="footer-links">
            <h5>Quick Links</h5>
            <ul>

              <!-- <li><a href="{{ route('home') }}">Home</a></li> -->
              <li><a href="{{ route('about') }}">About Us</a></li>
              <li><a href="{{ route('product') }}">Product</a></li>
              <li><a href="{{ route('product') }}">Subscription</a></li>              
              <li><a href="{{ route('service') }}">Services</a></li>
              <li><a href="{{ route('signup') }}">OEM</a></li>
              <li><a href="{{route('contact')}}">Contact Us</a></li>

<div class="white-line"></div>


            </ul>
          </div>
          <div class="footer-newsletter">
              <h6>Subscribe To Get Email Updates !</h6>

              <form id="newsletterForm">
                  @csrf
                  <div class="form-group mc-field-group">
                      <input type="email" name="email" placeholder="Enter Email Address...."
                            id="mce-EMAIL" class="required email LoNotSensitive">

                      <button type="submit" class="button">Submit</button>
                  </div>

                  <div id="mce-responses" class="clear">
                      <div class="response text-danger" id="mce-error-response" style="display:none"></div>
                      <div class="response text-success" id="mce-success-response" style="display:none"></div>
                  </div>
              </form>
          </div>

        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class=" col-lg-5 col-md-12 col-sm-12">
            <p><i class="fa fa-copyright" aria-hidden="true"></i> {{ date('Y') }}. All Rights Reserved <span
                itemprop="name">Predictor MT</span> Inc.</p>
          </div>
          <div class="col-lg-4 col-md-12 col-sm-12 pull-right">
            <ul>
              <li><a href="{{route('privacy.policy')}}">Privacy Policy</a></li>
              <li><a href="{{route('term.condition')}}">Terms &amp; Conditions</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <button id="backToTop" aria-label="Back to top">
      <svg width="50" height="50" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 4l-8 8h5v8h6v-8h5z" fill="url(#grad)"></path>
        <defs>
          <linearGradient id="grad" x1="0" y1="1" x2="0" y2="0">
            <stop offset="0%" stop-color="white"></stop>
            <stop offset="100%" stop-color="rgb(42 166 242)" style="
    color: rgb(42 166 242);
"></stop>
          </linearGradient>
        </defs>
      </svg>
    </button>


  </footer>
</div>

@endif



<script src="{{ asset('public/assets/user/js/jquery.min.js') }}"></script>

<script src="{{ asset('public/assets/user/js/popper.min.js') }}"></script>

<script src="{{ asset('public/assets/user/js/owl-carousel.js') }}"></script>

<script src="{{ asset('public/assets/user/js/custom.js') }}"></script>

<script src="{{ asset('public/assets/user/js/aos.js') }}"></script>
<script src="{{ asset('public/assets/user/js/bootstrap.bundle.min.js') }}"></script>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$('#newsletterForm').submit(function(e){
    e.preventDefault();

    let email = $('#mce-EMAIL').val();

    $.ajax({
        url: "{{ route('newsletter.subscribe') }}",
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            email: email
        },
        success:function(res){

            Swal.fire({
                icon: 'success',
                title: 'Subscribed Successfully 🎉',
                text: res.message,
                confirmButtonColor: '#ff6600'
            });

            $('#mce-EMAIL').val('');
        },
        error:function(xhr){

            let err = xhr.responseJSON?.message || 'Something went wrong';

            Swal.fire({
                icon: 'error',
                title: 'Oops 😢',
                text: err,
                confirmButtonColor: '#dc3545'
            });

        }
    });
});
</script>




<script>
  AOS.init();
</script>
<script>
  document.getElementById("backToTop").addEventListener("click", function() {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });
</script>

<style>
.white-line {
   width: 100%;
    height: 1.4px;
    background-color: rgb(255 255 255 / 21%);
    justify-content: end;
    position: relative;
    display: flex;
    left: -20px;
    margin-top: 20px;
}

  #backToTop {
    position: fixed;
    right: 25px;
    bottom: 25px;
    background: transparent;
    
    border: none;
    cursor: pointer;
    z-index: 9999;
    padding: 0;
  }

  #backToTop svg {
    transition: transform 0.3s ease;
    border: 2px solid #51ade5;
    border-radius: 50%;
  }

  #backToTop:hover svg {
    transform: translateY(-5px);
    /* thoda upar move on hover */
  }
</style>


</body>

</html>