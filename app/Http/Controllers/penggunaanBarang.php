<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\PenggunaanBahan;
use App\Models\StokBarang;
use Illuminate\Http\Request;

class penggunaanBarang extends Controller
{
    public function index()
    {
        $data = PenggunaanBahan::with(['menu', 'bahan'])->get();
        $menus = Menu::all();
        $bahans = StokBarang::all();
        return view('crud.penggunaanBarang', compact('data', 'menus', 'bahans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_menu' => 'required|exists:menus,id',
            'id_bahan' => 'required|exists:stok_barangs,id',
            'jumlah_digunakan' => 'required|numeric',
        ]);

        PenggunaanBahan::create($request->all());
        return redirect()->back()->with('success', 'Berhasil mencatat penggunaan bahan.');
    }

    public function update(Request $request, PenggunaanBahan $penggunaanBahan)
    {
        $request->validate([
            'id_menu' => 'required|exists:menus,id',
            'id_bahan' => 'required|exists:stok_barangs,id',
            'jumlah_digunakan' => 'required|numeric',
        ]);

        $penggunaanBahan->update($request->all());
        return redirect()->back()->with('success', 'Berhasil mengupdate data penggunaan.');
    }

    public function destroy(PenggunaanBahan $penggunaanBahan)
    {
        $penggunaanBahan->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data.');
    }
}
