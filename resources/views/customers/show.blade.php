@extends('layouts.app')
@section('title', 'customer Details')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow rounded-4 border-0">
                <div class="row g-0">
                    <div class="col-md-5 text-center p-4">
                        @if ($customer->image && Storage::disk('public')->exists($customer->image))
                            <img src="{{ asset('storage/'.$customer->image) }}" alt="customer Image"
                                 class="img-fluid rounded-3 shadow-sm" style="max-height: 250px;">
                        @else
                            <div class="text-muted fst-italic mt-5">No image available</div>
                        @endif
                    </div>

                    <div class="col-md-7">
                        <div class="card-body">
                            <h3 class="card-title mb-3 text-primary fw-bold">{{ $customer->name }}</h3>

                            <p><strong class="text-secondary">type:</strong>
                                 <span class=" text-dark">{{ $customer->type }}</span>
                            </p>

                            <p><strong class="text-secondary">Category:</strong>
                                {{ $customer->category->category_name ?? 'Uncategorized' }}</p>

                                <p><strong class="text-secondary">Limitation Year:</strong>
                                <span class=" text-dark">{{ $customer->limitation_year }}</span></p>


                            <p><strong class="text-secondary">country:</strong>
                                <span class=" text-dark">{{ $customer->country }}</span></p>

                            

                            <p><strong class="text-secondary">city:</strong>
                                <span class=" text-dark">{{ $customer->city }}</span></p>

                             <p><strong class="text-secondary">phone:</strong>
                                <span class=" text-dark">{{ $customer->phone }}</span></p>


                            <p><strong  class="text-muted small mt-4">Created on: </strong>
                                 {{ $customer->created_at->format('F d, Y') }}</p>

                            <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary mt-3">
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
