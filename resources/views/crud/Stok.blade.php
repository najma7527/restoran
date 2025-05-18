@extends('layouts.app')

@section('content')
    <h2>Kelola Stok Barang</h2>

    {{-- Pesan sukses/error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Tambah --}}
    @if(!isset($editData))
        <form action="{{ route('stok.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_bahan" class="form-label">Nama Bahan</label>
                <input type="text" name="nama_bahan" class="form-control" value="{{ old('nama_bahan') }}" required>
            </div>
            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" name="satuan" class="form-control" value="{{ old('satuan') }}" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" step="0.01" name="jumlah" class="form-control" value="{{ old('jumlah') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    @endif

    {{-- Form Edit --}}
    @if(isset($editData))
        <form action="{{ route('stok.update', $editData) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_bahan" class="form-label">Nama Bahan</label>
                <input type="text" name="nama_bahan" class="form-control" value="{{ old('nama_bahan', $editData->nama_bahan) }}" required>
            </div>
            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" name="satuan" class="form-control" value="{{ old('satuan', $editData->satuan) }}" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" step="0.01" name="jumlah" class="form-control" value="{{ old('jumlah', $editData->jumlah) }}" required>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('stok.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    @endif

    <hr>

    {{-- Table --}}
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Nama Bahan</th>
                <th>Satuan</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $stok)
                <tr>
                    <td>{{ $stok->nama_bahan }}</td>
                    <td>{{ $stok->satuan }}</td>
                    <td>{{ $stok->jumlah }}</td>
                    <td>
                        <a href="{{ route('stok.edit', $stok) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('stok.destroy', $stok) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
