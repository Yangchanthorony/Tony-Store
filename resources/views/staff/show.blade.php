@extends('layouts.app')
@section('title', 'Staff Details')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow rounded-4 border-0">
                <div class="row g-0">
                    <!-- Image Column -->
                    <div class="col-md-5 text-center p-4">
                        @if ($staff->image)
                            <img src="{{ asset('storage/' . $staff->image) }}" alt="Staff Image"
                                 class="img-fluid rounded-3 shadow-sm" style="max-height: 250px;">
                        @else
                            <img src="https://via.placeholder.com/200x250?text=No+Image" alt="No Image"
                                 class="img-fluid rounded-3 shadow-sm" style="max-height: 250px;">
                        @endif
                    </div>

                    <!-- Details Column -->
                    <div class="col-md-7">
                        <div class="card-body">
                            <h3 class="card-title mb-3 text-primary fw-bold">{{ $staff->name }}</h3>

                            <p><strong class="text-secondary">Position:</strong>
                                <span class="text-dark">{{ $staff->section->section ?? '-'  }}</span></p>

                            <p><strong class="text-secondary">Gender:</strong>
                                <span class="text-dark">{{ $staff->gender }}</span></p>

                            <p><strong class="text-secondary">Email:</strong>
                                <span class="text-dark">{{ $staff->email }}</span></p>

                            <p><strong class="text-secondary">Phone:</strong>
                                <span class="text-dark">{{ $staff->phone }}</span></p>

                            <p><strong class="text-secondary">Address:</strong>
                                <span class="text-dark">{{ $staff->address }}</span></p>

                            <p><strong class="text-secondary">Date of Birth:</strong>
                                <span class="text-dark">{{ $staff->date_of_birth }}</span></p>

                            <a href="{{ route('staff.index') }}" class="btn btn-outline-secondary mt-3">
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
