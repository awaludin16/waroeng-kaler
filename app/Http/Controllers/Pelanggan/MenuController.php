<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\TableCafe as Meja;

class MenuController extends Controller
{
    public function index(Meja $meja)
    {
        session(['nomor_meja' => $meja->nomor_meja]); // simpan ke session

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

        $cartCount = collect(session('cart'))->sum('quantity') ?? 0;

        return view('pelanggan.menu', compact('menusByCategory', 'meja', 'cartCount', 'categories'));
    }
}
