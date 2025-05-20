@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Buat Transaksi Baru</h2>

    <form action="{{ route('order.store') }}" method="POST" id="form-transaksi">
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
                        <select name="menu_id[]" class="form-select menu-select" required>
                            <option value="">-- Pilih Menu --</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}" data-harga="{{ $menu->harga }}">
                                    {{ $menu->nama_menu }} - Rp{{ number_format($menu->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="jumlah[]" class="form-control jumlah-input" placeholder="Jumlah" min="1" required>
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
            <select name="id_diskon" id="id_diskon" class="form-select">
                <option value="" data-persentase="0">-- Tanpa Diskon --</option>
                @foreach($diskons as $diskon)
                    <option value="{{ $diskon->id }}" data-persentase="{{ $diskon->persentase }}">
                        {{ $diskon->nama_diskon }} - {{ $diskon->persentase }}%
                    </option>
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
            <label class="form-label">Total Belanja</label>
            <input type="text" id="total-belanja" class="form-control" readonly>
            <input type="hidden" name="total_harga" id="total_harga">
        </div>

        <div class="mb-3">
            <label for="pembayaran" class="form-label">Nominal Pembayaran</label>
            <input type="number" class="form-control" name="pembayaran" id="pembayaran" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kembalian</label>
            <input type="text" id="kembalian" class="form-control" readonly>
            <input type="hidden" name="kembalian_hidden" id="kembalian_hidden">
        </div>

        <button type="submit" class="btn btn-success">Simpan Transaksi</button>
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
            hitungTotal();
        }
    }
});

document.addEventListener('input', function () {
    hitungTotal();
});

document.getElementById('id_diskon').addEventListener('change', hitungTotal);
document.getElementById('pembayaran').addEventListener('input', hitungKembalian);

function hitungTotal() {
    let total = 0;
    document.querySelectorAll('.menu-row').forEach(row => {
        const harga = parseInt(row.querySelector('.menu-select')?.selectedOptions[0]?.dataset?.harga || 0);
        const jumlah = parseInt(row.querySelector('.jumlah-input')?.value || 0);
        total += harga * jumlah;
    });

    const diskonOption = document.getElementById('id_diskon').selectedOptions[0];
    const persentase = parseInt(diskonOption.dataset.persentase || 0);
    const diskon = total * (persentase / 100);
    const totalAkhir = total - diskon;

    document.getElementById('total-belanja').value = 'Rp' + totalAkhir.toLocaleString('id-ID');
    document.getElementById('total_harga').value = totalAkhir;
    hitungKembalian();
}

function hitungKembalian() {
    const total = parseInt(document.getElementById('total_harga').value || 0);
    const bayar = parseInt(document.getElementById('pembayaran').value || 0);
    const kembali = bayar - total;
    document.getElementById('kembalian').value = 'Rp' + (kembali >= 0 ? kembali.toLocaleString('id-ID') : '0');
    document.getElementById('kembalian_hidden').value = kembali >= 0 ? kembali : 0;
}
</script>
@endsection
