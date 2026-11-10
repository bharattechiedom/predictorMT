<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - PredictorMT</title>
      <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.png') }}">
        <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/assets/css/all.min.css') }}" rel="stylesheet">
    <style>
      body{
        background:#daf4ff;
      }
      .admin_login_form{
            max-width: 450px;
            margin: 5% auto;
        }
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #00C2FF 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .input-group{
            background-color: #F4F8FC;
             border: 2px solid #e9ecef;
              border-radius: 10px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            background-color: #F4F8FC;
            border: none;
    border-radius: 10px;
    padding: 15px 10px;
    box-shadow: none;
    outline: none;
        font-size: 14px;
        }
        .form-control:focus {
            box-shadow:none;
            border:none;
            background-color: #F4F8FC;
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #00C2FF 100%);
            border: none;
            border-radius: 10px;
            padding: 15px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
     
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="admin_login_form">
                <div class="card login-card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="login-header">

                        <h3 class="mb-0"><i class="fas fa-shield-alt"></i> Admin Login</h3>
                        <p class="mb-0">PredictorMT Administration</p>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    Email Address
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 px-1 opacity-25">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="Enter your email"
                                           required 
                                           autofocus>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">
                                    Password
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 px-1 opacity-25">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Enter your password"
                                           required>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-login">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <small class="text-muted">
                                <i class="fas fa-shield-alt me-1"></i>
                                Secure Admin Access Only
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
