@include('admin.include.header')





            <!-- Main Content -->

            <div class="col-md-9 col-lg-10 p-0">

                <!-- Top Navigation -->

                <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">

                            <i class="fas fa-building me-2"></i>

                            Companies Management

                        </span>

                        <div class="navbar-nav ms-auto">

                            <a href="{{ route('admin.companies.create') }}" class="btn themeBtn">

                                <i class="fas fa-plus me-2"></i>Add Company

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



                    <!-- Companies Table -->

                    <div class="card table-card bg-white p-3">

                        <div class="card-header bg-transparent theme-heading-color border-0">

                            <h5 class="mb-0">

                                <i class="fas fa-building me-2"></i>

                                Companies List

                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-hover">

                                    <thead>

                                        <tr>

                                            <th>ID</th>

                                            <th>Name</th>

                                            <th>Country</th>

                                            <th>Timezone</th>

                                            <th>Plan</th>

                                            <th>Created</th>

                                            <th>Actions</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @forelse($companies as $company)

                                        <tr>

                                            <td>{{ $company->id }}</td>

                                            <td>

                                                <strong>{{ $company->name }}</strong>

                                            </td>

                                            <td>

                                                <span class="badge bg-info">{{ $company->country ?? 'N/A' }}</span>

                                            </td>

                                            <td>{{ $company->timezone }}</td>

                                            <td>

                                                @if($company->plan)

                                                    <span class="badge bg-success">{{ $company->plan->name }}</span>

                                                @else

                                                    <span class="badge bg-secondary">No Plan</span>

                                                @endif

                                            </td>

                                            <td>{{ $company->created_at->format('M d, Y') }}</td>

                                            <td>

                                                <a href="{{ route('admin.companies.show', $company) }}" 

                                                   class="btn btn-sm btn-outline-primary btn-action" 

                                                   title="View">

                                                    <i class="fas fa-eye"></i>

                                                </a>

                                                <a href="{{ route('admin.companies.edit', $company) }}" 

                                                   class="btn btn-sm btn-outline-warning btn-action" 

                                                   title="Edit">

                                                    <i class="fas fa-edit"></i>

                                                </a>

                                                <form action="{{ route('admin.companies.destroy', $company) }}" 

                                                      method="POST" 

                                                      style="display: inline;"

                                                      onsubmit="return confirm('Are you sure you want to delete this company?')">

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

                                                <i class="fas fa-building fa-3x text-muted mb-3"></i>

                                                <p class="text-muted">No companies found. <a href="{{ route('admin.companies.create') }}">Create the first one</a></p>

                                            </td>

                                        </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                    <div class="mt-3">

                        {{ $companies->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>



    @include('admin.include.footer')

