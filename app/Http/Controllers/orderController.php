<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;

class orderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanan = Pesanan::all();
        return view('order', compact('pesanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'tanggal_pesanan' => 'required|date',
        ]);

        $pesanan = Pesanan::create($validatedData);

        if ($request->has('detail')) {
            foreach ($request->detail as $detail) {
                $pesanan->detailPesanan()->create($detail);
            }
        }

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat.');
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
