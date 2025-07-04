@extends('layouts.app')

@section('content')
@section('title',  'Dashboard')
<div class="mt-5 container">
      <h2 class="mb-4">Welcome to {{Auth::user()->name}}</h2>

      <!-- Stat Cards -->
      <div class="row g-4">
        <div class="col-md-3">
          <div class="card text-white bg-primary h-100">
            <div class="card-body">
              <h5 class="card-title">Total Products</h5>
              <p class="card-text fs-3">150</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-white bg-warning h-100">
            <div class="card-body">
              <h5 class="card-title">Low Stock</h5>
              <p class="card-text fs-3">12</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-white bg-success h-100">
            <div class="card-body">
              <h5 class="card-title">New Products</h5>
              <p class="card-text fs-3">8</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-white bg-danger h-100">
            <div class="card-body">
              <h5 class="card-title">Out of Stock</h5>
              <p class="card-text fs-3">5</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Product Table -->
      <div class="mt-5">
        <h4>Product List</h4>
        <table class="table table-bordered table-hover mt-3 bg-white">
          <thead class="table-light">
            <tr class="text-center">
              <th >ID</th>
              <th>Name</th>
              <th>Category</th>
              <th>Stock</th>
              <th>Price</th>
              <th>Image</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
           @foreach($products as $product )
          <tr class="text-center">
              <td>{{ $product->id }}</td>
              <td>{{ $product->name }}</td>
              <td>{{ $product->category->category_name ?? 'No Category' }}</td>
              <td>{{ $product->category->order ?? 'no order' }}</td>
              <td>${{ $product->price }}</td>
              <td>
                  <img src="{{ asset('storage/'.$product->image) }}" width="60" alt="Product Image">
              </td>
              <td>
                  @if(($product->category->order ?? 0) == 0)
                      <span class="badge bg-danger">Out of Stock</span>
                  @elseif(($product->category->order ?? 0) < 10)
                      <span class="badge bg-warning text-dark">Low Stock</span>
                  @else
                      <span class="badge bg-success">Available</span>
                  @endif
              </td>
          </tr>
          @endforeach
          </tbody>
        </table>
      </div>

      <!-- Recent Product Activity -->
      <div class="mt-5">
        <h4>Recent Product Activity</h4>
        <ul class="list-group">
          <li class="list-group-item">✅ New product <strong>iPad Air</strong> added</li>
          <li class="list-group-item">🔄 Stock updated for <strong>MacBook Pro</strong></li>
          <li class="list-group-item">⚠️ Low stock alert for <strong>Samsung Galaxy S22</strong></li>
        </ul>
      </div>
    </div>
@endsection