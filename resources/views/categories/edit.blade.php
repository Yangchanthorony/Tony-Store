@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h2>Edit category</h2>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method("PATCH")
        <div class="mb-3">
            <label for="category_name" class="form-label">category_name</label>
            <input type="text" class="form-control" name="category_name" value="{{old("category_name", $category["category_name"])}}">
            @error("category_name")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="order" class="form-label">order</label>
            <input type="text" class="form-control" name="order" value="{{old("order", $category["order"])}}">
            @error("order")
                <p>{{$message}}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection