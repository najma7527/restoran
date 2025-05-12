<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body { min-height: 100vh; background-color: #f8f9fa; }
    .sidebar { min-height: 100vh; background-color: #343a40; color: white; }
    .sidebar .nav-link { color: white; }
    .sidebar .nav-link:hover { background-color: #495057; border-radius: 5px; }
    .card { border: none; border-radius: 1rem; }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row flex-nowrap">

    <!-- Sidebar -->
    <div class="col-auto sidebar p-3">
      <h4 class="text-white mb-4">Admin Panel</h4>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="{{ route('admin') }}" class="nav-link">📊 Dashboard</a></li>
        <li class="nav-item"><a href="{{ route('menu.index') }}" class="nav-link">🍽️ Manage Menu</a></li>
        <li class="nav-item"><a href="{{ route('metode-pembayaran.index') }}" class="nav-link">💳 Metode Pembayaran</a></li>
        <li class="nav-item"><a href="{{ route('diskon.index') }}" class="nav-link">🔖 Diskon</a></li>
        <li class="nav-item"><a href="#" class="nav-link">📑 Manage Orders</a></li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link btn btn-link" style="padding: 0; border: none; background: none;">
              🔒 Logout
            </button>
          </form>
        </li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="col p-4">
      <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
        <div class="container-fluid">
          <span class="navbar-brand mb-0 h1">Welcome, Admin</span>
        </div>
      </nav>

      <!-- Dashboard Overview -->
      <div class="content">
        <h2>Dashboard Overview</h2>
        <div class="row mt-4">
          <div class="col-md-4">
            <div class="card shadow-sm p-3">
              <h5>Total Orders</h5>
              <p class="fs-4">124</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card shadow-sm p-3">
              <h5>Total Revenue</h5>
              <p class="fs-4">Rp 12.540.000</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card shadow-sm p-3">
              <h5>Active Users</h5>
              <p class="fs-4">5</p>
            </div>
          </div>
        </div>

        <hr>
        <!-- Tambahan konten jika diperlukan -->

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
