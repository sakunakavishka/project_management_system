@extends('layouts.marketing')

@section('content')
<div class="content">
    <h2>Project List</h2>
    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Add New Project</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Client Name</th>
                <th>Project Type</th>
                <th>Subcategory</th>
                <th>Price</th>
                <th>Starting Date</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $key => $project)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $project->client_name }}</td>
                    <td>{{ $project->projectType->name }}</td>
                    <td>{{ $project->projectSubcategory->name ?? 'N/A' }}</td>
                    <td>{{ number_format($project->price, 2) }}</td>
                    <td>{{ $project->starting_date }}</td>
                    <td>{{ $project->note }}</td>
                    <td>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $projects->links() }}
</div>
@endsection
