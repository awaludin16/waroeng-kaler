<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\TableCafe as Meja;

class MenuController extends Controller
{
    public function index(Meja $meja)
    {
        $menus = Menu::with('category')->get();

        return view('pelanggan.menu', compact('menus', 'meja'));
    }
}
