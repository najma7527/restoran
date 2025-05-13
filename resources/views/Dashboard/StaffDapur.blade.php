<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Staff Dapur Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      min-height: 100vh;
      background-color: #f8f9fa;
    }
    .sidebar {
      min-height: 100vh;
      background-color: #343a40;
      color: white;
    }
    .sidebar .nav-link {
      color: white;
    }
    .sidebar .nav-link:hover {
      background-color: #495057;
      border-radius: 5px;
    }
    .card {
      border: none;
      border-radius: 1rem;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row flex-nowrap">

    <!-- Sidebar -->
    <div class="col-auto sidebar p-3">
      <h4 class="text-white mb-4">Dapur Panel</h4>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="{{ route('stok.index') }}" class="nav-link">📦 Stok Bahan</a></li>
        <li class="nav-item"><a href="{{ route('menus.index') }}" class="nav-link">🍽️ Menu</a></li>
        <li class="nav-item"><a href="{{ route('penggunaan.index') }}" class="nav-link">🧾 Penggunaan Bahan</a></li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST" style="display: inline;">
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
      <!-- Header -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
        <div class="container-fluid">
          <span class="navbar-brand mb-0 h1">Welcome, Staff Dapur</span>
        </div>
      </nav>

      <!-- Dashboard Overview -->
      <div class="content">
        <h2>Dashboard Dapur</h2>
        <div class="row mt-3">
          <div class="col-md-6">
            <div class="card shadow-sm p-3">
              <h5>Total Menu</h5>
              <p class="fs-4">12 Item</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card shadow-sm p-3">
              <h5>Stok Bahan</h5>
              <p class="fs-4">8 Jenis Bahan</p>
            </div>
          </div>
        </div>

        <hr/>
        <h4>Pesanan Terbaru</h4>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pelanggan</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $order->customer_name }}</td>
                  <td>{{ $order->created_at->format('d-m-Y') }}</td>
                  <td>{{ $order->status }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
          

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
