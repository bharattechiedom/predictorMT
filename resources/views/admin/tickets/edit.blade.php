
@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">
            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">
                <div class="main-content p-3 p-md-4">

                    {{-- Page Header --}}
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
                        <div>
                            <h4 class="fw-bold mb-1">Edit Ticket</h4>
                            <p class="text-muted mb-0">
                                Update support ticket information and status.
                            </p>
                        </div>

                        <a href="{{ route('admin.tickets.index') }}"
                           class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Tickets
                        </a>
                    </div>

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="fw-semibold mb-2">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                Please fix the following errors:
                            </div>

                            <ul class="mb-0 ps-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Edit Ticket Form --}}
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex align-items-center gap-3">
                                <span class="bg-light text-primary rounded-3 p-3">
                                    <i class="fas fa-edit fa-lg"></i>
                                </span>

                                <div>
                                    <h5 class="fw-bold mb-1">Ticket Information</h5>
                                    <p class="text-muted small mb-0">
                                        Editing Ticket #{{ $ticket->id }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4 border-top">
                            <form method="POST"
                                  action="{{ route('admin.tickets.update', $ticket) }}">
                                @csrf
                                @method('PUT')

                                <div class="row g-4">

                                    {{-- Company --}}
                                    <div class="col-12 col-md-6">
                                        <label for="company_id" class="form-label fw-semibold">
                                            Company <span class="text-danger">*</span>
                                        </label>

                                        <select name="company_id"
                                                id="company_id"
                                                class="form-select @error('company_id') is-invalid @enderror"
                                                required>
                                            <option value="">Select Company</option>

                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    {{ old('company_id', $ticket->company_id) == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('company_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- User --}}
                                    <div class="col-12 col-md-6">
                                        <label for="user_id" class="form-label fw-semibold">
                                            User <span class="text-danger">*</span>
                                        </label>

                                        <select name="user_id"
                                                id="user_id"
                                                class="form-select @error('user_id') is-invalid @enderror"
                                                required>
                                            <option value="">Select User</option>

                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ old('user_id', $ticket->user_id) == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('user_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Subject --}}
                                    <div class="col-12">
                                        <label for="subject" class="form-label fw-semibold">
                                            Subject <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                               name="subject"
                                               id="subject"
                                               class="form-control @error('subject') is-invalid @enderror"
                                               value="{{ old('subject', $ticket->subject) }}"
                                               placeholder="Enter ticket subject"
                                               required>

                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-12">
                                        <label for="description" class="form-label fw-semibold">
                                            Description <span class="text-danger">*</span>
                                        </label>

                                        <textarea name="description"
                                                  id="description"
                                                  class="form-control @error('description') is-invalid @enderror"
                                                  rows="5"
                                                  placeholder="Describe the issue or request..."
                                                  required>{{ old('description', $ticket->description) }}</textarea>

                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-12 col-md-6">
                                        <label for="status" class="form-label fw-semibold">
                                            Status <span class="text-danger">*</span>
                                        </label>

                                        <select name="status"
                                                id="status"
                                                class="form-select @error('status') is-invalid @enderror"
                                                required>
                                            @foreach(['open', 'pending', 'resolved', 'closed'] as $status)
                                                <option value="{{ $status }}"
                                                    {{ old('status', $ticket->status) === $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Priority --}}
                                    <div class="col-12 col-md-6">
                                        <label for="priority" class="form-label fw-semibold">
                                            Priority <span class="text-danger">*</span>
                                        </label>

                                        <select name="priority"
                                                id="priority"
                                                class="form-select @error('priority') is-invalid @enderror"
                                                required>
                                            @foreach(['low', 'medium', 'high'] as $priority)
                                                <option value="{{ $priority }}"
                                                    {{ old('priority', $ticket->priority) === $priority ? 'selected' : '' }}>
                                                    {{ ucfirst($priority) }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('priority')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Form Actions --}}
                                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4 pt-3 border-top">
                                    <a href="{{ route('admin.tickets.index') }}"
                                       class="btn btn-dark fs-14">
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn theme-btn">
                                        <i class="fas fa-save me-2"></i>Update Ticket
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
