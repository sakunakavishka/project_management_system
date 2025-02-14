@extends('layouts.marketing')

@section('content')
<div class="content">
    <h2>Edit Project</h2>

    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <input type="text" class="form-control" id="client_name" name="client_name" value="{{ $project->client_name }}" required>
        </div>

        <div class="mb-3">
            <label for="project_type" class="form-label">Project Type</label>
            <select class="form-control" id="project_type" name="project_type_id" required>
                <option value="">Select Project Type</option>
                @foreach($projectTypes as $type)
                    <option value="{{ $type->id }}" {{ $project->project_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="project_subcategory" class="form-label">Project Subcategory</label>
            <select class="form-control" id="project_subcategory" name="project_subcategory_id">
                <option value="">Select Subcategory</option>
                @foreach($project->projectType->subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" {{ $project->project_subcategory_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $project->price }}" required>
        </div>

        <div class="mb-3">
            <label for="starting_date" class="form-label">Starting Date</label>
            <input type="date" class="form-control" id="starting_date" name="starting_date" value="{{ $project->starting_date }}" required>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Note</label>
            <textarea class="form-control" id="note" name="note">{{ $project->note }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Project</button>
    </form>
</div>

<script>
    document.getElementById('project_type').addEventListener('change', function() {
        let typeId = this.value;
        let subcategorySelect = document.getElementById('project_subcategory');
        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

        if (typeId) {
            fetch(`/projects/get-subcategories/${typeId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(subcategory => {
                        subcategorySelect.innerHTML += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                    });
                });
        }
    });
</script>

@endsection
