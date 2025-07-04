@extends('layouts.app')
@section('content')
@section('title', 'Staff List')
<div class="container mt-5">
     <h2>Create New Employee</h2>
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="section" class="form-label">Section</label>
            <input type="text" class="form-control" name="section" value="{{ old('section') }}">
            @error("section")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- <div class="mb-3">
            <label for="qty" class="form-label">qty</label>
            <input type="text" class="form-control" name="qty" value="{{ old('qty') }}">
            @error("qty")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div> --}}

        <button type="submit" class="btn btn-primary">Add</button>
    </form>

    <hr>

   

    <table class="table">
        <thead>
            <tr>
                <th>Section</th>
                <th>qty</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $item)
                <tr>
                    <td>{{ $item->section }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>
                        {{-- <a href="{{ route('employees.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                        <form action="{{ route('employees.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $employees->links() }}

</div>
@endsection
