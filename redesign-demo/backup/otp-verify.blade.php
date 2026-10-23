@include('include.header')



<div class="condition-div">

  <div class="container mb-5 mt-5">

    <div class="row g-0 shadow-lg rounded overflow-hidden">



      <!-- LEFT IMAGE SECTION -->

      <div class="col-md-6">

        <div class="signin-img position-relative"

             style="height: 80vh; background: url('https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1000&q=80') center/cover no-repeat;">

          <div class="overlay text-white text-center d-flex flex-column justify-content-center align-items-center p-4"

               style="position:absolute; inset:0; background:rgba(0,0,0,0.4);">

            <h2 class="fw-bold">PredictorMT</h2>

            <h4>(An End-To-End IoT Business Solution)</h4>

            <p class="w-75">

              Secure verification for your account with OTP authentication.

            </p>

          </div>

        </div>

      </div>



      <!-- RIGHT OTP FORM SECTION -->

      <div class="col-md-6 bg-white p-5">

        <h3 class="text-center mb-4" style="color:#51ade5; font-size:30px; font-weight:700;">Verify OTP</h3>



        @if ($errors->any())

          <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <ul class="mb-0">

              @foreach ($errors->all() as $error)

                <li class="text-danger">{{ $error }}</li>

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



        <p class="text-center mb-4 text-white">

          We've sent a 4-digit OTP to <strong>{{ $email }}</strong>

        </p>



        <form method="POST" action="{{ route('otp.verify.submit') }}" id="otpForm">

          @csrf



          <!-- Hidden fields -->

          <input type="hidden" name="email" value="{{ $email }}">

          <input type="hidden" name="type" value="{{ $type }}">



          <!-- OTP Input Fields -->

          <div class="mb-4 d-flex justify-content-center align-items-center gap-5 text-white">

            <label class="form-label">Enter OTP</label>

            <div class="d-flex gap-2 justify-content-center" id="otpInputs">

              <input type="text" class="otp-input form-control text-center" maxlength="1" inputmode="numeric" placeholder="0" required>

              <input type="text" class="otp-input form-control text-center" maxlength="1" inputmode="numeric" placeholder="0" required>

              <input type="text" class="otp-input form-control text-center" maxlength="1" inputmode="numeric" placeholder="0" required>

              <input type="text" class="otp-input form-control text-center" maxlength="1" inputmode="numeric" placeholder="0" required>

            </div>

            <input type="hidden" name="otp" id="otpValue">

          </div>



          <!-- Timer -->

          <div class="text-center mb-3">

            <p class="text-muted">

              Time remaining: <span id="timer" style="font-weight: bold; color: #51ade5;">30</span>s

            </p>

          </div>



          <!-- Verify Button -->

        <div class="mt-4">
            <button type="submit" class="btn btn-warning w-100" id="verifyBtn" style="background:#51ade5; border:none; color:white; font-size:17px; font-weight:500;">

            Verify OTP

          </button>
        </div>

        </form>



        <!-- Resend OTP Section -->

        <div class="mt-4 text-center">

          <p class="text-muted">Didn't receive the OTP?</p>

          <form method="POST" action="{{ route('otp.resend') }}" style="display: inline;">

            @csrf

            <input type="hidden" name="email" value="{{ $email }}">

            <input type="hidden" name="type" value="{{ $type }}">

            <button type="submit" class="btn btn-link text-decoration-none" style="color: #51ade5; font-weight: 600;">

              Resend OTP

            </button>

          </form>

        </div>



        <!-- Back to Login/Signup -->

        <div class="text-center mt-3">

          @if($type === 'login')

            <a href="{{ route('signin') }}" class="text-primary">Back to Sign In</a>

          @else

            <a href="{{ route('signup') }}" class="text-primary">Back to Sign Up</a>

          @endif

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
    border: 2px solid #fff;
    border-radius: 8px;
    transition: all 0.3s ease;

  }



  .otp-input:focus {

    border-color: #51ade5;

    box-shadow: 0 0 0 0.2rem rgba(81, 173, 229, 0.25);

    outline: none;

  }



  .otp-input.filled {

    border-color: #fff;

    background-color: #f0f8ff;

  }



  #timer {

    font-size: 18px;

  }



  #timer.warning {

    color: #ff6b6b;

  }



  #timer.danger {

    color: #dc3545;

  }

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



  // Timer Logic

  let timeLeft = 30;

  const timerElement = document.getElementById('timer');

  const otpForm = document.getElementById('otpForm');



  const timerInterval = setInterval(() => {

    timeLeft--;

    timerElement.textContent = timeLeft;



    if (timeLeft <= 10) {

      timerElement.classList.add('warning');

    }

    if (timeLeft <= 5) {

      timerElement.classList.remove('warning');

      timerElement.classList.add('danger');

    }



    if (timeLeft <= 0) {

      clearInterval(timerInterval);

      disableOtpForm();

    }

  }, 1000);



  function disableOtpForm() {

    otpInputs.forEach(input => {

      input.disabled = true;

    });

    document.getElementById('verifyBtn').disabled = true;

    document.getElementById('verifyBtn').textContent = 'OTP Expired - Please Resend';

  }



  // Auto-focus first input

  otpInputs[0].focus();

</script>



@include('include.footer')

