@include('include.header')

    <!-- Bootstrap js file -->
    <script src="assets/js/bootstrap.min.js"></script>

   <script src="{{ asset('public/assets/js/intlTelInput.min.js') }}"></script>
 <link href="{{ asset('public/assets/css/intlTelInput.css') }}" rel="stylesheet">
 <!-- Page Contact Us Start -->
    <div class="login-page position-relative bg-section inner-page-border">
        <div class="shape position-absolute h-100 w-100"></div>
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-xl-5 d-flex align-items-center px-5">
                    <!-- Contact Us Image Box Start -->
                    <div class="section-title">
                           <h2 class="text-anime-style-3 text-white" data-cursor="-opaque">(An End-To-End IoT Business Solution)</h2>
                           <p class="text-white">Join PredictorMT and explore how cutting-edge technology is transforming predictive maintenance across industries.</p>
                        </div>
                    <!-- Contact Us Image Box End -->
                </div>
                <div class="col-xl-1 d-flex align-items-center px-5"></div>

                <div class="col-xl-6 justify-content-center align-items-center d-flex">
                    <!-- Contact Us Form Start -->
                    <div class="contact-us-form bg-transparent position-relative z-1">
                        <!-- Section Title Start -->
                        <div class="section-title mb-3">
                            <span class="section-sub-title wow fadeInUp">Sign In</span>
                           <h3 class="text-anime-style-3" data-cursor="-opaque">{{ session('show_otp') ? 'Verify OTP' : 'Sign In to Your PredictorMT Account' }}</h3>
                           
                        </div>
                        <!-- Section Title End -->

                   
@if ($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <!-- Login Form -->
        <div id="loginForm" class="contact-form" style="display: {{ session('show_otp') ? 'none' : 'block' }};" class="row">
          <form method="POST" action="{{ route('user.login') }}" id="loginMainForm">
            @csrf

            <div class="mb-4 col-md-12">
              <label class="form-label mb-2">Phone number</label>
              <div class="col-md-12">
                <input type="tel" id="phoneInput" class="form-control" placeholder="Enter your phone number" value="{{ old('phone') }}" style="padding-left:0 !important" required>
              </div>
              <input type="hidden" name="phone" id="phoneHidden">
              <input type="hidden" name="phone_dial" id="phoneDialHidden">
              @error('phone')
                <span class="text-danger small">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-4 col-md-12">
              <label class="form-label mb-2">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
              @error('password')
                <span class="text-danger small">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-4 col-md-12">
              <div class="form-check d-flex align-items-center gap-2">
        <input
            class="form-check-input"
            type="checkbox"
            id="rememberMe">

        <label class="form-check-label fw-semibold" for="rememberMe">
            Remember me
        </label>
    </div>
            </div>

           <div class="d-grid mb-4">
                    <button class="btn btn-default">
                        Sign In
                    </button>
                </div>
          </form>

           <p class="text-center mb-0 form-small-text">
            Don't have an account?
            <a href="{{ route('signup') }}" class="text-primary" style="font-weight: 600; color:#51ade5;">Sign Up</a>
          </small>


                        </div>
                        <!-- Contact Form End -->
                         <!-- OTP Verification Form -->
      <div id="otpForm" style="display: {{ session('show_otp') ? 'block' : 'none' }};">
          @php
            $phoneForOtp = session('login_phone') ?? old('phone');
          @endphp
          <p class="text-center mb-4">
            We've sent a 4-digit OTP to <strong>{{ $phoneForOtp ? ('+' . preg_replace('/.*(\d{4})$/', 'xxxx$1', preg_replace('/\D/', '', $phoneForOtp))) : '' }}</strong>.<br>Enter it below to complete sign in.
          </p>

          <form method="POST" action="{{ route('user.login') }}" id="otpSubmitForm">
            @csrf

            <!-- OTP Input Fields -->
            <div class="mb-4 d-flex align-items-center justify-content-start flex-column gap-3">
              <label class="form-label text-white">Enter 4-Digit OTP</label>
              <div class="d-flex gap-2 justify-content-center" id="otpInputs">
              <!-- intl-tel-input JS (loaded early so initialization works and full country list is available) -->
              <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.19/build/js/intlTelInput.min.js"></script>
                <input type="text" class="otp-input form-control text-center" maxlength="1" inputmode="numeric" placeholder="0" required>
                <input type="text" class="otp-input form-control text-center" maxlength="1" inputmode="numeric" placeholder="0" required>
                <input type="text" class="otp-input form-control text-center" maxlength="1" inputmode="numeric" placeholder="0" required>
                <input type="text" class="otp-input form-control text-center" maxlength="1" inputmode="numeric" placeholder="0" required>
              </div>
              <input type="hidden" name="otp" id="otpValue">
            </div>

            <!-- Timer removed - immediate OTP entry enabled -->

            <!-- Verify Button -->
            <button type="submit" class="btn btn-default w-100" id="verifyBtn" style="background: #51ade5; border: none; color: white; font-size: 17px; font-weight: 500;">
              Verify OTP
            </button>
          </form>

          <!-- Back to Login -->
          <p class="text-center mt-3 form-small-text">
            <a href="{{ route('signin') }}" class="text" style="color:#51ade5;">Back to Sign In</a>
          </p>
        </div>
                    </div>
                    <!-- Contact Us Form End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Contact Us End -->
   
  
   
   
<script>
  // OTP Input Management
  const otpInputs = document.querySelectorAll('.otp-input');
  const otpValue = document.getElementById('otpValue');

  otpInputs.forEach((input, index) => {
    input.addEventListener('input', (e) => {
      const value = e.target.value;

      // Only allow digits
      if (!/^\d$/.test(value) && value !== '') {
        e.target.value = '';
        return;
      }

      // Move to next input
      if (value && index < otpInputs.length - 1) {
        otpInputs[index + 1].focus();
      }

      updateOtpValue();
      updateInputStyles();
    });

    input.addEventListener('keydown', (e) => {
      // Handle backspace
      if (e.key === 'Backspace') {
        if (e.target.value) {
          e.target.value = '';
          updateOtpValue();
          updateInputStyles();
        } else if (index > 0) {
          otpInputs[index - 1].focus();
          otpInputs[index - 1].value = '';
          updateOtpValue();
          updateInputStyles();
        }
      }
      // Handle arrow keys
      else if (e.key === 'ArrowLeft' && index > 0) {
        otpInputs[index - 1].focus();
      } else if (e.key === 'ArrowRight' && index < otpInputs.length - 1) {
        otpInputs[index + 1].focus();
      }
    });

    input.addEventListener('paste', (e) => {
      e.preventDefault();
      const pastedData = e.clipboardData.getData('text');
      const digits = pastedData.replace(/\D/g, '').slice(0, otpInputs.length);

      if (digits.length === otpInputs.length) {
        otpInputs.forEach((input, i) => {
          input.value = digits[i];
        });
        updateOtpValue();
        updateInputStyles();
        otpInputs[otpInputs.length - 1].focus();
      }
    });
  });

  function updateOtpValue() {
    const otp = Array.from(otpInputs).map(input => input.value).join('');
    otpValue.value = otp;
  }

  function updateInputStyles() {
    otpInputs.forEach(input => {
      if (input.value) {
        input.classList.add('filled');
      } else {
        input.classList.remove('filled');
      }
    });
  }

  // Autofocus first OTP input when OTP form is visible
  if (document.getElementById('otpForm').style.display !== 'none') {
    if (otpInputs.length > 0) otpInputs[0].focus();
  }

  // Initialize intl-tel-input for signin
  const phoneInput = document.getElementById('phoneInput');
  const phoneHidden = document.getElementById('phoneHidden');
  let iti;
  if (phoneInput) {
    iti = window.intlTelInput(phoneInput, {
      initialCountry: "in",
    separateDialCode: true,
    nationalMode: false,
      preferredCountries: ['in','us','gb','au','de','fr','it','jp','cn'],
      utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.19/build/js/utils.js'
    });

    // Prevent dropdown from opening on init
    try { phoneInput.blur(); } catch(e) {}

    // Set hidden phone value on form submit
    const loginForm = document.getElementById('loginMainForm');
    if (loginForm) {
      loginForm.addEventListener('submit', function(e) {
        if (iti) {
          const fullNumber = iti.getNumber();
          phoneHidden.value = fullNumber;
        }
      });
    }
  }
</script>