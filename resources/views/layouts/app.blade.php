<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"/>
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Arial', sans-serif;
    }
    .navbar-custom {
      background-color: #007bff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .navbar-custom .navbar-brand,
    .navbar-custom .nav-link {
      color: white;
      font-weight: bold;
    }
    .navbar-custom .nav-link:hover {
      color: #ffc107;
    }
    .content-wrapper {
      padding: 30px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .footer {
      text-align: center;
      padding: 10px;
      background-color: #007bff;
      color: white;
      margin-top: 20px;
      border-radius: 5px;
    }
  </style>
  @stack('styles')
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Main Content -->
    <div class="col-md-12">
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

      <!-- Footer -->
      <div class="footer">
        &copy; 2023 Kasir Panel. All Rights Reserved.
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
@stack('scripts')
</body>
</html>
