<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sensok Store Menu</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body { background-color: #f4f6f8; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; padding-top: 80px; }
    .navbar { background-color: #fff; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); border-bottom: 1px solid #eee; }
    .navbar-brand span { font-size: 1.4rem; font-weight: 700; color: #007bff; }
    .filter-btn { padding: 8px 16px; border: 1px solid #ddd; border-radius: 25px; background: #fff; transition: 0.3s; }
    .filter-btn.active, .filter-btn:hover { background: #007bff; color: #fff; }
    .products-grid .card { border: none; border-radius: 16px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.07); transition: 0.3s; }
    .products-grid .card:hover { transform: translateY(-5px); }
    .card-img-top { object-fit: cover; height: 230px; }
    .product-price { color: #28a745; font-weight: 700; }
    .modal-content { border-radius: 12px; }
    .success { color: green; font-weight: 600; }
    .error { color: red; font-weight: 600; }
  </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="https://i.pinimg.com/736x/97/07/63/970763e41f802a141dc545dddbe19ec1.jpg" width="50" height="50" class="rounded me-2">
      <span>Tony Store</span>
    </a>
    <div class="ms-auto">
      <button class="btn btn-success position-relative" onclick="viewCart()">
        🛒 Cart <span id="cartCount" class="badge bg-danger d-none">0</span>
      </button>
    </div>
  </div>
</nav>