@include('include.header')
<style>
  .iti {
    width: 100%;
}

.iti input {
    width: 100%;
}

input[type="checkbox"] {
    width: 20px;
    height: 20px;
    margin-right: 10px;
}
.form-mainrow{
border: 1px solid;
}
.formRow{
max-width: 900px;
    margin: 0 auto;
     border-left: 1px solid;  
    border-radius: 0 20px 20px 0;
    padding:30px 50px;
}


</style>
<link href="{{ asset('public/assets/css/intlTelInput.css') }}" rel="stylesheet">
<script src="{{ asset('public/assets/js/intlTelInput.min.js') }}"></script>
<div class="condition-div">
  <div class="container py-5 signupPage">
    <div class="row g-0 shadow-lg rounded overflow-hidden form-mainrow">

      <!-- Left Image Section -->
      <div class="col-md-6">
        <div class="signin-img position-relative"
             style="height: 100%; background: url('{{ asset('public/assets/images/signup-thumb.jpg') }}') center/cover no-repeat;">
          <div class="overlay text-white text-center d-flex flex-column justify-content-center align-items-center p-4"
               style="position: absolute; inset: 0; background: rgba(0,0,0,0.4);">
            <h2 class="fw-bold">PredictorMT</h2>
            <h4>(An End-To-End IoT Business Solution)</h4>
            <p class="w-75">
              PredictorMT is an innovative platform revolutionizing predictive maintenance with cutting-edge technology.
            </p>
          </div>
        </div>
      </div>

      <!-- Right Form Section -->
      <div class="col-md-6 formRow">
        <h3 class="text-center mb-4 text-white">
          {{ session('show_otp') ? 'Verify OTP' : 'Sign In' }}
        </h3>

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
        <div id="loginForm" style="display: {{ session('show_otp') ? 'none' : 'block' }};" class="row">
          <form method="POST" action="{{ route('user.login') }}" id="loginMainForm">
            @csrf

            <div class="mb-3">
              <label class="text-white mb-2">Phone number</label>
              <div class="col-md-12">
                <input type="tel" id="phoneInput" class="form-control col-md-12" placeholder="Enter your phone number" value="{{ old('phone') }}" required>
              </div>
              <input type="hidden" name="phone" id="phoneHidden">
              <input type="hidden" name="phone_dial" id="phoneDialHidden">
              @error('phone')
                <span class="text-danger small">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label class="text-white mb-2">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
              @error('password')
                <span class="text-danger small">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label class="text-white mb-2 d-flex align-items-center">
                <input type="checkbox" name="remember"> Remember me
              </label>
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-warning w-100 p-2" style="background: #51ade5; border: none; color: white; font-size: 17px; font-weight: 500; padding:10px">
              Sign In
            </button>
            </div>
          </form>

          <small class="text-center mt-3 text-white d-block w-100">
            Don't have an account?
            <a href="{{ route('signup') }}" class="text-primary" style="font-weight: 600; color:#51ade5;">Sign Up</a>
          </small>
        </div>

        <!-- OTP Verification Form -->
        <div id="otpForm" style="display: {{ session('show_otp') ? 'block' : 'none' }};">
          @php
            $phoneForOtp = session('login_phone') ?? old('phone');
          @endphp
          <p class="text-center text-white mb-4">
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
            <button type="submit" class="btn btn-warning w-auto p-2 px-4 m-auto d-flex" id="verifyBtn" style="background: #51ade5; border: none; color: white; font-size: 17px; font-weight: 500;">
              Verify OTP
            </button>
          </form>

          <!-- Back to Login -->
          <div class="text-center mt-3">
            <a href="{{ route('signin') }}" class="text" style="color:#51ade5;">Back to Sign In</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<style>
  .otp-input {
   width: 50px;
    height: 50px;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    border: 2px solid #ddd;
    border-radius: 8px;
    transition: all 0.3s ease;
  }

  .otp-input:focus {
    border-color: #51ade5;
    box-shadow: 0 0 0 0.2rem rgba(81, 173, 229, 0.25);
    outline: none;
  }

  .otp-input.filled {
    border-color: #51ade5;
    background-color: #f0f8ff;
  }

  /* Timer removed - no styles needed */
</style>

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
      initialCountry: 'in',
      separateDialCode: false,
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

@include('include.footer')

