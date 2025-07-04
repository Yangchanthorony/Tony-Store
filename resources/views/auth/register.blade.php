<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow p-4">
          <h2 class="text-center mb-4">Register Form</h2>

          @if (Session::has('success'))
            <div class="alert alert-success" role="alert">      
              {{ Session::get('success') }}
            </div>
          @endif

          <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">Phone</label>
              <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" required>
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <textarea class="form-control" name="address" id="address" rows="2" placeholder="Enter your address" required></textarea>
            </div>

            <div class="mb-3">
              <label for="date_of_birth" class="form-label">Date of Birth</label>
              <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
            </div>

            <div class="mb-3">
              <label for="profile_image" class="form-label">Profile Image</label>
              <input type="file" class="form-control" name="profile_image" id="profile_image">
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
