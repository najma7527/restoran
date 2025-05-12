@extends('layouts.app')

@section('content')
    <h2>Kelola Metode Pembayaran</h2>

    {{-- Tampilkan error atau success --}}
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
    <form action="{{ isset($editData) ? route('metode-pembayaran.update', $editData->id_metode) : route('metode-pembayaran.store') }}" method="POST">
        @csrf
        @if(isset($editData)) @method('PUT') @endif

        <input type="hidden" name="id_metode" value="{{ $editData->id_metode ?? '' }}">

        <div class="mb-3">
            <label for="nama_metode" class="form-label">Nama Metode</label>
            <input type="text" name="nama_metode" class="form-control" value="{{ $editData->nama_metode ?? old('nama_metode') }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $editData->deskripsi ?? old('deskripsi') }}</textarea>
        </div>

        <button type="submit" class="btn btn-{{ isset($editData) ? 'warning' : 'primary' }}">
            {{ isset($editData) ? 'Update' : 'Tambah' }}
        </button>

        @if(isset($editData))
            <a href="{{ route('metode-pembayaran.index') }}" class="btn btn-secondary">Batal</a>
        @endif
    </form>

    <hr>

    {{-- Tabel List Metode Pembayaran --}}
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Nama Metode</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($metodePembayaran as $item)
                <tr>
                    <td>{{ $item->nama_metode }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>
                        <a href="{{ route('metode-pembayaran.index', ['edit' => $item->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('metode-pembayaran.destroy', $item->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
