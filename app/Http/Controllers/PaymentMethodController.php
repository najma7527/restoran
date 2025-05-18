<?php

namespace App\Http\Controllers;

use App\Models\MetodePembayaran;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $metodePembayaran = MetodePembayaran::all();
        return view('crud.Metode_pembayaran', compact('metodePembayaran'));
    }

    public function create()
    {
        return view('crud.Metode_pembayaran');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_metode' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        MetodePembayaran::create($request->all());

        return redirect()->route('metode-pembayaran.index')->with('success', 'Metode Pembayaran berhasil ditambahkan');
    }

    public function edit(MetodePembayaran $metodePembayaran)
    {
        $editData = $metodePembayaran;
        $metodePembayaran = MetodePembayaran::all();
        
        return view('crud.Metode_pembayaran', compact('metodePembayaran', 'editData'));
    }

    public function update(Request $request, MetodePembayaran $metodePembayaran)
    {
        $request->validate([
            'nama_metode' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        $metodePembayaran->update($request->all());

        return redirect()->route('metode-pembayaran.index')->with('success', 'Metode Pembayaran berhasil diperbarui');
    }

    public function destroy(MetodePembayaran $metodePembayaran)
    {
        $metodePembayaran->delete();

        return redirect()->route('metode-pembayaran.index')->with('success', 'Metode Pembayaran berhasil dihapus');
    }
}
