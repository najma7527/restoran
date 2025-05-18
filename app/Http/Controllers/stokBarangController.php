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
            'nama_bahan' => 'required|string|max:100',
            'satuan' => 'required|string|max:50',
            'jumlah' => 'required|numeric',
        ]);

        StokBarang::create($request->all());

        return redirect()->route('stok.index')->with('success', 'Stok berhasil ditambahkan.');
    }

    public function edit(StokBarang $stok)
    {
        $editData = $stok;
        $data = StokBarang::all();

        return view('crud.stok', compact('data', 'editData'));
    }

    public function update(Request $request, StokBarang $stok)
    {
        $request->validate([
            'nama_bahan' => 'required|string|max:100',
            'satuan' => 'required|string|max:50',
            'jumlah' => 'required|numeric',
        ]);

        $stok->update($request->all());

        return redirect()->route('stok.index')->with('success', 'Stok berhasil diperbarui.');
    }

    public function destroy(StokBarang $stok)
    {
        $stok->delete();

        return redirect()->route('stok.index')->with('success', 'Stok berhasil dihapus.');
    }
}
