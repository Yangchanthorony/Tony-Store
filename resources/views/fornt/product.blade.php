@extends('layouts.header')
@extends('layouts.footer')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
</head>
<body>
  
    
    <section style="margin-top: 60px" class="products" id="products">
        <div class="container ">
            <div class="section-header">
                <h2>Our Products</h2>
                <p>Discover our bestselling skincare solutions</p>
            </div>
            <div class="filter-tabs">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="laptop">laptop</button>
                <button class="filter-btn" data-filter="smart phone">smart phone</button>
                <button class="filter-btn" data-filter="foundation">foundation</button>
                <button class="filter-btn" data-filter="powder">Powder</button>
                <button class="filter-btn" data-filter="eyeshadow">Eyeshadow</button>
                <button class="filter-btn" data-filter="eyeliner">Eyeliner</button>
                <button class="filter-btn" data-filter="eyebrow">Eyebrow</button>
                <button class="filter-btn" data-filter="mascara">Mascara</button>
            </div>
            <div class="products-grid">
                @foreach ($products as $product)
                <div class="product" data-category="{{ $product->category->category_name }}">
                    <div class="product-image">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        <span class="favorite-icon">♡</span>
                    </div>
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <p class="product-category">{{ $product->category->category_name}}</p>
                        <div class="product-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= $product->rating ? 'filled' : '' }}" data-value="{{ $i }}">★</span>
                                @endfor
                                <span class="rating-count">({{ $product->reviews_count }} reviews)</span>
                            </div>
                        <div class="product-price">${{ $product->price }}</div>
                        <div class="product-addquick">
                            <button class="add-to-cart" aria-label="Add {{ $product->name }} to Cart">Add to Cart</button>
                            <button class="quick-view" aria-label="View {{ $product->name }} Details">Quick View</button>
                        </div>
                    </div>
                </div>
                
                @endforeach

               
            </div>
        </div>
    </section>

   
</body>
<script src="/script.js"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
</html>