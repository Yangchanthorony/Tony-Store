@extends('layouts.app')

@section('content')
@section('title', 'Create Staff')
<div class="container mt-5">
    <h2>Create Staff</h2>

    <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

         <div class="mb-3">
            <label for="section_id" class="form-label">Section</label>
            <select class="form-control" name="section_id">
                <option value="">-- Select Section --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('section_id') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->section }}
                    </option>
                @endforeach
            </select>
            @error('section_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" class="form-control" name="position" value="{{ old('position') }}">
            @error('position')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div> --}}

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <input type="text" class="form-control" name="gender" value="{{ old('gender') }}">
            @error('gender')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" name="address" value="{{ old('address') }}">
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}">
            @error('date_of_birth')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

       

        <div class="mb-3">
            <label for="image" class="form-label">Profile Image</label>
            <input type="file" class="form-control" name="image">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Staff</button>
    </form>
</div>
@endsection
