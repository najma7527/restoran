@extends('layouts.app')

@section('content')
    <h2>Kelola Penggunaan Bahan</h2>

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
    <form action="{{ isset($editData) ? route('penggunaan.update', $editData->id) : route('penggunaan.store') }}" method="POST">
        @csrf
        @if(isset($editData)) @method('PUT') @endif

        <div class="mb-3">
            <label for="id_menu" class="form-label">Menu</label>
            <select name="id_menu" class="form-control" required>
                <option value="">-- Pilih Menu --</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}" {{ (isset($editData) && $editData->id_menu == $menu->id) ? 'selected' : '' }}>
                        {{ $menu->nama_menu }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_bahan" class="form-label">Bahan</label>
            <select name="id_bahan" class="form-control" required>
                <option value="">-- Pilih Bahan --</option>
                @foreach($bahans as $bahan)
                    <option value="{{ $bahan->id }}" {{ (isset($editData) && $editData->id_bahan == $bahan->id) ? 'selected' : '' }}>
                        {{ $bahan->nama_bahan }} ({{ $bahan->satuan }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah_digunakan" class="form-label">Jumlah Digunakan</label>
            <input type="number" step="0.01" name="jumlah_digunakan" class="form-control" value="{{ $editData->jumlah_digunakan ?? old('jumlah_digunakan') }}" required>
        </div>

        <button type="submit" class="btn btn-{{ isset($editData) ? 'warning' : 'primary' }}">
            {{ isset($editData) ? 'Update' : 'Tambah' }}
        </button>

        @if(isset($editData))
            <a href="{{ route('penggunaan.index') }}" class="btn btn-secondary">Batal</a>
        @endif
    </form>

    <hr>

    {{-- Tabel List Penggunaan Bahan --}}
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Menu</th>
                <th>Bahan</th>
                <th>Jumlah Digunakan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->menu->nama_menu ?? '-' }}</td>
                    <td>{{ $item->bahan->nama_bahan ?? '-' }} ({{ $item->bahan->satuan ?? '' }})</td>
                    <td>{{ $item->jumlah_digunakan }}</td>
                    <td>
                        <a href="{{ route('penggunaan.index', ['edit' => $item->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('penggunaan.destroy', $item->id) }}" method="POST" style="display:inline">
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
