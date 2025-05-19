<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('order');

        if ($request->filled('tanggal')) {
            $query->whereDate('waktu_bayar', $request->tanggal);
        }

        $payments = $query->get();

        $total = $payments->sum('total_bayar');

        return view('owner.laporan.index', compact('payments', 'total'));
    }
}
