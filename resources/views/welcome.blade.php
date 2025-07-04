@extends('layouts.footer')
@extends('layouts.header')


  <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" style="height: 70vh;">
  <div class="carousel-inner h-100 ">
    <div class="carousel-item active h-100 ">
      <img src="https://i.pinimg.com/736x/c9/5e/17/c95e170113cf7fa3f3dc4d744a2cebf7.jpg" class="d-block w-100 h-100" alt="Featured Product 1" style="object-fit:  contain;">
      {{-- <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100 bg-dark bg-opacity-50">
        <h1 class="text-white fw-bold mb-2">Discover Our Best Skincare</h1>
        <p class="text-light">Shop now for radiant skin!</p>
      </div> --}}
    </div>
    <div class="carousel-item h-100">
      <img src="https://i.pinimg.com/736x/b8/7b/c5/b87bc5408eb78afb3aad889ede0ec3f0.jpg" class="d-block w-100 h-100" alt="Featured Product 2" style="object-fit: contain;">
      {{-- <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100 bg-dark bg-opacity-50">
        <h1 class="text-white fw-bold mb-2">Top Beauty Picks</h1>
        <p class="text-light">Glow up with our curated collection.</p>
      </div> --}}
    </div>
    <div class="carousel-item h-100">
      <img src="https://i.pinimg.com/736x/6a/5c/43/6a5c430f40946ec84ea83145a5c4ac85.jpg" class="d-block w-100 h-100" alt="Featured Product 3" style="object-fit: contain;">
      {{-- <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100 bg-dark bg-opacity-50">
        <h1 class="text-white fw-bold mb-2">Nature-Inspired Products</h1>
        <p class="text-light">Gentle on skin, powerful in results.</p>
      </div> --}}
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bg-danger" aria-hidden="true"></span>
    <span class="visually-hidden ">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon bg-danger" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>



  <!-- Products Section -->
  <section style="margin-top: 30px" class="products" id="products">
    <div class="container">
      <div class="section-header text-center mb-4">
        <h2>Our Products</h2>
        <p>Discover our bestselling skincare solutions</p>
      </div>

      <!-- Filter Buttons -->
      <div class="filter-tabs text-center mb-4">
        <button class="filter-btn active" data-filter="all">All</button>
        @php
          $categories = collect($products)->pluck('category.category_name')->unique();
        @endphp
        @foreach ($categories as $category)
          <button class="filter-btn" data-filter="{{ strtolower($category) }}">{{ $category }}</button>
        @endforeach
      </div>

      <!-- Product Grid -->
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 products-grid">
        @foreach ($products as $product)
          <div class="col product" data-category="{{ strtolower($product->category->category_name) }}">
            <div class="card h-100 w-75" data-item="{{ $product->name }}">
              <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
              <div class="card-body text-center">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="product-category">{{ $product->category->category_name }}</p>
                <div class="product-price">${{ number_format($product->price, 2) }}</div>
                <button class="btn btn-primary mt-2 w-100" onclick="showModal('{{ $product->name }}', {{ $product->price }}, '{{ asset('storage/' . $product->image) }}')">Quick View</button>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Modal for Order Confirmation -->
  <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="orderModalLabel">Order Confirmation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img id="modalItemImage" src="" alt="Item Image" class="img-fluid mb-3" style="max-width: 100px;">
          <p>Item: <span id="modalItemName"></span></p>
          <div class="quantity-controls">
            <button class="quantity-btn" onclick="updateQuantity(-1)">-</button>
            <span id="modalQuantity">1</span>
            <button class="quantity-btn" onclick="updateQuantity(1)">+</button>
          </div>
          <p>Total: $<span id="modalTotalPrice"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btn-sm" onclick="addToCart()">Add to Cart</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for View Cart -->
  <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cartModalLabel">Your Cart</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body cart-modal-body" id="cartModalBody">
          <!-- Cart items and summary will be dynamically inserted here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btn-sm" onclick="checkout()">Checkout</button>
        </div>
      </div>
    </div>
  </div>
  
 
  <!-- Bootstrap JS and Popper.js -->
  
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets/js/index.js')}}"></script>
</html>