@include('admin.include.header')


<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">
                      Add Maintenance Task
                        </span>

                        <div class="navbar-nav ms-auto ">
                          
    
      <a href="{{ route('admin.maintenance-tasks.index') }}" class="btn themeBtn">Back</a>


                        </div>

                    </div>

                </nav>



<div class="main-content p-4">
  <div class="card bg-white p-3 border-0">



  @if ($errors->any())

    <div class="alert alert-danger">

      <ul class="mb-0">

        @foreach ($errors->all() as $error)

          <li>{{ $error }}</li>

        @endforeach

      </ul>

    </div>

  @endif



  <form method="POST" action="{{ route('admin.maintenance-tasks.store') }}" class="bg-white p-3 border-0 rounded">

    @csrf

    <div class="row g-3">

      <div class="col-md-6">

        <label class="form-label">Company</label>

        <select name="company_id" class="form-select" required>

          @foreach($companies as $company)

            <option value="{{ $company->id }}">{{ $company->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Machine</label>

        <select name="machine_id" class="form-select" required>

          @foreach($machines as $machine)

            <option value="{{ $machine->id }}">{{ $machine->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Created By</label>

        <select name="created_by" class="form-select" required>

          @foreach($users as $user)

            <option value="{{ $user->id }}">{{ $user->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Assigned To</label>

        <select name="assigned_to" class="form-select">

          <option value="">Unassigned</option>

          @foreach($users as $user)

            <option value="{{ $user->id }}">{{ $user->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Scheduled At</label>

        <input type="datetime-local" name="scheduled_at" class="form-control">

      </div>

      <div class="col-md-6">

        <label class="form-label">Completed At</label>

        <input type="datetime-local" name="completed_at" class="form-control">

      </div>

      <div class="col-md-6">

        <label class="form-label">Status</label>

        <select name="status" class="form-select" required>

          @foreach(['scheduled','in_progress','completed','cancelled'] as $status)

            <option value="{{ $status }}">{{ $status }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-12">

        <label class="form-label">Notes</label>

        <textarea name="notes" class="form-control" rows="3"></textarea>

      </div>

      <div class="col-md-6">

        <label class="form-label">Parts Required (JSON)</label>

        <textarea name="parts_required" class="form-control" rows="3" placeholder='[{"part":"bearing","qty":2}]'></textarea>

      </div>

      <div class="col-md-6">

        <label class="form-label">Cost Estimate</label>

        <input type="number" step="0.01" name="cost_estimate" class="form-control">

      </div>

    </div>

    <div class="mt-3">

      <button type="submit" class="btn btn-primary">Create</button>

    </div>

  </form>

</div>

</div>



@include('admin.include.footer')





