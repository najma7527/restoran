<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use Illuminate\Http\Request;

class stokBarangController extends Controller
{
    public function index()
    {
        $data = StokBarang::all();
        return view('crud.stok', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bahan' => 'required',
            'satuan' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        StokBarang::create($request->all());
        return redirect()->back()->with('success', 'Berhasil menambahkan stok.');
    }

    public function update(Request $request, StokBarang $stokBarang)
    {
        $request->validate([
            'nama_bahan' => 'required',
            'satuan' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        $stokBarang->update($request->all());
        return redirect()->back()->with('success', 'Berhasil mengupdate stok.');
    }

    public function destroy(StokBarang $stokBarang)
    {
        $stokBarang->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus stok.');
    }
}
