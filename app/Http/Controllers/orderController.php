<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Diskon;
use App\Models\Menu;
use App\Models\MetodePembayaran;

class orderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanan = Pesanan::all();
        return view('crud.pesanan', compact('pesanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     return view('order', [
        'menus' => Menu::all(),
        'diskons' => Diskon::all(),
        'metodes' => MetodePembayaran::all()
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'nama_pelanggan' => 'required|string|max:100',
        'menu_id' => 'required|array',
        'jumlah' => 'required|array',
        'id_metode' => 'required|exists:metode_pembayarans,id',
        'pembayaran' => 'required|numeric|min:0',
    ]);

    $total = 0;
    foreach ($request->menu_id as $i => $menu_id) {
        $menu = Menu::find($menu_id);
        $jumlah = $request->jumlah[$i];
        $subtotal = $menu->harga * $jumlah;
        $total += $subtotal;
    }

    if ($request->id_diskon) {
        $diskon = Diskon::find($request->id_diskon);
        $total -= ($total * $diskon->persentase / 100);
    }

    $kembalian = $request->pembayaran - $total;

    $pesanan = Pesanan::create([
        'nama_pelanggan' => $request->nama_pelanggan,
        'total_harga' => $total,
        'pembayaran' => $request->pembayaran,
        'kembalian' => $kembalian,
        'id_metode' => $request->id_metode,
        'id_diskon' => $request->id_diskon,
        'tanggal' => now()
    ]);

    foreach ($request->menu_id as $i => $menu_id) {
        $menu = Menu::find($menu_id);
        $jumlah = $request->jumlah[$i];
        $harga = $menu->harga;
        $subtotal = $harga * $jumlah;

        DetailPesanan::create([
            'id_pesanan' => $pesanan->id,
            'id_menu' => $menu_id,
            'jumlah' => $jumlah,
            'harga_satuan' => $harga,
            'subtotal' => $subtotal
        ]);
    }
    return redirect()->route('order.create')->with('success', 'Transaksi berhasil disimpan!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pesanan = Pesanan::with('detailPesanan')->findOrFail($id);
        return view('crud.pesanan', compact('pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('crud.pesanan', compact('pesanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'tanggal_pesanan' => 'required|date',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update($validatedData);

        if ($request->has('detail')) {
            $pesanan->detailPesanan()->delete();
            foreach ($request->detail as $detail) {
                $pesanan->detailPesanan()->create($detail);
            }
        }

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->detailPesanan()->delete();
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
