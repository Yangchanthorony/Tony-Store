@extends('layouts.header')
@extends('layouts.footer')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<!-- ================= Carousel ================= -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" style="height:70vh; overflow:hidden;">
  <div class="carousel-inner h-100">
    <div class="carousel-item active h-100">
      <img src="http://127.0.0.1:8000/storage/customers/HssA767WGmceLhs8NaGu6S9LbTmh4X1uZ2JFoF4p.jpg" class="d-block w-100 h-100 animate__animated animate__fadeIn" style="object-fit:cover; transform: scale(1.1); transition: transform 1.5s;">
    </div>
    <div class="carousel-item h-100">
      <img src="http://127.0.0.1:8000/storage/customers/B9exVP1eE2hTBjLqG59NY3ri7uX0i6nE8vTcuEIv.png" class="d-block w-100 h-100 animate__animated animate__fadeIn" style="object-fit:cover; transform: scale(1.1); transition: transform 1.5s;">
    </div>
    <div class="carousel-item h-100">
      <img src="http://127.0.0.1:8000/storage/customers/xnNdP5MpLHr2GMu3UAZ9Xb6lGhsnUVmugsNf9PAV.jpg" class="d-block w-100 h-100 animate__animated animate__fadeIn" style="object-fit:cover; transform: scale(1.1); transition: transform 1.5s;">
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bg-danger rounded-circle p-3"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon bg-danger rounded-circle p-3"></span>
  </button>
</div>
<!-- ================= Product Section ================= -->
<section class="container mt-5">
  <div class="text-center mb-4">
    <h2>Our Products</h2>
    <p>Discover our bestselling Mexd solutions</p>
  </div>

  <!-- Category Filters -->
  <div class="container mb-4">
    <div class="d-flex flex-wrap justify-content-center gap-2">
      <button class="btn btn-outline-primary active" onclick="filterProducts('all', event)">All</button>
      @foreach ($categories as $cat)
        <button class="btn btn-outline-primary" onclick="filterProducts('{{ $cat->category_name }}', event)">
          {{ $cat->category_name }}
        </button>
      @endforeach
    </div>
  </div>

  <!-- Product Grid -->
  <div class="row row-cols-1 row-cols-md-4 g-4 products-grid">
    @foreach ($products as $product)
      <div class="col product-card" data-category="{{ $product->category->category_name ?? 'Uncategorized' }}">
        <div class="card h-100 shadow-sm border-0">
          <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height:200px; object-fit:cover;">
          <div class="card-body text-center">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="text-secondary small mb-2">{{ Str::limit($product->description, 60) }}</p>
            <div class="fw-bold text-primary mb-2">${{ number_format($product->price, 2) }}</div>
            <button class="btn btn-primary w-100 mt-2"
              onclick="showModal('{{ $product->name }}', {{ $product->price }}, '{{ asset('storage/' . $product->image) }}')">
              Quick View
            </button>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>

<!-- ================= Order Modal ================= -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header"><h5>Order Confirmation</h5></div>
      <div class="modal-body text-center">
        <img id="modalItemImage" src="" class="img-fluid mb-2" style="max-width:100px;">
        <p id="modalItemName" class="fw-bold"></p>
        <div class="d-flex justify-content-center align-items-center mb-2">
          <button class="btn btn-outline-secondary btn-sm" onclick="updateQuantity(-1)">-</button>
          <span id="modalQuantity" class="mx-2">1</span>
          <button class="btn btn-outline-secondary btn-sm" onclick="updateQuantity(1)">+</button>
        </div>
        <p>Total: $<span id="modalTotalPrice"></span></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary btn-sm" onclick="addToCart()">Add to Cart</button>
      </div>
    </div>
  </div>
</div>

<!-- ================= Cart Modal ================= -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content shadow-lg border-0 rounded-4">
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title">🛒 Your Shopping Cart</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body d-flex flex-column gap-3">
        <div id="cartModalBody">
          <p class="text-center text-muted my-3">Your cart is empty.</p>
        </div>

        <div class="text-center">
          <h6 class="fw-semibold mb-2">💳 Scan QR Code to Pay</h6>
          <img src="http://127.0.0.1:8000/storage/customers/Id9NlOLxkII90rWMF7TxnqvleslhRXmKUsMbt3FF.jpg" class="img-fluid rounded shadow-sm" style="max-height:200px;">
        </div>

        <div class="border-top pt-3">
          <label for="uploadImage" class="form-label fw-semibold">Upload Payment Slip</label>
          <input type="file" id="uploadImage" class="form-control form-control-sm" accept="image/*">
          <img id="previewImage" src="" class="mt-3 d-none rounded shadow-sm w-100" style="max-height: 250px; object-fit: contain;">
        </div>

        <div class="border-top pt-3">
          <h6 class="fw-semibold mb-2">📝 Fill Your Details</h6>
          <input type="text" id="customerName" class="form-control mb-2" placeholder="Full Name" required>
          <input type="text" id="customerPhone" class="form-control mb-2" placeholder="Phone Number" required>
          <textarea id="customerAddress" class="form-control mb-2" rows="2" placeholder="Address" required></textarea>
        </div>
      </div>

      <div class="modal-footer d-block text-center border-top">
        <p id="cart-status-message" class="mb-2 small text-muted"></p>
        <div class="d-flex justify-content-between align-items-center">
          <button class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-success px-4" id="checkout-btn-modal" onclick="checkout()">Buy</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ================= Scripts ================= -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<script>
let cart = [];
let currentItem = { name: '', price: 0, image: '', quantity: 1 };
let uploadedFile = null;

// Format currency
const formatCurrency = n => `$${n.toFixed(2)}`;

function updateCartBadge() {
  const badge = document.getElementById('cartCount');
  if (!badge) return;
  const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
  badge.innerText = totalItems > 0 ? totalItems : '';
  badge.classList.toggle('d-none', totalItems === 0);
}

function showModal(name, price, image) {
  currentItem = { name, price, image, quantity: 1 };
  document.getElementById('modalItemName').innerText = name;
  document.getElementById('modalItemImage').src = image;
  document.getElementById('modalQuantity').innerText = 1;
  document.getElementById('modalTotalPrice').innerText = formatCurrency(price);
  new bootstrap.Modal('#orderModal').show();
}

function updateQuantity(change) {
  currentItem.quantity = Math.max(1, currentItem.quantity + change);
  document.getElementById('modalQuantity').innerText = currentItem.quantity;
  document.getElementById('modalTotalPrice').innerText = formatCurrency(currentItem.quantity * currentItem.price);
}

function addToCart() {
  const existing = cart.find(i => i.itemName === currentItem.name);
  if (existing) existing.quantity += currentItem.quantity;
  else cart.push({ itemName: currentItem.name, price: currentItem.price, image: currentItem.image, quantity: currentItem.quantity });

  bootstrap.Modal.getInstance(document.getElementById('orderModal')).hide();
  renderCart();
  updateCartBadge();
  document.getElementById('cart-status-message').innerHTML = `<span class="text-success">Added ${currentItem.quantity} × ${currentItem.name}!</span>`;
}

function renderCart() {
  const body = document.getElementById('cartModalBody');
  if (cart.length === 0) {
    body.innerHTML = '<p class="text-center text-muted my-3">Your cart is empty.</p>';
    document.getElementById('checkout-btn-modal').disabled = true;
    return;
  }

  let html = '<ul class="list-group">';
  let total = 0;
  cart.forEach(i => {
    const subtotal = i.price * i.quantity;
    total += subtotal;
    html += `
      <li class="list-group-item d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
          <img src="${i.image}" width="50" height="50" class="me-2 rounded" style="object-fit:cover;">
          <div>
            <div class="fw-semibold">${i.itemName}</div>
            <small class="text-muted">x${i.quantity} × ${formatCurrency(i.price)}</small>
          </div>
        </div>
        <span>${formatCurrency(subtotal)}</span>
      </li>`;
  });
  html += `</ul><p class="mt-2 text-end fw-bold text-danger">Total: ${formatCurrency(total)}</p>`;
  body.innerHTML = html;
  document.getElementById('checkout-btn-modal').disabled = !uploadedFile;
}

function viewCart() {
  new bootstrap.Modal('#cartModal').show();
  renderCart();
}

function filterProducts(category, event) {
  const cards = document.querySelectorAll('.product-card');
  const buttons = document.querySelectorAll('.btn-outline-primary');
  buttons.forEach(btn => btn.classList.remove('active'));
  event.target.classList.add('active');

  cards.forEach(card => {
    const productCategory = card.getAttribute('data-category');
    card.style.display = (category === 'all' || productCategory === category) ? 'block' : 'none';
  });
}

// Preview uploaded payment slip
document.getElementById('uploadImage').addEventListener('change', e => {
  const file = e.target.files[0];
  const preview = document.getElementById('previewImage');
  if (file) {
    uploadedFile = file;
    const reader = new FileReader();
    reader.onload = ev => {
      preview.src = ev.target.result;
      preview.classList.remove('d-none');
    };
    reader.readAsDataURL(file);
    document.getElementById('checkout-btn-modal').disabled = false;
  }
});

// Checkout function with required payment slip
async function checkout() {
  const btn = document.getElementById('checkout-btn-modal');
  const msg = document.getElementById('cart-status-message');

  const name = document.getElementById('customerName').value.trim();
  const phone = document.getElementById('customerPhone').value.trim();
  const address = document.getElementById('customerAddress').value.trim();

  if (!name || !phone || !address) {
    msg.innerHTML = '<span class="text-danger">Please fill in your name, phone number, and address!</span>';
    return;
  }

  if (cart.length === 0) {
    msg.innerHTML = '<span class="text-danger">Cart is empty!</span>';
    return;
  }

  if (!uploadedFile) {
    msg.innerHTML = '<span class="text-danger">Please upload a payment slip before checkout!</span>';
    return;
  }

  btn.disabled = true;
  btn.innerText = 'Sending...';
  msg.innerText = 'Uploading order...';

  const formData = new FormData();
  formData.append('cart', JSON.stringify(cart));
  formData.append('customerName', name);
  formData.append('customerPhone', phone);
  formData.append('customerAddress', address);
  formData.append('image', uploadedFile);

  const csrf = document.querySelector('meta[name="csrf-token"]').content;

  try {
    const res = await fetch("{{ route('send.telegram') }}", {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': csrf },
      body: formData
    });

    const result = await res.json();
    if (result.status === 'success') {
      msg.innerHTML = '<span class="text-success">✅ Order sent successfully!</span>';
      cart = [];
      renderCart();
      updateCartBadge();
      document.getElementById('customerName').value = '';
      document.getElementById('customerPhone').value = '';
      document.getElementById('customerAddress').value = '';
      document.getElementById('previewImage').classList.add('d-none');
      uploadedFile = null;
      btn.disabled = true;
    } else throw new Error(result.details);
  } catch (err) {
    msg.innerHTML = `<span class="text-danger">Error: ${err.message}</span>`;
  } finally {
    btn.innerText = 'Checkout';
    if (!uploadedFile) btn.disabled = true;
  }
}
</script>

<!-- ================= Styles ================= -->
<style>
.btn-outline-primary.active {
  background-color: #0d6efd;
  color: white;
  border-color: #0d6efd;
}
.product-card {
  transition: all 0.3s ease;
}
.product-card:hover {
  transform: translateY(-5px);
}
#cartModalBody ul.list-group {
  max-height: 300px;
  overflow-y: auto;
}
.modal-content {
  border-radius: 20px !important;
}
.modal-header {
  border-bottom: none;
}
.modal-footer {
  border-top: none;
}


.carousel-item img {
  animation: zoomAnimation 15s ease-in-out infinite;
}

@keyframes zoomAnimation {
  0% { transform: scale(1); }
  50% { transform: scale(1.1); }
  100% { transform: scale(1); }
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
  background-size: 100% 100%;
  transition: transform 0.3s;
}

.carousel-control-prev-icon:hover,
.carousel-control-next-icon:hover {
  transform: scale(1.2);
}

</style>
