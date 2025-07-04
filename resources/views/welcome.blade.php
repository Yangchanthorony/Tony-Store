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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    let cart = [];
    let currentItem = '';
    let currentPrice = 0;
    let currentImage = '';
    let cartModal = null;

    function showModal(itemName, price, imageUrl) {
      currentItem = itemName;
      currentPrice = price;
      currentImage = imageUrl;
      document.getElementById('modalItemName').textContent = itemName;
      document.getElementById('modalItemImage').src = imageUrl;
      document.getElementById('modalTotalPrice').textContent = price.toFixed(2);
      document.getElementById('modalQuantity').textContent = '1';
      var modal = new bootstrap.Modal(document.getElementById('orderModal'));
      modal.show();
    }

    function updateQuantity(change) {
      let quantityElement = document.getElementById('modalQuantity');
      let quantity = parseInt(quantityElement.textContent);
      quantity += change;

      if (quantity < 1) quantity = 1;
      quantityElement.textContent = quantity;

      let total = currentPrice * quantity;
      document.getElementById('modalTotalPrice').textContent = total.toFixed(2);
    }

    function addToCart() {
      let quantity = parseInt(document.getElementById('modalQuantity').textContent);
      let total = currentPrice * quantity;
      let timestamp = new Date().toLocaleString('en-US', { timeZone: 'Asia/Bangkok', hour12: true });
      cart.push({ item: currentItem, quantity: quantity, price: currentPrice, total: total, image: currentImage, addedAt: timestamp, description: 'High-quality product' });
      updateCartCount();
      alert(`Added ${quantity} x ${currentItem} to cart! Total: $${total.toFixed(2)}`);
      var modal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
      modal.hide();
    }

    function updateCartCount() {
      let totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
      let cartCount = document.getElementById('cartCount');
      cartCount.textContent = totalItems;
      cartCount.classList.toggle('d-none', totalItems === 0);
    }

    function updateCartItemQuantity(event, index, change) {
      event.preventDefault();
      let item = cart[index];
      let newQuantity = item.quantity + change;
      if (newQuantity < 1) newQuantity = 1;
      item.quantity = newQuantity;
      item.total = item.price * newQuantity;
      updateCartDisplay();
      updateCartCount();
    }

    function updateCartDisplay() {
      let cartBody = document.getElementById('cartModalBody');
      let totalAmount = cart.reduce((sum, item) => sum + item.total, 0);
      cartBody.innerHTML = `
        <h6>Cart Items:</h6>
        ${cart.map((item, index) => `
          <div class="cart-item">
            <img src="${item.image}" alt="${item.item}" class="cart-item-img">
            <div class="cart-item-details">
              <p><strong>Item:</strong> ${item.item}</p>
              <p><strong>Price per Unit:</strong> $${item.price.toFixed(2)}</p>
              <p><strong>Quantity:</strong> ${item.quantity}</p>
              <p><strong>Subtotal:</strong> $${item.total.toFixed(2)}</p>
              <p><strong>Added At:</strong> ${item.addedAt}</p>
              <p><strong>Description:</strong> ${item.description}</p>
              <div class="quantity-controls">
                <button class="quantity-btn" onclick="updateCartItemQuantity(event, ${index}, -1)">-</button>
                <span>${item.quantity}</span>
                <button class="quantity-btn" onclick="updateCartItemQuantity(event, ${index}, 1)">+</button>
              </div>
            </div>
          </div>
        `).join('')}
        <div class="cart-summary">
          Total Amount: $${totalAmount.toFixed(2)}
        </div>
      `;
    }

    function viewCart() {
      if (cart.length === 0) {
        alert('Cart is empty!');
      } else {
        updateCartDisplay();
        if (!cartModal) {
          cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
        }
        cartModal.show();
      }
    }

    function checkout() {
      alert(`Proceeding to checkout with total: $${cart.reduce((sum, item) => sum + item.total, 0).toFixed(2)}`);
      cart = [];
      updateCartCount();
      if (cartModal) cartModal.hide();
    }

    function searchItems() {
      let searchTerm = document.getElementById('searchInput').value.toLowerCase();
      let cards = document.querySelectorAll('.product');

      cards.forEach(card => {
        let itemName = card.querySelector('.card-title').textContent.toLowerCase();
        card.style.display = itemName.includes(searchTerm) ? 'block' : 'none';
      });
    }

    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('searchInput').addEventListener('input', searchItems);

      document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function () {
          document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
          this.classList.add('active');
          const filter = this.dataset.filter;
          document.querySelectorAll('.product').forEach(card => {
            const category = card.dataset.category.toLowerCase();
            card.style.display = (filter === 'all' || category === filter) ? 'block' : 'none';
          });
        });
      });
    });
  </script>
</body>
</html>