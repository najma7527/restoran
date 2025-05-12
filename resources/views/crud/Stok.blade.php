@extends('layouts.app')

@section('content')
    <h2>Kelola Stok Barang</h2>

    {{-- Tampilkan pesan sukses atau error --}}
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

    {{-- Form Tambah / Edit --}}
    <form action="{{ isset($editData) ? route('stok.update', $editData->id) : route('stok.store') }}" method="POST">
        @csrf
        @if(isset($editData)) @method('PUT') @endif

        <div class="mb-3">
            <label for="nama_bahan" class="form-label">Nama Bahan</label>
            <input type="text" name="nama_bahan" class="form-control" value="{{ $editData->nama_bahan ?? old('nama_bahan') }}" required>
        </div>

        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <input type="text" name="satuan" class="form-control" value="{{ $editData->satuan ?? old('satuan') }}" required>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" step="0.01" name="jumlah" class="form-control" value="{{ $editData->jumlah ?? old('jumlah') }}" required>
        </div>

        <button type="submit" class="btn btn-{{ isset($editData) ? 'warning' : 'primary' }}">
            {{ isset($editData) ? 'Update' : 'Tambah' }}
        </button>

        @if(isset($editData))
            <a href="{{ route('stok.index') }}" class="btn btn-secondary">Batal</a>
        @endif
    </form>

    <hr>

    {{-- Tabel List Stok --}}
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
                        <a href="{{ route('stok.index', ['edit' => $stok->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('stok.destroy', $stok->id) }}" method="POST" style="display:inline;">
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
