<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Laundry - Almada Laundry</title>

  <!-- Google Fonts: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }

    .navbar {
      background-color: #006D77;
    }

    .navbar-brand,
    .nav-link,
    .btn-logout {
      color: #ffffff !important;
      font-weight: 500;
    }

    .nav-link:hover {
      color: #FFD166 !important;
    }

    .btn-logout {
      border: none;
      background-color: #EF476F;
      padding: 5px 12px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .btn-logout:hover {
      background-color: #d63a5a;
    }

    footer {
      background-color: #006D77;
      color: #fff;
      text-align: center;
      padding: 20px 0;
      margin-top: 100px;
    }

    footer a {
      color: #FFD166;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }

    .container {
      padding-top: 80px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('admin_dashboard') }}">Admin Laundry</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon" style="color: white;"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="{{ route('admin_dashboard') }}">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.laundryIndex') }}">Data Laundry</a></li>
        </ul>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-logout">Logout</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="container">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer>
    <div class="container">
      <p>&copy; 2025 Almada Laundry. All rights reserved.</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
