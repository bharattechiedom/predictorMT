@include('admin.include.header')





            <!-- Main Content -->

            <div class="col-md-9 col-lg-10 p-0">

                <!-- Top Navigation -->

                <nav class="navbar navbar-expand-lg navbar-custom">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1">

                            <i class="fas fa-users me-2"></i>

                            Users Management

                        </span>

                        <div class="navbar-nav ms-auto">

                            <a href="{{ route('admin.users.create') }}" class="btn themeBtn">

                                <i class="fas fa-plus me-2"></i>Add User

                            </a>

                        </div>

                    </div>

                </nav>



                <div class="main-content">

                    @if (session('success'))

                        <div class="alert alert-success alert-dismissible fade show" role="alert">

                            <i class="fas fa-check-circle me-2"></i>

                            {{ session('success') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                        </div>

                    @endif



                    <!-- Users Table -->

                    <div class="card table-card bg-white p-3">

                        <div class="card-header bg-transparent theme-heading-color border-0">

                            <h5 class="mb-0">

                                <i class="fas fa-users me-2"></i>

                                Users List

                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-hover">

                                    <thead>

                                        <tr>

                                            <th>ID</th>

                                            <th>Name</th>

                                            <th>Email</th>

                                            <th>Role</th>

                                            <th>Company</th>

                                            <th>Phone</th>

                                            <th>Created</th>

                                            <th>Actions</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @forelse($users as $user)

                                        <tr>

                                            <td>{{ $user->id }}</td>

                                            <td>

                                                <strong>{{ $user->name }}</strong>

                                            </td>

                                            <td>{{ $user->email }}</td>

                                            <td>

                                                @php

                                                    $roleColors = [

                                                        'superadmin' => 'danger',

                                                        'admin' => 'warning',

                                                        'manager' => 'info',

                                                        'technician' => 'primary',

                                                        'viewer' => 'secondary'

                                                    ];

                                                @endphp

                                                <span class="badge bg-{{ $roleColors[$user->role] ?? 'secondary' }}">

                                                    {{ ucfirst($user->role) }}

                                                </span>

                                            </td>

                                            <td>

                                                @if($user->company)

                                                    <span class="badge bg-info">{{ $user->company->name }}</span>

                                                @else

                                                    <span class="badge bg-secondary">No Company</span>

                                                @endif

                                            </td>

                                            <td>{{ $user->phone ?? 'N/A' }}</td>

                                            <td>{{ $user->created_at->format('M d, Y') }}</td>

                                            <td>

                                                <a href="{{ route('admin.users.show', $user) }}" 

                                                   class="btn btn-sm btn-outline-primary btn-action" 

                                                   title="View">

                                                    <i class="fas fa-eye"></i>

                                                </a>

                                                <a href="{{ route('admin.users.edit', $user) }}" 

                                                   class="btn btn-sm btn-outline-warning btn-action" 

                                                   title="Edit">

                                                    <i class="fas fa-edit"></i>

                                                </a>

                                                <form action="{{ route('admin.users.destroy', $user) }}" 

                                                      method="POST" 

                                                      style="display: inline;"

                                                      onsubmit="return confirm('Are you sure you want to delete this user?')">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button type="submit" 

                                                            class="btn btn-sm btn-outline-danger btn-action" 

                                                            title="Delete">

                                                        <i class="fas fa-trash"></i>

                                                    </button>

                                                </form>

                                            </td>

                                        </tr>

                                        @empty

                                        <tr>

                                            <td colspan="8" class="text-center py-4">

                                                <i class="fas fa-users fa-3x text-muted mb-3"></i>

                                                <p class="text-muted">No users found. <a href="{{ route('admin.users.create') }}">Create the first one</a></p>

                                            </td>

                                        </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                    <div class="mt-3">

                        {{ $users->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>



    @include('admin.include.footer')

