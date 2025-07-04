@extends('layouts.app')

@section('title', 'Products List')

@section('content')
<div class="container-fluid mt-5">
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>
     @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
            <tr class=" text-center "> 
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category->category_name }}</td>
                <td>${{ $item->price }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->description }}</td>
                <td><img src="{{ asset('storage/'.$item->image) }}" width="80" height="80"  ></td>
                <td class="text-center">
                    <a href="{{ route('products.show', $item->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $item->id) }}" method="POST" class="d-inline">
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
        {{ $products->links() }}
    </div>
</div>
@endsection
