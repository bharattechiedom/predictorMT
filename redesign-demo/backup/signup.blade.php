@include('include.header')
<style>
  .iti {
    width: 100%;
}

.iti input {
    width: 100%;
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

      <!-- LEFT IMAGE SECTION -->
      <div class="col-md-6">
        <div class="signin-img position-relative"
             style="height: 100%; background: url('{{ asset('public/assets/images/signup-thumb.jpg') }}') center/cover no-repeat;">
          <div class="overlay text-white text-center d-flex flex-column justify-content-center align-items-center p-4"
               style="position:absolute; inset:0; background:rgba(0,0,0,0.4);">
            <h2 class="fw-bold">PredictorMT</h2>
            <h4>(An End-To-End IoT Business Solution)</h4>
            <p class="w-75">
              Join PredictorMT and explore how cutting-edge technology is transforming predictive maintenance across industries.
            </p>
          </div>
        </div>
      </div>

      <!-- RIGHT SIGN-UP FORM SECTION -->
      <div class="col-md-6 formRow">
        <h3 class="text-center mb-1 text-white">
          {{ session('show_otp') ? 'Verify OTP' : 'Sign Up' }}
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

        <!-- Registration Form -->
        @php
          $selectedPlan = request()->get('plan');
          $planModel = $selectedPlan ? \App\Models\Plan::find($selectedPlan) : null;
        @endphp
        @if($planModel)
          <div class="mb-3 p-3 border rounded" style="background:#f8f9fb;">
            <strong>Selected plan:</strong> {{ $planModel->name }} — {{ config('app.currency', 'CAD') }} {{ number_format($planModel->price,2) }} @if($planModel->billing_interval) <span class="text-muted">({{ $planModel->billing_interval }})</span>@endif
            @if($planModel->description)
              <div class="text-muted small">{{ $planModel->description }}</div>
            @endif
          </div>
        @endif
        <div id="registrationForm" style="display: {{ session('show_otp') ? 'none' : 'block' }};">
          <form method="POST" action="{{ route('user.register') }}">
            @csrf
            @if($selectedPlan)
              <input type="hidden" name="plan_id" value="{{ $selectedPlan }}">
            @endif
            @if(request()->get('session_id'))
              <input type="hidden" name="stripe_session_id" value="{{ request()->get('session_id') }}">
            @endif

            <div class="mb-3">
              <label class="text-white mb-2">Full Name</label>
              <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}" required>
              @error('name')
                <span class="text-danger small">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label class="text-white mb-2">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
              @error('email')
                <span class="text-danger small">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label class="text-white mb-2">Phone number</label>
              <div class="d-flex">
                <input type="tel" id="phoneInput" class="form-control" placeholder="Enter your phone number" value="{{ old('phone') }}" required>
              </div>
              <input type="hidden" name="phone" id="phoneHidden">
              <input type="hidden" name="phone_dial" id="phoneDialHidden">
              @error('phone')
                <span class="text-danger small">{{ $message }}</span>
              @enderror
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="mb-3">
              <label class="text-white mb-2">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Create a password" required>
              @error('password')
                <span class="text-danger small">{{ $message }}</span>
              @enderror
            </div>

           
              </div>
              <div class="col-sm-6">
                 <div class="mb-3">
              <label class="text-white mb-2">Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
              @error('password_confirmation')
                <span class="text-danger small">{{ $message }}</span>
              @enderror
            </div>

              </div>
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-warning w-100" style="background:#51ade5; border:none; color:white; font-size:17px; font-weight:500;padding:10px">
              Sign Up
            </button>
            </div>
          </form>

          <small class="text-center mt-3 d-block w-100 text-white">
            Already have an account?
            <a href="{{ route('signin') }}" class="text-primary" style="font-weight: 600;">Sign In</a>
          </small>
        </div>

        <!-- OTP Verification Form -->
        <div id="otpForm" style="display: {{ session('show_otp') ? 'block' : 'none' }};">
          @php
            $phoneForOtp = session('register_phone') ?? old('phone');
            $masked = '';
            if ($phoneForOtp) {
              $digits = preg_replace('/\D/', '', $phoneForOtp);
              $last = substr($digits, -4);
              $masked = preg_replace('/\d(?=\d{4})/', 'x', $digits);
              $masked = '+' . $masked;
              $display = '+' . preg_replace('/(.*)(\d{4})$/', '\\1xxxx', $digits);
            } else {
              $display = '';
            }
          @endphp
          <p class="text-center text-muted mb-4">
            We've sent a 4-digit OTP to <strong>{{ $phoneForOtp ? ( '+' . preg_replace('/.*(\d{4})$/', 'xxxx$1', preg_replace('/\D/', '', $phoneForOtp)) ) : '' }}</strong>. Enter it below to complete registration.
          </p>

          <form method="POST" action="{{ route('user.register') }}" id="otpSubmitForm">
            @csrf
            @if($selectedPlan)
              <input type="hidden" name="plan_id" value="{{ $selectedPlan }}">
            @endif
            @if(request()->get('session_id'))
              <input type="hidden" name="stripe_session_id" value="{{ request()->get('session_id') }}">
            @endif

            <!-- OTP Input Fields -->
            <div class="mb-4">
              <label class="form-label">Enter 4-Digit OTP</label>
              <div class="d-flex gap-2 justify-content-center" id="otpInputs">
                <input type="text" class="otp-input form-control text-center" maxlength="1" inputmode="numeric" placeholder="0" required>
                <input type="text" class="otp-input form-control text-center" maxlength="1" inputmode="numeric" placeholder="0" required>
                <input type="text" class="otp-input form-control text-center" maxlength="1" inputmode="numeric" placeholder="0" required>
                <input type="text" class="otp-input form-control text-center" maxlength="1" inputmode="numeric" placeholder="0" required>
              </div>
              <input type="hidden" name="otp" id="otpValue">
            </div>

            <!-- Timer removed - immediate OTP entry enabled -->

            <!-- Verify Button -->
            <button type="submit" class="btn btn-warning w-100" id="verifyBtn" style="background:#51ade5; border:none; color:white; font-size:17px; font-weight:500;">
              Verify OTP
            </button>
          </form>

          <!-- Back to Registration -->
          <div class="text-center mt-3">
            <a href="{{ route('signup') }}" class="text-primary">Back to Sign Up</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<style>
  .otp-input {
    width: 60px;
    height: 60px;
    font-size: 24px;
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

  // Initialize intl-tel-input for signup
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
    const regForm = document.getElementById('registrationForm');
    if (regForm) {
      regForm.addEventListener('submit', function(e) {
        if (iti) {
          const fullNumber = iti.getNumber();
          phoneHidden.value = fullNumber;
        }
      });
    }
  }
</script>

@include('include.footer')



