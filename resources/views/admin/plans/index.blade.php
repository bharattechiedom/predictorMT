@include('admin.include.header')





            <!-- Main Content -->

            <div class="col-md-9 col-lg-10 p-0">

                <!-- Top Navigation -->

                <nav class="navbar navbar-expand-lg navbar-custom">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1">

                            <i class="fas fa-tags me-2"></i>

                            Plans Management

                        </span>

                        <div class="navbar-nav ms-auto">

                            <a href="{{ route('admin.plans.create') }}" class="btn themeBtn">

                                <i class="fas fa-plus me-2"></i>Add Plan

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



                    <!-- Plans Table -->

                    <div class="card table-card bg-white p-3 border-0">

                        <div class="card-header bg-transparent theme-heading-color border-0">

                            <h5 class="mb-0">

                                <i class="fas fa-tags me-2"></i>

                                Plans List

                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-hover">

                                    <thead>

                                        <tr>

                                            <th>ID</th>

                                            <th>Name</th>

                                            <th>Price</th>

                                            <th>Machines Included</th>

                                            <th>Companies</th>

                                            <th>Created</th>

                                            <th>Actions</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @forelse($plans as $plan)

                                        <tr>

                                            <td>{{ $plan->id }}</td>

                                            <td>

                                                <strong>{{ $plan->name }}</strong>

                                            </td>

                                            <td>

                                                <span class="badge bg-success">${{ number_format($plan->price, 2) }}</span>

                                            </td>

                                            <td>{{ $plan->machines_included }}</td>

                                            <td>

                                                <span class="badge bg-info">{{ $plan->companies->count() }}</span>

                                            </td>

                                            <td>{{ $plan->created_at->format('M d, Y') }}</td>

                                            <td>

                                                <a href="{{ route('admin.plans.show', $plan) }}" 

                                                   class="btn btn-sm btn-outline-primary btn-action" 

                                                   title="View">

                                                    <i class="fas fa-eye"></i>

                                                </a>

                                                <a href="{{ route('admin.plans.edit', $plan) }}" 

                                                   class="btn btn-sm btn-outline-warning btn-action" 

                                                   title="Edit">

                                                    <i class="fas fa-edit"></i>

                                                </a>

                                                <form action="{{ route('admin.plans.destroy', $plan) }}" 

                                                      method="POST" 

                                                      style="display: inline;"

                                                      onsubmit="return confirm('Are you sure you want to delete this plan?')">

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

                                            <td colspan="7" class="text-center py-4">

                                                <i class="fas fa-tags fa-3x text-muted mb-3"></i>

                                                <p class="text-muted">No plans found. <a href="{{ route('admin.plans.create') }}">Create the first one</a></p>

                                            </td>

                                        </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                    <div class="mt-3">

                        {{ $plans->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>



    @include('admin.include.footer')