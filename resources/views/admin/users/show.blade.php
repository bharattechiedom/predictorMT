@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">

            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">
                <div class="main-content">

                    {{-- Page Header --}}
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                <i class="fas fa-user-circle fa-lg"></i>
                            </div>

                            <div>
                                <h4 class="fw-bold mb-1">User Details</h4>
                                <p class="text-muted mb-0 small">
                                    View user account information and company assignment.
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('admin.users.index') }}"
                            class="btn btn-outline-secondary rounded-3">
                            <i class="fas fa-arrow-left me-2"></i>Back to Users
                        </a>
                    </div>

                    {{-- User Overview --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                        style="width: 64px; height: 64px; font-size: 24px;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                                        <p class="text-muted mb-2">{{ $user->email }}</p>

                                        @php
                                            $roleColors = [
                                                'superadmin' => 'danger',
                                                'admin' => 'warning',
                                                'manager' => 'info',
                                                'technician' => 'primary',
                                                'viewer' => 'secondary',
                                            ];
                                        @endphp

                                        <span class="badge bg-{{ $roleColors[$user->role] ?? 'secondary' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </div>
                                </div>

                                <a href="{{ route('admin.users.edit', $user) }}"
                                    class="btn btn-primary rounded-3 px-3">
                                    <i class="fas fa-edit me-2"></i>Edit User
                                </a>

                            </div>
                        </div>
                    </div>

                    {{-- User Information --}}
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                    <i class="fas fa-address-card fa-lg"></i>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">Account Information</h5>
                                    <p class="text-muted small mb-0">
                                        Personal details and assigned company.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4 border-top">
                            <div class="row g-4">

                                {{-- User Name --}}
                                <div class="col-12 col-md-6">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="text-primary pt-1">
                                            <i class="fas fa-user fa-lg"></i>
                                        </div>

                                        <div>
                                            <p class="text-muted small mb-1">Full Name</p>
                                            <h6 class="fw-semibold mb-0">{{ $user->name }}</h6>
                                        </div>
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="col-12 col-md-6">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="text-primary pt-1">
                                            <i class="fas fa-envelope fa-lg"></i>
                                        </div>

                                        <div>
                                            <p class="text-muted small mb-1">Email Address</p>
                                            <h6 class="fw-semibold mb-0 text-break">{{ $user->email }}</h6>
                                        </div>
                                    </div>
                                </div>

                                {{-- Role --}}
                                <div class="col-12 col-md-6">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="text-primary pt-1">
                                            <i class="fas fa-user-shield fa-lg"></i>
                                        </div>

                                        <div>
                                            <p class="text-muted small mb-1">User Role</p>

                                            <span class="badge bg-{{ $roleColors[$user->role] ?? 'secondary' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Company --}}
                                <div class="col-12 col-md-6">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="text-primary pt-1">
                                            <i class="fas fa-building fa-lg"></i>
                                        </div>

                                        <div>
                                            <p class="text-muted small mb-1">Company</p>
                                            <h6 class="fw-semibold mb-0">
                                                {{ $user->company ? $user->company->name : 'None' }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                {{-- Phone --}}
                                <div class="col-12 col-md-6">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="text-primary pt-1">
                                            <i class="fas fa-phone fa-lg"></i>
                                        </div>

                                        <div>
                                            <p class="text-muted small mb-1">Phone Number</p>
                                            <h6 class="fw-semibold mb-0">
                                                {{ $user->phone ?? 'N/A' }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                {{-- Created Date --}}
                                <div class="col-12 col-md-6">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="text-primary pt-1">
                                            <i class="fas fa-calendar-alt fa-lg"></i>
                                        </div>

                                        <div>
                                            <p class="text-muted small mb-1">Account Created</p>
                                            <h6 class="fw-semibold mb-0">
                                                {{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{-- Footer Actions --}}
                            <div class="border-top mt-4 pt-4 d-flex flex-wrap justify-content-end gap-2">
                                <a href="{{ route('admin.users.index') }}"
                                    class="btn btn-light border rounded-3 px-4">
                                    <i class="fas fa-arrow-left me-2"></i>Back
                                </a>

                                <a href="{{ route('admin.users.edit', $user) }}"
                                    class="btn btn-primary rounded-3 px-4">
                                    <i class="fas fa-edit me-2"></i>Edit User
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>

@include('admin.include.footer')
