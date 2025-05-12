@extends('layouts.app')

@section('content')
<h2>Kelola Diskon</h2>


<form action="{{ isset($editData) ? route('Diskon.update', $editData->id) : route('Diskon.store') }}" method="POST">
    @csrf
    @if(isset($editData)) @method('PUT') @endif

    <div class="mb-3">
        <label>Nama Diskon</label>
        <input type="text" name="nama_diskon" class="form-control" value="{{ old('nama_diskon', $editData->nama_diskon ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Persentase (%)</label>
        <input type="number" name="persentase" class="form-control" value="{{ old('persentase', $editData->persentase ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Tanggal Berlaku</label>
        <input type="date" name="tanggal_berlaku" class="form-control" value="{{ old('tanggal_berlaku', $editData->tanggal_berlaku ?? '') }}" required>
    </div>

    <button class="btn btn-{{ isset($editData) ? 'warning' : 'primary' }}">{{ isset($editData) ? 'Update' : 'Tambah' }}</button>
    @if(isset($editData))
        <a href="{{ route('Diskon.index') }}" class="btn btn-secondary">Batal</a>
    @endif
</form>

<hr>

<table class="table mt-4">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Persentase</th>
            <th>Tanggal Berlaku</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($diskons as $diskon)
        <tr>
            <td>{{ $diskon->nama_diskon }}</td>
            <td>{{ $diskon->persentase }}%</td>
            <td>{{ $diskon->tanggal_berlaku }}</td>
            <td>
                <a href="{{ route('Diskon.index', ['edit' => $diskon->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('Diskon.destroy', $diskon->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
