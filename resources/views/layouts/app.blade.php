<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 56px; /* adjust for navbar */
            width: 250px;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My Dasboard</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('profile')}}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="ms-2">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column px-3">
            <li class="nav-item my-2">
                  @if(Auth::user()->profile_image)
            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" 
                 alt="Profile" class="rounded-circle" width="100" height="100">
        @else
            <span class="rounded-circle bg-secondary d-inline-block text-center text-white" 
                  style="width:60px; height:60px; line-height:60px;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </span>
        @endif
    </li>
    <li class="nav-item me-3 text-black">
        <h3>{{ Auth::user()->name }}</h3>
    </li>
            <li class="nav-item my-2">
                <a class="nav-link  " href="{{ route('home') }}">
                     Dashboard
                </a>
            </li>

              <li class="nav-item my-2">
                <a class="nav-link " href="{{ route('categories.index') }}">
                     Categories
                </a>
            </li>

            <li class="nav-item my-2">
                <a class="nav-link }" href="{{ route('products.index') }}">
                     Products
                </a>
            </li>
            <li class="nav-item my-2">
                <a class="nav-link " href="{{ route('employees.index') }}">
                     Manager
                </a>
            </li>
            <li class="nav-item my-2">
                <a class="nav-link " href="{{ route('staff.index') }}">
                     Staff
                </a>
            </li>

            <li class="nav-item my-2">
                <a class="nav-link " href="{{ route('customers.index') }}">
                     Customers
                </a>
            </li>
            
          
            <li class="nav-item mt-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-outline-danger w-100">Logout</button>
                </form>
            </li>

            
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

</body>
</html>
