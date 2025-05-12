<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('menu', compact('menus'));
    }

    public function create()
    {
        return view('menu');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|in:Makanan,Minuman,Cemilan',
            'nama_menu' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        Menu::create($request->all());

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        return view('menu', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'category' => 'required|in:Makanan,Minuman,Cemilan',
            'nama_menu' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        $menu->update($request->all());

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}