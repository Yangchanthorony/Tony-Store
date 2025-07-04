@extends('layouts.app')
@section('content')
@section('title', 'category List')
<div class="container mt-5">
    <h2>Create New Category</h2>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
    <label for="category_name" class="form-label">Category Name</label>
    <input type="text" class="form-control" name="category_name" value="{{ old('category_name') }}">
    @error('category_name')
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>

{{-- 
        <div class="mb-3">
            <label for="order" class="form-label">Order</label>
            <input type="text" class="form-control" name="order" value="{{ old('order') }}">
            @error('order')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div> --}}

        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>

<hr>

<div class="container">
 
    <table class="table">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $item)
                <tr>
                    <td>{{ $item->category_name }}</td>
                    <td>{{ $item->order }}</td>
                    <td>
                        
                        {{-- <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                        <form action="{{ route('categories.destroy', $item->id) }}" method="POST" style="display:inline;">
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
        {{ $categories->links() }}
</div>
@endsection



