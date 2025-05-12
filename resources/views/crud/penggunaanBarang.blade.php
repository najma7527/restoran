@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Penggunaan Barang</h1>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add Button -->
    <div class="mb-3">
        <a href="{{ route('penggunaanBarang.create') }}" class="btn btn-primary">Tambah Data</a>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Penggunaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penggunaanBarang as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->tanggal_penggunaan }}</td>
                        <td>
                            <a href="{{ route('penggunaanBarang.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('penggunaanBarang.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Data tidak tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Back Button -->
    <div class="mt-3">
        <a href="{{ route('menu.index') }}" class="btn btn-secondary">Kembali ke Menu</a>
    </div>
</div>
@endsection