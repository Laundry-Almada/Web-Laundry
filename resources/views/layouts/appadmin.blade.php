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
      background-color: #eaf3fa;
      margin: 0;
      padding: 0;
    }
    .main-wrapper {
      display: flex;
      min-height: 100vh;
    }
    .sidebar {
      width: 260px;
      background: #0a3d62;
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      padding: 0;
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      z-index: 200;
    }
    .sidebar .logo {
      width: 180px;
      margin: 32px 0 16px 32px;
      align-self: flex-start;
    }
    .sidebar .sidebar-menu {
      width: 100%;
      margin-top: 32px;
      flex: 1;
    }
    .sidebar .sidebar-menu a {
      display: flex;
      align-items: center;
      padding: 16px 32px;
      color: #fff;
      text-decoration: none;
      font-size: 18px;
      border-radius: 30px 0 0 30px;
      margin-bottom: 8px;
      transition: background 0.2s;
    }
    .sidebar .sidebar-menu a.active, .sidebar .sidebar-menu a:hover {
      background: #1e5a99;
      color: #fff;
    }
    .sidebar .sidebar-menu i {
      margin-right: 16px;
      font-size: 22px;
    }
    .sidebar .sidebar-footer {
      margin-bottom: 32px;
      font-size: 14px;
      color: #b0c4de;
      text-align: center;
      width: 100%;
    }
    .sidebar .logout-btn {
      width: 100%;
      display: flex;
      justify-content: flex-start;
      padding: 0 32px 16px 32px;
    }
    .sidebar .logout-btn form {
      width: 100%;
    }
    .sidebar .logout-btn button {
      width: 100%;
      background: #ef476f;
      color: #fff;
      border: none;
      border-radius: 20px;
      padding: 8px 0;
      font-weight: bold;
      font-size: 16px;
      margin-top: 8px;
      transition: background 0.2s;
    }
    .sidebar .logout-btn button:hover {
      background: #d63a5a;
    }
    .header {
      width: calc(100% - 260px);
      background: #0a3d62;
      color: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 32px;
      position: fixed;
      top: 0;
      left: 260px;
      z-index: 100;
      height: 60px;
    }
    .header .contact-info {
      display: flex;
      gap: 32px;
      font-size: 15px;
      align-items: center;
    }
    .header .header-actions {
      display: flex;
      gap: 12px;
    }
    .header .btn-login, .header .btn-register {
      background: #fff;
      color: #0a3d62;
      border: none;
      border-radius: 20px;
      padding: 4px 18px;
      font-weight: bold;
      font-size: 15px;
      margin-left: 8px;
      transition: background 0.2s, color 0.2s;
    }
    .header .btn-login:hover, .header .btn-register:hover {
      background: #1e5a99;
      color: #fff;
    }
    .content-area {
      flex: 1;
      margin-left: 260px;
      margin-top: 60px;
      padding: 32px 32px 32px 32px;
      background: #eaf3fa;
      min-height: calc(100vh - 60px);
    }
    .alert {
      margin-top: 20px;
      margin-bottom: 20px;
    }
    footer {
      background: #0a3d62;
      color: #fff;
      text-align: center;
      padding: 20px 0;
      margin-top: 0;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body>
  <div class="main-wrapper">
    <aside class="sidebar">
      <img src="/logo-laundry.png" alt="Logo Almada Laundry" class="logo">
      <div class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
        <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}"><i class="fas fa-list"></i> Order</a>
      </div>
      <div class="logout-btn">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
      </div>
      <div class="sidebar-footer">
        <div>HIBAH MBKM UNS</div>
      </div>
    </aside>
    <div style="width:100%">
      <header class="header">
        <div class="contact-info">
          <span><i class="fas fa-phone"></i> Phone: +62 812345678</span>
          <span><i class="fas fa-envelope"></i> Email: almadalaundry@gmail.com</span>
        </div>
        <div class="header-actions">
          <a href="{{ route('login') }}" class="btn btn-login">LOGIN</a>
          <a href="{{ route('register') }}" class="btn btn-register">REGISTER</a>
        </div>
      </header>
      <main class="content-area">
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @yield('content')
      </main>
      <footer>
        <div class="container">
          <p>&copy; 2025 Almada Laundry. All rights reserved.</p>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
