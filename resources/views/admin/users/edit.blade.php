```blade
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
                                <i class="fas fa-user-edit fa-lg"></i>
                            </div>

                            <div>
                                <h4 class="fw-bold mb-1">Edit User</h4>
                                <p class="text-muted mb-0 small">
                                    Update user details, company assignment and role.
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('admin.users.index') }}"
                            class="btn btn-outline-secondary rounded-3">
                            <i class="fas fa-arrow-left me-2"></i>Back to Users
                        </a>
                    </div>

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                            <div class="fw-semibold mb-2">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                Please correct the following errors:
                            </div>

                            <ul class="mb-0 ps-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                            <button type="button" class="btn-close"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Edit User Form --}}
                    <div class="card border-0 shadow-sm rounded-4">

                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                    <i class="fas fa-id-card fa-lg"></i>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">User Information</h5>
                                    <p class="text-muted small mb-0">
                                        Editing account for {{ $user->name }}.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4 border-top">

                            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">

                                    {{-- Company --}}
                                    <div class="col-12 col-md-6">
                                        <label for="company_id" class="form-label fw-semibold">
                                            Company
                                        </label>

                                        <select name="company_id"
                                            id="company_id"
                                            class="form-select @error('company_id') is-invalid @enderror">

                                            <option value="">-- None --</option>

                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    {{ old('company_id', $user->company_id) == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('company_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Name --}}
                                    <div class="col-12 col-md-6">
                                        <label for="name" class="form-label fw-semibold">
                                            Name <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                            name="name"
                                            id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $user->name) }}"
                                            placeholder="Enter full name"
                                            required>

                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-12 col-md-6">
                                        <label for="email" class="form-label fw-semibold">
                                            Email Address <span class="text-danger">*</span>
                                        </label>

                                        <input type="email"
                                            name="email"
                                            id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $user->email) }}"
                                            placeholder="name@example.com"
                                            required>

                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Password --}}
                                    <div class="col-12 col-md-6">
                                        <label for="password" class="form-label fw-semibold">
                                            Password
                                        </label>

                                        <input type="password"
                                            name="password"
                                            id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            autocomplete="new-password"
                                            placeholder="Leave blank to keep current password">

                                        <div class="form-text">
                                            Leave blank to keep the current password unchanged.
                                        </div>

                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Phone --}}
                                    <div class="col-12 col-md-6">
                                        <label for="phone" class="form-label fw-semibold">
                                            Phone
                                        </label>

                                        <input type="text"
                                            name="phone"
                                            id="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone', $user->phone) }}"
                                            placeholder="Enter phone number">

                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Role --}}
                                    <div class="col-12 col-md-6">
                                        <label for="role" class="form-label fw-semibold">
                                            Role <span class="text-danger">*</span>
                                        </label>

                                        @php
                                            $roles = [
                                                'superadmin',
                                                'admin',
                                                'manager',
                                                'technician',
                                                'viewer',
                                            ];
                                        @endphp

                                        <select name="role"
                                            id="role"
                                            class="form-select @error('role') is-invalid @enderror"
                                            required>

                                            @foreach ($roles as $r)
                                                <option value="{{ $r }}"
                                                    {{ old('role', $user->role) == $r ? 'selected' : '' }}>
                                                    {{ ucfirst($r) }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Form Actions --}}
                                <div class="border-top mt-4 pt-4 d-flex flex-wrap justify-content-end gap-2">
                                    <a href="{{ route('admin.users.index') }}"
                                        class="btn btn-light border rounded-3 px-4">
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn btn-primary rounded-3 px-4">
                                        <i class="fas fa-save me-2"></i>Update User
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>

@include('admin.include.footer')
```