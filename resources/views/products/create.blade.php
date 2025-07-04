@extends('layouts.app')

@section('content')
@section('title', 'Create products')
<div class="container mt-5">
    <h2>Add product</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
    <label>Category</label>
    <select name="category_id" class="form-control">
        <option value="">-- Select Category --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->category_name }}
            </option>
        @endforeach
    </select>
    @error("category_id")
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" >
            @error("name")
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control " >
            @error("price")
                <p class="text-danger">{{$message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label>Qty</label>
            <input type="number" name="qty" class="form-control" >
            @error("qty")
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" ></textarea>
            @error("description")
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" >
            @error("image")
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
