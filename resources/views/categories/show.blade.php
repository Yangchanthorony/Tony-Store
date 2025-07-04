@extends('layouts.app')
@section('content mt-5')
<div class="container">
    <h2>category Details</h2>
     <p><strong>category_name:</strong> {{ $category ->category_name }}</p>
<p><strong>order:</strong> {{ $category ->order }}</p>

</div>
@endsection
