<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Kasir Dashboard</title>
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
      <h4 class="text-white mb-4">Kasir Panel</h4>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="{{ route('order.create') }}" class="nav-link">🛒 New Order</a></li>
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
          <span class="navbar-brand mb-0 h1">Welcome, Kasir</span>
        </div>
      </nav>

      <!-- Kasir Dashboard Overview -->
      <div class="content">
        <h2>Kasir Dashboard</h2>
        <div class="row mt-3">
          <div class="col-md-6">
            <div class="card shadow-sm p-3">
              <h5>Pending Orders</h5>
              <p class="fs-4">3 Orders</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card shadow-sm p-3">
              <h5>Today's Revenue</h5>
              <p class="fs-4">Rp 2.500.000</p>
            </div>
          </div>
        </div>

        <hr/>

        <!-- Kasir Action Buttons -->
        
            <table class="table table-striped table-bordered shadow-sm">
              <thead class="table-dark">
              <tr>
              <th>No</th>
              <th>Order ID</th>
              <th>Customer Name</th>
              <th>Items</th>
              <th>Total Price</th>
              <th>Status</th>
              <th>Actions</th>
              </tr>
              </thead>
              <tbody>
              @foreach($orders as $index => $order)
              <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $order->id }}</td>
              <td>{{ $order->customer_name }}</td>
              <td>
              <ul class="list-unstyled mb-0">
                @foreach($order->items as $item)
                <li>{{ $item->name }} ({{ $item->pivot->quantity }}x)</li>
                @endforeach
              </ul>
              </td>
              <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
              <td>
                @if($order->status == 'pending')
                <span class="badge bg-warning">Pending</span>
                @elseif($order->status == 'completed')
                <span class="badge bg-success">Completed</span>
                @else
                <span class="badge bg-danger">Cancelled</span>
                @endif
              </td>
              <td>
                @if($order->status == 'pending')
                <form action="{{ route('order.complete', $order->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button class="btn btn-sm btn-success">✔ Complete</button>
                </form>
                <form action="{{ route('order.cancel', $order->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button class="btn btn-sm btn-danger">✖ Cancel</button>
                </form>
                @else
                <button class="btn btn-sm btn-secondary" disabled>✔ Complete</button>
                <button class="btn btn-sm btn-secondary" disabled>✖ Cancel</button>
                @endif
              </td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
