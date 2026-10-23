<?php

$page_title = "Sensors";

?>



@include('user.include.header')

<body>

  <div class="wrapper active">

    <div class="page-content">

      <div class="page-container p-3">

        <div class="meetingPpage">

          <!--  Header -->

          <div class="card-header d-flex flex-wrap align-items-center gap-2 mb-3">

            <div class="flex-grow-1">

              <h3 class="header-title mb-0">Sensor Management</h3>

              

            </div>



            <div class="d-flex gap-2">

              

              <a href="{{ route('user.sensors.create') }}" class="btn btn-theme-color"><i class="fa-solid fa-plus me-1"></i> Add Sensor</a>

            </div>

          </div>



          @if(session('success'))

          <div class="alert alert-success alert-dismissible fade show" role="alert">

              {{ session('success') }}

              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

          </div>

          @endif




          <div class="row">

            <!-- Sensors Summary -->

            <div class="col-12">

              <div>

                <div class="table-responsive">

                  <table class="table table-hover table-bordered">

                    <thead class="bg-light">

                      <tr>

                        <th>Device ID</th>

                        <th>Sensor</th>

                        <th>Machine</th>

                        <th>Type</th>

                        <th>Current Value</th>

                        <th>Unit</th>

                        <th>Status</th>

                        <th>Battery</th>

                        <th>Last Seen</th>

                        <th class="text-center" width="100">Actions</th>

                      </tr>

                    </thead>

                    <tbody>

                      @forelse($sensors as $sensor)

                      <tr>

                        <td>{{ $sensor->device_id }}</td>

                        <td>Temperature</td>

                        <td>{{ $sensor->machine->name }}</td>

                        <td>{{ $sensor->sensor_type }}</td>

                        <td>68</td>
                        <td>°C</td>

                        <td>

                          @php

                            $statusClass = [

                                'active' => 'success',

                                'inactive' => 'warning',

                                'faulty' => 'danger',

                                'provisioning' => 'info'

                            ][$sensor->status] ?? 'secondary';

                          @endphp

                          <span class="badge bg-{{ $statusClass }}">{{ $sensor->status }}</span>

                        </td>

                        <td>

                          @if($sensor->battery_level !== null)

                          <div class="progress" style="height: 20px;">

                            <div class="progress-bar bg-{{ $sensor->battery_level > 20 ? 'success' : 'danger' }}" 

                                 role="progressbar" 

                                 style="width: {{ $sensor->battery_level }}%">

                              {{ $sensor->battery_level }}%

                            </div>

                          </div>

                          @else

                          N/A

                          @endif

                        </td>

                        <td>{{ $sensor->last_seen ? $sensor->last_seen->diffForHumans() : 'Never' }}</td>

                        <td>

                          <div class="d-flex gap-2 table-td-Btn">

                            <a href="{{ route('user.sensors.edit', $sensor) }}" class="btn btn-sm btn-outline-info">

                              <i class="bi bi-pencil"></i>

                            </a>

                            <a href="{{ route('user.sensors.show', $sensor) }}" class="btn btn-sm btn-outline-info">

                              <i class="bi bi-eye"></i>

                            </a>

                            <form method="POST" action="{{ route('user.sensors.destroy', $sensor) }}" 

                                  onsubmit="return confirm('Are you sure you want to delete this sensor?');" 

                                  style="display: inline;">

                              @csrf

                              @method('DELETE')

                              <button type="submit" class="btn btn-sm btn-outline-info  ">

                                <i class="bi bi-trash"></i>

                              </button>

                            </form>

                          </div>

                        </td>

                      </tr>

                      @empty

                      <tr>

                        <td colspan="7" class="text-center">No sensors found</td>

                      </tr>

                      @endforelse

                    </tbody>

                  </table>

                </div>

                <div class="mt-3">

                  {{ $sensors->links() }}

                </div>

              </div>

            </div>

          </div> <!-- /row -->

        </div> <!-- /meetingPpage -->

      </div> <!-- /page-container -->

    </div> <!-- /page-content -->

  </div> <!-- /wrapper -->



<script>

(function() {

    'use strict';

    

    const searchInput = document.getElementById('sensorSearch');

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

 

</body>



@include('user.include.footer')