@extends('layouts.app')
@section('title', 'Edit Customer')
@section('content')

<div class="container mt-5">
    <h2>Edit Customer</h2>
    <form action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PATCH")

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $customer->name) }}">
            @error("name")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" class="form-control">
                <option value="individual" {{ old('type', $customer->type) == 'individual' ? 'selected' : '' }}>Individual</option>
                <option value="company" {{ old('type', $customer->type) == 'company' ? 'selected' : '' }}>Company</option>
            </select>
            @error("type")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone', $customer->phone) }}">
            @error("phone")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" name="city" value="{{ old('city', $customer->city) }}">
            @error("city")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" class="form-control" name="country" value="{{ old('country', $customer->country) }}">
            @error("country")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" name="date" value="{{ old('date', $customer->date) }}">
            @error("date")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="limitation_year" class="form-label">Limitation Year</label>
            <input type="number" class="form-control" name="limitation_year" value="{{ old('limitation_year', $customer->limitation_year) }}">
            @error("limitation_year")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $customer->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            @error("category_id")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="imageInput" name="image"  accept="image/*">

            <div class="mt-2">
                <img id="previewImage" 
                     src="{{ $customer->image ? asset('storage/' . $customer->image) : ''  }}"  width="100"  ></div>

            @error("image")
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>

<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
        }
        if(event.target.files[0]){
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>

@endsection
