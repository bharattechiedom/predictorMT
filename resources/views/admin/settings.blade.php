
@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">
            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">
                <div class="main-content p-3 p-lg-4">

                    {{-- Page Header --}}
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
                        <div>
                            <h4 class="fw-bold mb-1">Admin Settings</h4>
                            <p class="text-secondary mb-0">
                                Manage your account details and security preferences.
                            </p>
                        </div>

                        <span class="badge rounded-pill bg-theme-primary text-white border px-3 py-2">
                            <i class="fas fa-shield-halved me-2"></i>
                            Account Settings
                        </span>
                    </div>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-circle-check me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-circle-exclamation me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row g-4">

                        {{-- Left Profile Card --}}
                        <div class="col-12 col-xl-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4 text-center">

                                    <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center mx-auto mb-3"
                                         style="width: 90px; height: 90px; font-size: 34px;">
                                        <i class="fas fa-user-shield"></i>
                                    </div>

                                    <h5 class="fw-bold mb-1">
                                        <!-- {{ $admin->name ?? 'Administrator' }} -->
                                    </h5>

                                    <p class="text-secondary small mb-3">
                                        <!-- {{ $admin->username ?? 'Admin Account' }} -->
                                    </p>

                                    <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                                        <i class="fas fa-circle-check me-1"></i>
                                        Administrator
                                    </span>

                                    <hr class="my-4">

                                    <div class="text-start">
                                        <div class="d-flex align-items-start gap-3 mb-4">
                                            <span class="bg-light rounded-3 p-3 text-primary">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            <div class="min-w-0">
                                                <small class="text-secondary d-block mb-1">
                                                    Full Name
                                                </small>
                                                <div class="fw-semibold text-break">
                                                    Rohit
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-start gap-3">
                                            <span class="bg-light rounded-3 p-3 text-primary">
                                                <i class="fas fa-at"></i>
                                            </span>
                                            <div class="min-w-0">
                                                <small class="text-secondary d-block mb-1">
                                                    Username
                                                </small>
                                                <div class="fw-semibold text-break">
                                                    rohitkaloniya
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-light border text-start mt-4 mb-0">
                                        <i class="fas fa-lock text-primary me-2"></i>
                                        <small class="text-secondary">
                                            Keep your login credentials private and use a strong password.
                                        </small>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- Right Settings Forms --}}
                        <div class="col-12 col-xl-8">

                            {{-- Profile Settings --}}
                            <div class="card border-0 shadow-sm rounded-4 mb-4">
                                <div class="card-header bg-white border-0 p-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="bg-primary-subtle text-primary rounded-3 p-3">
                                            <i class="fas fa-user-pen fa-lg"></i>
                                        </span>
                                        <div>
                                            <h5 class="fw-bold mb-1">Profile Settings</h5>
                                            <p class="text-secondary small mb-0">
                                                Update your administrator account details.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-4 border-top">

                                    @if($errors->profile->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0 ps-3">
                                                @foreach($errors->profile->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST"
                                          action="">
                                        @csrf
                                        @method('PUT')

                                        <div class="row g-3">

                                            <div class="col-12 col-md-6">
                                                <label for="name" class="form-label fw-semibold">
                                                    Full Name <span class="text-danger">*</span>
                                                </label>

                                                <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="fas fa-user text-secondary"></i>
                                                    </span>
                                                    <input type="text"
                                                           name="name"
                                                           id="name"
                                                           class="form-control @error('name', 'profile') is-invalid @enderror"
                                                           value=""
                                                           placeholder="Enter full name"
                                                           required>
                                                </div>

                                                @error('name', 'profile')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label for="username" class="form-label fw-semibold">
                                                    Username <span class="text-danger">*</span>
                                                </label>

                                                <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="fas fa-at text-secondary"></i>
                                                    </span>
                                                    <input type="text"
                                                           name="username"
                                                           id="username"
                                                           class="form-control @error('username', 'profile') is-invalid @enderror"
                                                           value=""
                                                           placeholder="Enter username"
                                                           autocomplete="username"
                                                           required>
                                                </div>

                                                @error('username', 'profile')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <label for="email" class="form-label fw-semibold">
                                                    Email Address
                                                </label>

                                                <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="fas fa-envelope text-secondary"></i>
                                                    </span>
                                                    <input type="email"
                                                           name="email"
                                                           id="email"
                                                           class="form-control @error('email', 'profile') is-invalid @enderror"
                                                           value=""
                                                           placeholder="Enter email address"
                                                           autocomplete="email">
                                                </div>

                                                @error('email', 'profile')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                                            <button type="submit" class="btn theme-btn">
                                                <i class="fas fa-save me-2"></i>
                                                Save Profile
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- Change Password --}}
                            <div class="card border-0 shadow-sm rounded-4">
                                <div class="card-header bg-white border-0 p-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="bg-warning-subtle text-warning-emphasis rounded-3 p-3">
                                            <i class="fas fa-key fa-lg"></i>
                                        </span>
                                        <div>
                                            <h5 class="fw-bold mb-1">Change Password</h5>
                                            <p class="text-secondary small mb-0">
                                                Update your password to keep your account secure.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-4 border-top">

                                    @if($errors->passwordUpdate->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0 ps-3">
                                                @foreach($errors->passwordUpdate->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST"
                                          action="">
                                        @csrf
                                        @method('PUT')

                                        <div class="row g-3">

                                            <div class="col-12">
                                                <label for="current_password" class="form-label fw-semibold">
                                                    Current Password <span class="text-danger">*</span>
                                                </label>

                                                <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="fas fa-lock text-secondary"></i>
                                                    </span>
                                                    <input type="password"
                                                           name="current_password"
                                                           id="current_password"
                                                           class="form-control @error('current_password', 'passwordUpdate') is-invalid @enderror"
                                                           placeholder="Enter current password"
                                                           autocomplete="current-password"
                                                           required>
                                                    <button type="button"
                                                            class="btn btn-outline-secondary toggle-password"
                                                            data-target="current_password"
                                                            aria-label="Show or hide current password">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>

                                                @error('current_password', 'passwordUpdate')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label for="password" class="form-label fw-semibold">
                                                    New Password <span class="text-danger">*</span>
                                                </label>

                                                <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="fas fa-key text-secondary"></i>
                                                    </span>
                                                    <input type="password"
                                                           name="password"
                                                           id="password"
                                                           class="form-control @error('password', 'passwordUpdate') is-invalid @enderror"
                                                           placeholder="Enter new password"
                                                           autocomplete="new-password"
                                                           required>
                                                    <button type="button"
                                                            class="btn btn-outline-secondary toggle-password"
                                                            data-target="password"
                                                            aria-label="Show or hide new password">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>

                                                @error('password', 'passwordUpdate')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label for="password_confirmation" class="form-label fw-semibold">
                                                    Confirm New Password <span class="text-danger">*</span>
                                                </label>

                                                <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="fas fa-shield-halved text-secondary"></i>
                                                    </span>
                                                    <input type="password"
                                                           name="password_confirmation"
                                                           id="password_confirmation"
                                                           class="form-control"
                                                           placeholder="Re-enter new password"
                                                           autocomplete="new-password"
                                                           required>
                                                    <button type="button"
                                                            class="btn btn-outline-secondary toggle-password"
                                                            data-target="password_confirmation"
                                                            aria-label="Show or hide confirm password">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="alert alert-light border mt-3 mb-0">
                                            <div class="fw-semibold small mb-2">
                                                <i class="fas fa-circle-info text-primary me-2"></i>
                                                Password tips
                                            </div>
                                            <ul class="text-secondary small mb-0 ps-4">
                                                <li>Use at least 8 characters.</li>
                                                <li>Combine uppercase, lowercase, numbers and symbols.</li>
                                                <li>Choose a password you do not use on other websites.</li>
                                            </ul>
                                        </div>

                                        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                                            <button type="submit" class="btn theme-btn">
                                                <i class="fas fa-lock me-2"></i>
                                                Update Password
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.querySelectorAll('.toggle-password').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = document.getElementById(this.dataset.target);
            const icon = this.querySelector('i');

            if (!input || !icon) return;

            const showPassword = input.type === 'password';
            input.type = showPassword ? 'text' : 'password';

            icon.classList.toggle('fa-eye', !showPassword);
            icon.classList.toggle('fa-eye-slash', showPassword);
        });
    });
</script>

@include('admin.include.footer')
