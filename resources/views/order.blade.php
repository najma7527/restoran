@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Kasir - Tambah Pesanan</h1>
    <form action="{{ route('pesanan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <hr>
        <h4>Detail Pesanan</h4>
        <div id="detail-pesanan">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="produk[]" class="form-label">Produk</label>
                    <input type="text" class="form-control" name="produk[]" required>
                </div>
                <div class="col-md-3">
                    <label for="jumlah[]" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah[]" required>
                </div>
                <div class="col-md-3">
                    <label for="harga[]" class="form-label">Harga</label>
                    <input type="number" class="form-control" name="harga[]" required>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary" id="tambah-detail">Tambah Detail</button>
        <hr>
        <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
    </form>
</div>

<script>
    document.getElementById('tambah-detail').addEventListener('click', function () {
        const detailPesanan = document.getElementById('detail-pesanan');
        const row = document.createElement('div');
        row.classList.add('row', 'mb-3');
        row.innerHTML = `
            <div class="col-md-6">
                <label for="produk[]" class="form-label">Produk</label>
                <input type="text" class="form-control" name="produk[]" required>
            </div>
            <div class="col-md-3">
                <label for="jumlah[]" class="form-label">Jumlah</label>
                <input type="number" class="form-control" name="jumlah[]" required>
            </div>
            <div class="col-md-3">
                <label for="harga[]" class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga[]" required>
            </div>
        `;
        detailPesanan.appendChild(row);
    });
</script>
@endsection