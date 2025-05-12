<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      background-color: #f4f6f9;
    }
    .navbar-custom {
      background-color: #0d6efd;
    }
    .navbar-custom .navbar-brand,
    .navbar-custom .nav-link {
      color: white;
    }
    .content-wrapper {
      padding: 20px;
    }
    .sidebar {
      background-color: #343a40;
      min-height: 100vh;
      color: white;
    }
    .sidebar .nav-link {
      color: white;
    }
    .sidebar .nav-link:hover {
      background-color: #495057;
      border-radius: 5px;
    }
  </style>
  @stack('styles')
</head>
<body>

<div class="container-fluid">
  <div class="row">
    
    <!-- Sidebar -->
    <!-- <div class="col-md-2 sidebar p-3">
      <h5 class="text-white mb-4">Transaksi</h5>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="#" class="nav-link">🧾 Order Masuk</a></li>
        <li class="nav-item"><a href="#" class="nav-link">💳 Metode Pembayaran</a></li>
        <li class="nav-item"><a href="#" class="nav-link">🔖 Diskon</a></li>
        <li class="nav-item"><a href="#" class="nav-link">📦 Riwayat</a></li>
        <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">🔒 Logout</a></li>
      </ul>
    </div> -->

    <!-- Main Content -->
    <div class="col-md-10">
      <!-- Top Bar -->
      <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Kasir Panel</a>
        </div>
      </nav>

      <!-- Content -->
      <div class="content-wrapper">
        @yield('content')
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
