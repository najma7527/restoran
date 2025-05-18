<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('crud.menu', compact('menus'));
    }

    public function create()
    {
        return view('crud.menu');
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
        $menus = Menu::all();
    $editData = $menu;
    return view('crud.menu', compact('menus', 'editData'));
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