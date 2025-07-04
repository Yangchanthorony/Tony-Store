@extends('layouts.app')
@section('content')
@section('title', 'Staff List')
<div class="container mt-5">
    <h2>Staff List</h2>
    <a href="{{ route('staff.create') }}" class="btn btn-primary mb-3">Create Staff</a>
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Date of Birth</th>
                <th>Image</th>
                <th>Actions</th> {{-- ✅ Fixed this line placement --}}
            </tr>
        </thead>
        <tbody class="text-center">
            {{-- Loop through the staff data --}}
            @foreach ($staff as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->section->section ?? '-' }}</td>
                    <td>{{ $item->gender }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->date_of_birth }}</td>
                    
                     <td><img src="{{ asset('storage/'.$item->image) }}" width="80" height="80"  ></td>
                   

                    <td>
                        <a href="{{ route('staff.show', $item->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('staff.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('staff.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $staff->links() }}
</div>
@endsection
