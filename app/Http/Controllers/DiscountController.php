<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $diskons = Diskon::all();
        return view('crud.diskon', compact('diskons'));
    }

    public function create()
    {
        return view('crud.diskon');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_diskon' => 'required|string|max:255',
            'persentase' => 'required|numeric|min:0|max:100',
            'tanggal_berlaku' => 'required|date'
        ]);

        Diskon::create($request->all());

        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil ditambahkan');
    }

    public function edit(Diskon $diskon)
    {
        return view('crud.diskon', compact('diskon'));
    }

    public function update(Request $request, Diskon $diskon)
    {
        $request->validate([
            'nama_diskon' => 'required|string|max:255',
            'persentase' => 'required|numeric|min:0|max:100',
            'tanggal_berlaku' => 'required|date'
        ]);

        $diskon->update($request->all());

        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil diperbarui');
    }

    public function destroy(Diskon $diskon)
    {
        $diskon->delete();

        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil dihapus');
    }
}
