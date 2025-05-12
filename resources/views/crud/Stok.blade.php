@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Stok Barang</h1>
    <a href="{{ route('stok.create') }}" class="btn btn-primary mb-3">Tambah Stok</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stoks as $stok)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $stok->nama_barang }}</td>
                <td>{{ $stok->jumlah }}</td>
                <td>{{ $stok->harga }}</td>
                <td>
                    <a href="{{ route('stok.edit', $stok->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('stok.destroy', $stok->id) }}" method="POST" style="display:inline;">
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