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

        return redirect()->route('Diskon.index')->with('success', 'Diskon berhasil ditambahkan');
    }

    public function edit(Diskon $Diskon)
    {
        $editData = $Diskon;
        $diskons = Diskon::all();
                
        return view('crud.diskon', compact('diskons', 'editData'));
    }

    public function update(Request $request, Diskon $Diskon)
    {
        $request->validate([
            'nama_diskon' => 'required|string|max:255',
            'persentase' => 'required|numeric|min:0|max:100',
            'tanggal_berlaku' => 'required|date'
        ]);

        $Diskon->update($request->all());

        return redirect()->route('Diskon.index')->with('success', 'Diskon berhasil diperbarui');
    }

    public function destroy(Diskon $Diskon)
    {
        $Diskon->delete();

        return redirect()->route('Diskon.index')->with('success', 'Diskon berhasil dihapus');
    }
}
