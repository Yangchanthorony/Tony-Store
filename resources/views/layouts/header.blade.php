<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sensok Store Menu</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Global Font and Background */
    body {
      background-color: #f4f6f8;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #333;
      padding-top: 80px; /* or adjust as needed */
    }

    /* Navbar */
    .navbar {
      background-color: #ffffff;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
      border-bottom: 1px solid #eee;
    }

    .navbar-brand span {
      font-size: 1.4rem;
      font-weight: 700;
      color: #007bff;
    }

    .navbar .form-control {
      border-radius: 20px;
      padding: 8px 15px;
      border: 1px solid #ddd;
      box-shadow: none;
    }

    .navbar .btn-outline-primary {
      border-radius: 20px;
      padding: 6px 15px;
    }

    /* Slider Styles */
    .carousel {
      margin: 20px 0;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .carousel-item img {
      object-fit: cover;
      height: 400px;
      width: 100%;
    }

    .carousel-caption {
      background: rgba(0, 0, 0, 0.5);
      border-radius: 10px;
      padding: 10px 20px;
    }

    .carousel-caption h5 {
      font-size: 1.5rem;
      font-weight: 600;
    }

    .carousel-caption p {
      font-size: 1rem;
    }

    /* Tabs (Filter Buttons) */
    .filter-tabs {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 12px;
      margin-bottom: 25px;
    }

    .filter-btn {
      padding: 10px 20px;
      background-color: #ffffff;
      border: 2px solid #ddd;
      border-radius: 30px;
      font-weight: 500;
      transition: all 0.3s ease;
      color: #555;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    }

    .filter-btn:hover,
    .filter-btn.active {
      background-color: #007bff;
      color: #fff;
      border-color: #007bff;
    }

    /* Section Header */
    .section-header h2 {
      font-size: 2.2rem;
      font-weight: 700;
      margin-bottom: 0.4rem;
      color: #222;
    }

    .section-header p {
      color: #666;
      font-size: 1rem;
      margin-bottom: 1rem;
    }

    /* Product Cards */
    .products-grid .card {
      border: none;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.07);
      transition: all 0.3s ease;
    }

    .products-grid .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
      object-fit: cover;
      height: 230px;
    }

    .card-body {
      padding: 1rem;
    }

    .card-title {
      font-size: 1.1rem;
      font-weight: 600;
      color: #333;
    }

    .product-category {
      font-size: 0.9rem;
      color: #888;
      margin-bottom: 10px;
    }

    /* Stars */
    .product-rating {
      margin-bottom: 10px;
    }

    .product-rating .star {
      color: #ddd;
      font-size: 1rem;
    }

    .product-rating .star.filled {
      color: #ffc107;
    }

    .rating-count {
      font-size: 0.85rem;
      color: #666;
      margin-left: 5px;
    }

    /* Price & Button */
    .product-price {
      font-size: 1.2rem;
      font-weight: 700;
      color: #28a745;
      margin-bottom: 12px;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
      border-radius: 25px;
      padding: 10px 15px;
      font-weight: 500;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    /* Cart badge */
    #cartCount {
      font-size: 0.75rem;
      padding: 4px 6px;
      min-width: 20px;
      height: 20px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    /* Modals */
    .modal-content {
      border-radius: 15px;
      box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
      background-color: #f8f9fa;
      border-bottom: 1px solid #ddd;
    }

    .modal-title {
      font-size: 1.1rem;
      font-weight: 600;
    }

    /* Quantity Buttons */
    .quantity-controls {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
      margin: 10px 0;
    }

    .quantity-btn {
      padding: 5px 12px;
      font-size: 0.9rem;
      background-color: #f1f1f1;
      border: 1px solid #ccc;
      border-radius: 6px;
      transition: background-color 0.2s;
    }

    .quantity-btn:hover {
      background-color: #e1e1e1;
    }

    /* Cart Items */
    .cart-item {
      background-color: #fff;
      border-radius: 10px;
      padding: 10px;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .cart-item-img {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 8px;
    }

    .cart-item-details {
      flex-grow: 1;
      padding-left: 10px;
    }

    .cart-item-details p {
      font-size: 0.85rem;
      margin-bottom: 3px;
    }

    .cart-summary {
      border-top: 1px solid #ddd;
      padding-top: 10px;
      font-size: 0.95rem;
      text-align: right;
      font-weight: 600;
    }

    /* Responsive Tweaks */
    @media (max-width: 767px) {
      .card-img-top {
        height: 160px;
      }

      .carousel-item img {
        height: 250px;
      }

      .carousel-caption h5 {
        font-size: 1.2rem;
      }

      .carousel-caption p {
        font-size: 0.9rem;
      }

      .filter-btn {
        padding: 8px 12px;
        font-size: 0.9rem;
      }

      .navbar .form-control {
        width: 150px;
      }

      .btn-primary {
        font-size: 0.9rem;
        padding: 8px 12px;
      }
    }
  </style>
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light p-2 shadow-sm fixed-top">
    <div class="container-fluid">
      <!-- Brand and Logo -->
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="https://i.pinimg.com/736x/97/07/63/970763e41f802a141dc545dddbe19ec1.jpg" alt="Sensok Store Logo" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
        <span class="ms-2 fw-bold d-none d-md-block">Sensok Store</span>
      </a>
      
      <!-- Toggler for Mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar Content -->
      <div class="collapse navbar-collapse" id="navbarContent">
        <div class="ms-auto d-flex flex-wrap align-items-center">
          <!-- Search Bar -->
          <form class="d-flex my-2 my-lg-0 flex-grow-1" role="search">
            <input type="text" class="form-control me-2" id="searchInput" placeholder="Search products..." aria-label="Search">
            <button class="btn btn-outline-primary me-2" type="button" onclick="searchItems()">Search</button>
          </form>
          <!-- Cart Button with Badge -->
          <button class="btn btn-success position-relative" onclick="viewCart()">
            <span class="d-inline-flex align-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart me-1" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </svg>
              Cart
            </span>
            <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">0</span>
          </button>
        </div>
      </div>
    </div>
  </nav>