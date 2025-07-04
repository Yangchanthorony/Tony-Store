@extends('layouts.app') {{-- or use another layout --}}
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow p-4">
                <h2 class="text-center mb-4">User Profile</h2>

                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td>{{ $user->date_of_birth }}</td>
                    </tr>
                    <tr>
                        <th>Profile Image</th>
                        <td>
                            @if($user->profile_image)
                                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="img-thumbnail" width="100">
                            @else
                                No image uploaded
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
