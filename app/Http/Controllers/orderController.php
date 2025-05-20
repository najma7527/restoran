<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Diskon;
use App\Models\Menu;
use App\Models\MetodePembayaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class orderController extends Controller
{

     public function index()
    {
        $menus = Menu::all();
        $metodes = MetodePembayaran::all();
        $diskons = Diskon::all();
        $pesanans = Pesanan::with('metodePembayaran', 'diskon')->orderBy('created_at', 'desc')->get();
        return view('crud.pesanan', compact('pesanans', 'menus', 'metodes', 'diskons'));
    }

    public function create()
    {
        $menus = Menu::all();
        $metodes = MetodePembayaran::all();
        $diskons = Diskon::all();

        return view('crud.pesanan', compact('menus', 'metodes', 'diskons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'menu_id' => 'required|array',
            'jumlah' => 'required|array',
            'id_metode' => 'required|exists:metode_pembayarans,id',
            'pembayaran' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            // Hitung total harga dari menu dan jumlah
            $total = 0;
            $detailItems = [];

            foreach ($request->menu_id as $i => $menu_id) {
                $menus = Menu::findOrFail($menu_id);
                $jumlah = $request->jumlah[$i];
                $subtotal = $menus->harga * $jumlah;
                $total += $subtotal;

                $detailItems[] = [
                    'id_menu' => $menu_id,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $menus->harga,
                    'subtotal' => $subtotal,
                ];
            }

            // Hitung diskon
            $diskon_id = $request->id_diskon;
            $diskon_persen = 0;
            if ($diskon_id) {
                $diskon = Diskon::findOrFail($diskon_id);
                $diskon_persen = $diskon->persentase;
            }

            $potongan = $total * ($diskon_persen / 100);
            $totalSetelahDiskon = $total - $potongan;

            // Hitung kembalian
            $pembayaran = $request->pembayaran;
            $kembalian = $pembayaran - $totalSetelahDiskon;

            // Simpan ke tabel `pesanans`
            $pesanan = Pesanan::create([
                'nama_pelanggan' => $request->nama_pelanggan,
                'total_harga' => $totalSetelahDiskon,
                'pembayaran' => $pembayaran,
                'kembalian' => $kembalian >= 0 ? $kembalian : 0,
                'id_metode' => $request->id_metode,
                'id_diskon' => $diskon_id,
                'tanggal' => Carbon::now(),
            ]);

            // Simpan detail pesanan
            foreach ($detailItems as $item) {
                DetailPesanan::create([
                    'id_pesanan' => $pesanan->id,
                    'id_menu' => $item['id_menu'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga_satuan'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            DB::commit();
            return redirect()->route('order.index')->with('success', 'Transaksi berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan transaksi.'])->withInput();
        }
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_pelanggan' => 'required|string|max:100',
        'status' => 'nullable|string|max:50',
    ]);

    $pesanan = Pesanan::findOrFail($id);
    $pesanan->nama_pelanggan = $request->nama_pelanggan;
    $pesanan->status = $request->status;
    $pesanan->save();

    return redirect()->route('staff_dapur')->with('success', 'Pesanan berhasil diperbarui.');
}


    public function edit($id)
    {
        $orders = Pesanan::with('detailPesanan.menu')->findOrFail($id);
        return view('Dashboard.StaffDapur', compact('orders'));
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->detailPesanan()->delete();
        $pesanan->delete();

        return redirect()->route('staff_dapur')->with('success', 'Transaksi berhasil dihapus.');

    }
}
