@extends('layouts.app') {{-- Ganti dengan layout yang kamu pakai --}}

@section('content')
<div class="container">
  <h2>Edit Pesanan</h2>

  <form action="{{ route('order.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
      <input type="text" class="form-control" name="nama_pelanggan" value="{{ $order->nama_pelanggan }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Detail Menu</label>
      <ul>
        @foreach ($order->detailPesanan as $item)
          <li>{{ $item->menu->nama_menu }} - {{ $item->jumlah }} porsi (Rp {{ number_format($item->harga_satuan, 0, ',', '.') }})</li>
        @endforeach
      </ul>
      <p><i>* Tidak bisa mengubah detail menu di halaman ini</i></p>
    </div>

    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="">-- Pilih Status --</option>
        <option value="Diproses" {{ $order->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
        <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        <option value="Batal" {{ $order->status == 'Batal' ? 'selected' : '' }}>Batal</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="{{ route('staff_dapur') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection
