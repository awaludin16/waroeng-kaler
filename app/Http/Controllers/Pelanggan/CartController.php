<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

// class CartController extends Controller
// {
//     public function index()
//     {
//         dump(session()->all());
//         return view('pelanggan.cart');
//     }

//     public function add(Menu $menu)
//     {
//         $cart = session()->get('cart', []);
//         $id = $menu->id;

//         if (!isset($cart[$id])) {
//             $cart[$id] = [
//                 'name' => $menu->nama_menu,
//                 'price' => $menu->harga,
//                 'image' => $menu->gambar,
//                 'quantity' => 1
//             ];
//         } else {
//             $cart[$id]['quantity']++;
//         }

//         session()->put('cart', $cart);
//         return response()->json(['success' => true, 'cartCount' => count($cart)]);
//     }

//     public function update(Request $request)
//     {
//         $action = $request->input('action');
//         $id = $request->input('id');

//         $cart = session('cart', []);

//         if (!isset($cart[$id])) {
//             return response()->json(['status' => 'error', 'message' => 'Item tidak ditemukan'], 404);
//         }

//         switch ($action) {
//             case 'increase':
//                 $cart[$id]['quantity'] += 1;
//                 break;
//             case 'decrease':
//                 $cart[$id]['quantity'] = max(1, $cart[$id]['quantity'] - 1);
//                 break;
//             case 'remove':
//                 unset($cart[$id]);
//                 break;
//         }

//         session(['cart' => $cart]);

//         return response()->json([
//             'status' => 'success',
//             'cart' => $cart,
//             'total' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
//         ]);
//     }
// }


class CartController extends Controller
{
    public function index($nomor_meja)
    {
        $cart = session("cart_$nomor_meja", []);
        // dump([session("cart_$nomor_meja"), $nomor_meja]);
        return view('pelanggan.cart', compact('cart', 'nomor_meja'));
    }

    public function add($nomor_meja, Menu $menu)
    {
        $cartKey = "cart_$nomor_meja";
        $cart = session()->get($cartKey, []);

        if (!isset($cart[$menu->id])) {
            $cart[$menu->id] = [
                'name' => $menu->nama_menu,
                'price' => $menu->harga,
                'image' => $menu->gambar,
                'quantity' => 1
            ];
        } else {
            $cart[$menu->id]['quantity']++;
        }

        session()->put($cartKey, $cart);

        return response()->json([
            'success' => true,
            'cartCount' => collect($cart)->sum('quantity')
        ]);
    }

    public function update(Request $request, $nomor_meja)
    {
        $action = $request->input('action');
        $id = $request->input('id');

        $cartKey = "cart_$nomor_meja";
        $cart = session()->get($cartKey, []);

        if (!isset($cart[$id])) {
            return response()->json(['status' => 'error', 'message' => 'Item tidak ditemukan'], 404);
        }

        switch ($action) {
            case 'increase':
                $cart[$id]['quantity'] += 1;
                break;
            case 'decrease':
                $cart[$id]['quantity'] = max(1, $cart[$id]['quantity'] - 1);
                break;
            case 'remove':
                unset($cart[$id]);
                break;
        }

        session()->put($cartKey, $cart);

        return response()->json([
            'status' => 'success',
            'cart' => $cart,
            'total' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
        ]);
    }
}
