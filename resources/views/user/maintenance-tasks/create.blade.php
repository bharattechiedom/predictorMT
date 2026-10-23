<?php

$page_title = "Create Maintenance Task";

?>

@include('user.include.header')



<div class="wrapper active">

    <div class="page-content">

        <div class="page-container p-3">

            <div class="card bg-white">

                <div class="card-header">

                    <h4 class="mb-0">Create Maintenance Task</h4>

                </div>

                <div class="card-body">

                    <form action="{{ route('user.maintenance-tasks.store') }}" method="POST">

                        @csrf

                        

                        @if($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                        @endif



                        <div class="row g-3">

                            <div class="col-md-6">

                                <label for="machine_id" class="form-label">Machine <span class="text-danger">*</span></label>

                                <select class="form-select @error('machine_id') is-invalid @enderror" 

                                        id="machine_id" name="machine_id" required>

                                    <option value="">Select Machine</option>

                                    @foreach($machines as $machine)

                                    <option value="{{ $machine->id }}" {{ old('machine_id') == $machine->id ? 'selected' : '' }}>

                                        {{ $machine->name }} ({{ $machine->machine_type }})

                                    </option>

                                    @endforeach

                                </select>

                                @error('machine_id')

                                <div class="invalid-feedback">{{ $message }}</div>

                                @enderror

                            </div>



                            <div class="col-md-6">

                                <label for="assigned_to" class="form-label">Assign To</label>

                                <select class="form-select @error('assigned_to') is-invalid @enderror" 

                                        id="assigned_to" name="assigned_to">

                                    <option value="">Select Technician</option>

                                    @foreach($technicians as $tech)

                                    <option value="{{ $tech->id }}" {{ old('assigned_to') == $tech->id ? 'selected' : '' }}>

                                        {{ $tech->name }}

                                    </option>

                                    @endforeach

                                </select>

                                @error('assigned_to')

                                <div class="invalid-feedback">{{ $message }}</div>

                                @enderror

                            </div>



                            <div class="col-md-6">

                                <label for="scheduled_at" class="form-label">Schedule Date <span class="text-danger">*</span></label>

                                <input type="datetime-local" 

                                       class="form-control @error('scheduled_at') is-invalid @enderror" 

                                       id="scheduled_at" 

                                       name="scheduled_at" 

                                       value="{{ old('scheduled_at') }}" 

                                       required>

                                @error('scheduled_at')

                                <div class="invalid-feedback">{{ $message }}</div>

                                @enderror

                            </div>



                            <div class="col-md-6">

                                <label for="cost_estimate" class="form-label">Cost Estimate ($)</label>

                                <input type="number" 

                                       class="form-control @error('cost_estimate') is-invalid @enderror" 

                                       id="cost_estimate" 

                                       name="cost_estimate" 

                                       value="{{ old('cost_estimate') }}" 

                                       step="0.01" 

                                       min="0">

                                @error('cost_estimate')

                                <div class="invalid-feedback">{{ $message }}</div>

                                @enderror

                            </div>



                            <div class="col-12">

                                <label for="notes" class="form-label">Notes</label>

                                <textarea class="form-control @error('notes') is-invalid @enderror" 

                                          id="notes" 

                                          name="notes" 

                                          rows="4">{{ old('notes') }}</textarea>

                                @error('notes')

                                <div class="invalid-feedback">{{ $message }}</div>

                                @enderror

                            </div>



                            <div class="col-12">

                                <label for="parts_required" class="form-label">Parts Required</label>

                                <div class="parts-container" id="partsContainer">

                                    <div class="row g-2 mb-2 part-row">

                                        <div class="col-5">

                                            <input type="text" class="form-control" name="parts[0][name]" placeholder="Part Name">

                                        </div>

                                        <div class="col-3">

                                            <input type="number" class="form-control" name="parts[0][quantity]" placeholder="Qty" min="1">

                                        </div>

                                        <div class="col-3">

                                            <input type="number" class="form-control" name="parts[0][cost]" placeholder="Cost" step="0.01" min="0">

                                        </div>

                                        <div class="col-1">

                                            <button type="button" class="btn btn-danger remove-part" disabled>

                                                <i class="bi bi-dash"></i>

                                            </button>

                                        </div>

                                    </div>

                                </div>

                                <button type="button" class="btn btn-sm btn-secondary mt-2" id="addPart">

                                    <i class="bi bi-plus"></i> Add Part

                                </button>

                            </div>



                            <div class="col-12 mt-4">

                                <div class="d-flex justify-content-end gap-2">

                                    <a href="{{ route('user.maintenance-tasks.index') }}" class="btn btn-secondary">Cancel</a>

                                    <button type="submit" class="btn btn-primary">Create Task</button>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>



<script>
let partIndex = 1;

document.getElementById('addPart').addEventListener('click', function () {

    const container = document.getElementById('partsContainer');

    const newRow = document.createElement('div');
    newRow.className = 'row g-2 mb-2 part-row';

    newRow.innerHTML = `
        <div class="col-5">
            <input type="text" class="form-control" name="parts[${partIndex}][name]" placeholder="Part Name">
        </div>
        <div class="col-3">
            <input type="number" class="form-control" name="parts[${partIndex}][quantity]" placeholder="Qty" min="1">
        </div>
        <div class="col-3">
            <input type="number" class="form-control" name="parts[${partIndex}][cost]" placeholder="Cost" step="0.01" min="0">
        </div>
        <div class="col-1">
            <button type="button" class="btn btn-danger remove-part">
                -
            </button>
        </div>
    `;

    container.appendChild(newRow);
    partIndex++;
});

document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove-part')){
        e.target.closest('.part-row').remove();
    }
});
</script>

@include('user.include.footer')