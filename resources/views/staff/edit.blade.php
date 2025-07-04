@extends('layouts.app')
@section('content')
@section('title', 'Staff edit')
<div class="container mt-5">
    <h2>Edit staff</h2>
<form action="{{ route('staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PATCH")

    <!-- Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="{{ old('name', $staff->name) }}">
        @error("name") <p>{{ $message }}</p> @enderror
    </div>

    <!-- Section Dropdown -->
    <select name="section_id" class="form-control">
        <option value="">-- Select staff --</option>
        @foreach ($employees as $employee)
            <option value="{{ $employee->id }}"
                {{ old('section_id', $staff->section_id) == $employee->id ? 'selected' : '' }}>
                {{ $employee->section }}
            </option>
        @endforeach
    </select>

    <!-- Gender -->
    <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        <input type="text" class="form-control" name="gender" value="{{ old('gender', $staff->gender) }}">
        @error("gender") <p>{{ $message }}</p> @enderror
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" value="{{ old('email', $staff->email) }}">
        @error("email") <p>{{ $message }}</p> @enderror
    </div>

    <!-- Phone -->
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" name="phone" value="{{ old('phone', $staff->phone) }}">
        @error("phone") <p>{{ $message }}</p> @enderror
    </div>

    <!-- Address -->
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" name="address" value="{{ old('address', $staff->address) }}">
        @error("address") <p>{{ $message }}</p> @enderror
    </div>

    <!-- Date of Birth -->
    <div class="mb-3">
        <label for="date_of_birth" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $staff->date_of_birth) }}">
        @error("date_of_birth") <p>{{ $message }}</p> @enderror
    </div>

   <!-- Image -->
<div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" name="image" onchange="previewImage(event)">
    @error("image") <p>{{ $message }}</p> @enderror

    @if($staff->image)
        <img id="preview" src="{{ asset('storage/' . $staff->image) }}" alt="Current Image" width="120" class="mt-2">
    @else
        <img id="preview" src="#" alt="Preview Image" style="display: none;" width="100" class="mt-2">
    @endif
</div>


    <button type="submit" class="btn btn-primary">Submit</button>
</form>
    
</div>
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection