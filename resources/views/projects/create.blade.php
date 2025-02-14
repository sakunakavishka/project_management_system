@extends('layouts.marketing')

@section('content')
<div class="content">
    <h2>Create New Project</h2>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <input type="text" class="form-control" id="client_name" name="client_name" required>
        </div>

        <div class="mb-3">
            <label for="project_type_id" class="form-label">Project Type</label>
            <select class="form-control" id="project_type_id" name="project_type_id" required>
                <option value="">Select Project Type</option>
                @foreach($projectTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="project_subcategory_id" class="form-label">Project Subcategory</label>
            <select class="form-control" id="project_subcategory_id" name="project_subcategory_id">
                <option value="">Select Subcategory</option>
                @foreach($projectTypes as $type)
                    <optgroup label="{{ $type->name }}">
                        @foreach($type->subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>

        <div class="mb-3">
            <label for="starting_date" class="form-label">Starting Date</label>
            <input type="date" class="form-control" id="starting_date" name="starting_date" required>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Note</label>
            <textarea class="form-control" id="note" name="note"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Create Project</button>
    </form>
</div>
@endsection
