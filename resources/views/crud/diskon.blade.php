@extends('layouts.app')

@section('content')
    <h2>Kelola Diskon</h2>

    {{-- Tampilkan pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tampilkan pesan error validasi --}}
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
    <form action="{{ route('Diskon.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_diskon" class="form-label">Nama Diskon</label>
            <input type="text" name="nama_diskon" class="form-control" value="{{ old('nama_diskon') }}" required>
        </div>

        <div class="mb-3">
            <label for="persentase" class="form-label">Persentase (%)</label>
            <input type="number" name="persentase" class="form-control" value="{{ old('persentase') }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_berlaku" class="form-label">Tanggal Berlaku</label>
            <input type="date" name="tanggal_berlaku" class="form-control" value="{{ old('tanggal_berlaku') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
@endif

{{-- Form Edit --}}
@if(isset($editData))
    <form action="{{ route('Diskon.update', $editData->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_diskon" class="form-label">Nama Diskon</label>
            <input type="text" name="nama_diskon" class="form-control" value="{{ old('nama_diskon', $editData->nama_diskon) }}" required>
        </div>

        <div class="mb-3">
            <label for="persentase" class="form-label">Persentase (%)</label>
            <input type="number" name="persentase" class="form-control" value="{{ old('persentase', $editData->persentase) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_berlaku" class="form-label">Tanggal Berlaku</label>
            <input type="date" name="tanggal_berlaku" class="form-control" value="{{ old('tanggal_berlaku', $editData->tanggal_berlaku) }}" required>
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('Diskon.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endif


    <hr>

    {{-- Tabel Diskon --}}
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Nama Diskon</th>
                <th>Persentase</th>
                <th>Tanggal Berlaku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($diskons as $item)
                <tr>
                    <td>{{ $item->nama_diskon }}</td>
                    <td>{{ $item->persentase }}%</td>
                    <td>{{ $item->tanggal_berlaku }}</td>
                    <td>
                        <a href="{{ route('Diskon.edit', ['Diskon' => $item->id]) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('Diskon.destroy', ['Diskon' => $item->id]) }}" method="POST" style="display:inline">
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
