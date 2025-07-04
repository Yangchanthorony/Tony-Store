@extends('layouts.app')
@section('title', 'Product Details')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow rounded-4 border-0">
                <div class="row g-0">
                    <div class="col-md-5 text-center p-4">
                        <img src="{{ asset('storage/'.$product->image) }}" alt="Product Image"
                             class="img-fluid rounded-3 shadow-sm" style="max-height: 250px;">
                    </div>

                    <div class="col-md-7">
                        <div class="card-body">
                            <h3 class="card-title mb-3 text-primary fw-bold">{{ $product->name }}</h3>

                            <p><strong class="text-secondary">Price:</strong>
                                <span class="badge bg-success fs-6">${{ number_format($product->price, 2) }}</span></p>

                            <p><strong class="text-secondary">Quantity:</strong>
                                <span class="badge bg-warning text-dark">{{ $product->qty }}</span></p>

                            <p><strong class="text-secondary">Description:</strong></p>
                            <p class="text-muted">{{ $product->description }}</p>

                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary mt-3">
                                ← Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
