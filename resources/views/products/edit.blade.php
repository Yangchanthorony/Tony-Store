@extends('layouts.app')
@section('title', 'Edit Product')
@section('content')

<div class="container mt-5">
    <h2>Edit Product</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

            <select name="category_id" class="form-control">
            <option value="">-- Select Category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" name="price" value="{{ old('price', $product->price) }}">
            @error('price')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="qty" class="form-label">Quantity</label>
            <input type="text" class="form-control" name="qty" value="{{ old('qty', $product->qty) }}">
            @error('qty')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" value="{{ old('description', $product->description) }}">
            @error('description')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>



        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" id="imageInput">
            <div class="mt-2">
                <img id="previewImage" src="{{ asset('storage/'.$product->image) }}" width="100" class="rounded shadow-sm">
            </div>
            @error('image')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const [file] = this.files;
        if (file) {
            const preview = document.getElementById('previewImage');
            preview.src = URL.createObjectURL(file);
            preview.onload = () => URL.revokeObjectURL(preview.src);
        }
    });
</script>

@endsection
