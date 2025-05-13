@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Buat Transaksi Baru</h2>

    <form action="{{ url('/kasir') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Menu</label>
            <div id="menu-container">
                <div class="row mb-2 menu-row">
                    <div class="col-md-6">
                        <select name="menu_id[]" class="form-select" required>
                            <option value="">-- Pilih Menu --</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->nama_menu }} - Rp{{ number_format($menu->harga, 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah" min="1" required>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-danger remove-menu">Hapus</button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" id="add-menu">+ Tambah Menu</button>
        </div>

        <div class="mb-3">
            <label for="id_diskon" class="form-label">Diskon</label>
            <select name="id_diskon" class="form-select">
                <option value="">-- Tanpa Diskon --</option>
                @foreach($diskons as $diskon)
                    <option value="{{ $diskon->id }}">{{ $diskon->nama_diskon }} - {{ $diskon->persentase }}%</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_metode" class="form-label">Metode Pembayaran</label>
            <select name="id_metode" class="form-select" required>
                <option value="">-- Pilih Metode Pembayaran --</option>
                @foreach($metodes as $metode)
                    <option value="{{ $metode->id }}">{{ $metode->nama_metode }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pembayaran" class="form-label">Nominal Pembayaran</label>
            <input type="number" class="form-control" name="pembayaran" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan Transaksi</button>
        <a href="{{ url('/kasir') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
document.getElementById('add-menu').addEventListener('click', function () {
    const container = document.getElementById('menu-container');
    const row = document.querySelector('.menu-row').cloneNode(true);
    row.querySelectorAll('input, select').forEach(el => el.value = '');
    container.appendChild(row);
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-menu')) {
        const row = e.target.closest('.menu-row');
        if (document.querySelectorAll('.menu-row').length > 1) {
            row.remove();
        }
    }
});
</script>
@endsection
