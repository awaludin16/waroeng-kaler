<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\TableCafe as Meja;

class ApiMenuController extends Controller
{
    public function getMenuByMeja($nomor_meja)
    {
        $meja = Meja::where('nomor_meja', $nomor_meja)->first();

        if (!$meja) {
            return response()->json(['error' => 'Nomor meja tidak ditemukan.'], 404);
        }

        $categories = Category::all();
        $menusByCategory = [];

        foreach ($categories as $cat) {
            $menus = Menu::where('kategori_id', $cat->id)->get()->map(function ($menu) {
                return [
                    'id' => $menu->id,
                    'nama_menu' => $menu->nama_menu,
                    'deskripsi' => $menu->deskripsi,
                    'harga' => $menu->harga,
                    'gambar_url' => $menu->gambar ? asset('storage/menu-images/' . $menu->gambar) : null,
                ];
            });

            $menusByCategory[] = [
                'kategori' => $cat->nama_kategori,
                'menus' => $menus,
            ];
        }

        return response()->json([
            'meja' => $meja->nomor_meja,
            'data' => $menusByCategory,
        ]);
    }
}
