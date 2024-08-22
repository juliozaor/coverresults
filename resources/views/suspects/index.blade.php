@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Suspects</h1>
    <a href="{{ route('suspects.create') }}" class="btn btn-primary">Add Suspect</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Age</th>
                <th>State</th>
                <th>Address</th>
                <th>User</th>
                <th>Device</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suspects as $suspect)
                <tr>
                    <td>{{ $suspect->id }}</td>
                    <td>{{ $suspect->name }}</td>
                    <td>{{ $suspect->age }}</td>
                    <td>{{ $suspect->states->name }}</td>
                    <td>{{ $suspect->address }}</td>
                    <td>{{ $suspect->user->name }}</td>
                    <td>{{ $suspect->device->name }}</td>
                    <td>
                        <a href="{{ route('suspects.edit', $suspect->id) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('suspects.destroy', $suspect->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this suspect?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $suspects->links() }}
</div>
@endsection
