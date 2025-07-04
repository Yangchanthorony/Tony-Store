@extends('layouts.app')
@section('title', 'Create Customers')
@section('content')
<div class="container mt-5">
    <h2>Create Customers</h2>
    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Name --}}
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            @error('name') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        {{-- Type --}}
        <div class="mb-3">
            <label class="form-label">Type</label>
            <select class="form-control" name="type">
                <option value="individual" {{ old('type') == 'individual' ? 'selected' : '' }}>Individual</option>
                <option value="company" {{ old('type') == 'company' ? 'selected' : '' }}>Company</option>
            </select>
            @error('type') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

         {{-- Category --}}
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select class="form-control" name="category_id">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        {{-- Phone --}}
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
            @error('phone') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        {{-- City --}}
        <div class="mb-3">
            <label class="form-label">City</label>
            <input type="text" class="form-control" name="city" value="{{ old('city') }}">
            @error('city') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        {{-- Country --}}
        <div class="mb-3">
            <label class="form-label">Country</label>
            <input type="text" class="form-control" name="country" value="{{ old('country') }}">
            @error('country') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        {{-- Date --}}
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" class="form-control" name="date" value="{{ old('date') }}">
            @error('date') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        {{-- Limitation Year --}}
        <div class="mb-3">
            <label class="form-label">Limitation Year</label>
            <input type="number" class="form-control" name="limitation_year" value="{{ old('limitation_year') }}">
            @error('limitation_year') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        {{-- Image --}}
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image">
            @error('image') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

       

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
