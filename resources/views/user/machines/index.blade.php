<?php

$page_title = "List View";

?>

 @include('user.include.header')



<div class="page-content p-3 bg-white">

 <div class="card-header d-flex justify-content-between align-items-center mb-3">

  <h3 class="header-title mb-0 fw-bold">Machines</h3>

  <div class="d-flex gap-2">

    <div class="search-box position-relative w-auto">

      <input type="text" class="form-control pe-5" id="machineSearch" placeholder="Search Machines...">

      <span class="position-absolute top-50 end-0 translate-middle-y pe-3" style="color: #ccc;">

        <i class="bi bi-search"></i>

      </span>

    </div>

    <a href="{{ route('user.machines.create') }}" class="btn btn-theme-color"><i class="fa-solid fa-plus me-1"></i> Add</a>

  </div>

</div>



  <div class="table-responsive">

    <div class="table-responsive">

    <table class="table table-hover table-bordered align-middle">

        <thead class="table-light">

            <tr>

                <th>#</th>

                <th>Machine</th>

                <th>Type</th>

                <th>Serial</th>

                <th>Plant</th>

                <th>Health</th>

                <th>Status</th>

                <th>Last Update</th>

                <th class="text-center" width="140">Action</th>

            </tr>

        </thead>

        <tbody>

            @forelse($machines as $machine)

            <tr>

                <td>
                    {{ $loop->iteration + ($machines->currentPage()-1)*$machines->perPage() }}
                </td>

                <td>
                    <strong>{{ $machine->name }}</strong>
                </td>

                <td>{{ $machine->machine_type }}</td>

                <td>{{ $machine->serial_number }}</td>

                <!-- Plant -->
                <td>
                    {{ $machine->location ?? 'Plant A' }}
                </td>

                <!-- Health -->
                <td>

                    @php
                        $health = rand(75,100);
                    @endphp

                    @if($health >= 90)
                        <span class="badge bg-success">{{ $health }}%</span>

                    @elseif($health >= 80)
                        <span class="badge bg-warning text-dark">{{ $health }}%</span>

                    @else
                        <span class="badge bg-danger">{{ $health }}%</span>
                    @endif

                </td>

                <!-- Status -->
                <td>

                    @if($machine->status == 'Running')

                        <span class="badge bg-success">
                            <i class="fas fa-circle me-1"></i>
                            Running
                        </span>

                    @elseif($machine->status == 'Idle')

                        <span class="badge bg-warning text-dark">
                            <i class="fas fa-pause-circle me-1"></i>
                            Idle
                        </span>

                    @elseif($machine->status == 'Fault')

                        <span class="badge bg-danger">
                            <i class="fas fa-triangle-exclamation me-1"></i>
                            Fault
                        </span>

                    @elseif($machine->status == 'Maintenance')

                        <span class="badge bg-info">
                            <i class="fas fa-screwdriver-wrench me-1"></i>
                            Maintenance
                        </span>

                    @else

                        <span class="badge bg-secondary">
                            {{ $machine->status ?? 'N/A' }}
                        </span>

                    @endif

                </td>

                <!-- Last Update -->
                <td>

                    {{ $machine->updated_at ? $machine->updated_at->diffForHumans() : '-' }}

                </td>

                <!-- Action -->
                <td>

                    <div class="d-flex justify-content-center gap-2 table-td-Btn">

                        <a href="{{ route('user.machines.show',$machine) }}"
                           class="btn btn-sm btn-outline-primary"
                           title="View">

                            <i class="fas fa-eye"></i>

                        </a>

                        <a href="{{ route('user.machines.edit',$machine) }}"
                           class="btn btn-sm btn-outline-warning"
                           title="Edit">

                            <i class="fas fa-pen"></i>

                        </a>

                        <form method="POST"
                              action="{{ route('user.machines.destroy',$machine) }}"
                              onsubmit="return confirm('Delete this machine?')">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-outline-danger"
                                    title="Delete">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="9" class="text-center">

                    <i class="fas fa-box-open text-muted me-2"></i>

                    No machines found.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

<div class="mt-3">
    {{ $machines->links() }}
</div>

  </div>



  <div class="mt-3">

    {{ $machines->links() }}

  </div>

</div>



<script>

(function() {

    'use strict';

    

    const searchInput = document.getElementById('machineSearch');

    const table = document.querySelector('.table tbody');

    

    if (searchInput && table) {

        searchInput.addEventListener('input', function() {

            const searchTerm = this.value.toLowerCase().trim();

            const rows = table.querySelectorAll('tr');

            

            rows.forEach(function(row) {

                if (row.querySelector('td[colspan]')) {

                    return;

                }

                

                const text = row.textContent.toLowerCase();

                row.style.display = text.includes(searchTerm) ? '' : 'none';

            });

        });

    }

})();

</script>



@include('user.include.footer')