<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\TableCafe as Meja;

class MenuController extends Controller
{
    public function index($nomor_meja)
    {
        $meja = Meja::where('nomor_meja', $nomor_meja)->first();

        if (!$meja) {
            abort(403, 'Nomor meja tidak ditemukan.');
        }

        $categories = Category::all();

        $menusByCategory = [];
        foreach ($categories as $cat) {
            $menusByCategory[$cat->nama_kategori] = Menu::whereHas('category', function ($query) use ($cat) {
                $query->where('nama_kategori', $cat->nama_kategori);
            })->get();
        }

        $cartKey = "cart_meja_{$nomor_meja}";
        $cartCount = collect(session($cartKey))->sum('quantity') ?? 0;

        return view('pelanggan.menu', compact('menusByCategory', 'meja', 'cartCount', 'categories'));
    }
}
