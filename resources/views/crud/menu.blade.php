@extends('layouts.app')

@section('content')
<h2>Kelola Menu</h2>

@include('partials.alert')

<form action="{{ isset($editData) ? route('menu.update', $editData->id) : route('menu.store') }}" method="POST">
    @csrf
    @if(isset($editData)) @method('PUT') @endif

    <div class="mb-3">
        <label>Kategori</label>
        <select name="category" class="form-control" required>
            @foreach(['Makanan', 'Minuman', 'Cemilan'] as $kategori)
                <option value="{{ $kategori }}" {{ (old('category', $editData->category ?? '') == $kategori) ? 'selected' : '' }}>{{ $kategori }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Nama Menu</label>
        <input type="text" name="nama_menu" class="form-control" value="{{ old('nama_menu', $editData->nama_menu ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" step="0.01" value="{{ old('harga', $editData->harga ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ old('stok', $editData->stok ?? '') }}" required>
    </div>

    <button class="btn btn-{{ isset($editData) ? 'warning' : 'primary' }}">{{ isset($editData) ? 'Update' : 'Tambah' }}</button>
    @if(isset($editData))
        <a href="{{ route('menu.index') }}" class="btn btn-secondary">Batal</a>
    @endif
</form>

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
                <a href="{{ route('menu.index', ['edit' => $menu->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
