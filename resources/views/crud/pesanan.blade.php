@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pesanan</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pemesan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->product_name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>
                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection