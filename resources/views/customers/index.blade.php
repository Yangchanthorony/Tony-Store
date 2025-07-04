@extends('layouts.app')
@section('title', 'Customers List')
@section('content')

<div class="container mt-5">
    <h2>Customers List</h2>
    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Create Customer</a>
     @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Phone</th>
                <th>City</th>
                <th>Country</th>
                <th>Date</th>
                <th>Limitation Year</th>
                <th>Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($customers as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->city }}</td>
                    <td>{{ $item->country }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->limitation_year }}</td>
                    <td>{{ $item->category->category_name ?? 'N/A' }}</td>
                    <td>
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" width="80" height="80"  alt="Customer Image">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('customers.show', $item->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('customers.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('customers.destroy', $item->id) }}" method="POST" style="display:inline;">
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
        {{ $customers->links() }}
</div>
@endsection
