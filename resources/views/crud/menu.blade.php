@extends('layouts.app')

@section('content')
<h2>Kelola Menu</h2>



{{-- Form Tambah --}}
@if(!isset($editData))
    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select name="category" class="form-control" required>
                @foreach(['Makanan', 'Minuman', 'Cemilan'] as $kategori)
                    <option value="{{ $kategori }}" {{ old('category') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nama_menu" class="form-label">Nama Menu</label>
            <input type="text" name="nama_menu" class="form-control" value="{{ old('nama_menu') }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" step="0.01" name="harga" class="form-control" value="{{ old('harga') }}" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
@endif

{{-- Form Edit --}}
@if(isset($editData))
    <form action="{{ route('menus.update', $editData) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select name="category" class="form-control" required>
                @foreach(['Makanan', 'Minuman', 'Cemilan'] as $kategori)
                    <option value="{{ $kategori }}" {{ old('category', $editData->category) == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nama_menu" class="form-label">Nama Menu</label>
            <input type="text" name="nama_menu" class="form-control" value="{{ old('nama_menu', $editData->nama_menu) }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" step="0.01" name="harga" class="form-control" value="{{ old('harga', $editData->harga) }}" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ old('stok', $editData->stok) }}" required>
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('menus.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endif


<hr>

<table class="table mt-4">
    <thead>
        <tr>
            <th>Kategori</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($menus as $menu)
        <tr>
            <td>{{ $menu->category }}</td>
            <td>{{ $menu->nama_menu }}</td>
            <td>Rp {{ number_format($menu->harga, 2, ',', '.') }}</td>
            <td>{{ $menu->stok }}</td>
            <td>
                <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
