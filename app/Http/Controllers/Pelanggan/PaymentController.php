<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;

class PaymentController extends Controller
{

    var $apiInstance = null;

    public function __construct()
    {
        Configuration::setXenditKey(config('services.xendit.secret_key'));
        $this->apiInstance = new InvoiceApi();
    }

    public function payWithXendit(Order $order)
    {
        if ($order->payment && $order->payment->status === 'Paid') {
            return redirect()->route('order.detail', $order->id)
                ->with('info', 'Pesanan ini sudah dibayar.');
        }

        if ($order->payment && $order->payment->status === 'Pending') {
            return redirect($order->payment->checkout_url);
        }

        $external_id = 'order-' . $order->id . '-' . time();

        $create_invoice_request = new CreateInvoiceRequest([
            'external_id' => $external_id,
            'payer_email' => 'test@xendit.co', // bisa diganti
            'description' => 'Pembayaran Order #' . $order->id,
            'amount' => $order->total_harga,
            'success_redirect_url' => url(route('order.detail', $order->id)),
            'failure_redirect_url' => url(route('order.detail', $order->id)),

        ]);

        $invoice = $this->apiInstance->createInvoice($create_invoice_request);

        // dd($invoice);

        $order->payment()->create([
            'pesanan_id' => $order->id,
            'metode_pembayaran' => null,
            'total_bayar' => $invoice['amount'],
            'status_pembayaran' => 'Pending',
            'waktu_bayar' => null,
            'external_id' => $invoice['external_id'],
            'checkout_url' => $invoice['invoice_url'],
        ]);

        return redirect($invoice['invoice_url']);
        // return response()->json($invoice);
    }
    public function handleCallback(Request $request)
    {
        // Opsional: simpan log callback (untuk debugging)
        Log::info('Xendit Callback Received', $request->all());

        $externalId = $request->input('external_id');
        $status = $request->input('status');
        $paymentMethod = $request->input('payment_method');

        if (!$externalId || !$status) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        // Cari pembayaran berdasarkan external_id
        $payment = Payment::where('external_id', $externalId)->first();

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        if ($paymentMethod === 'QR_CODE' || $paymentMethod === 'EWALLET') {
            $paymentMethod = $request->input('payment_channel');
        } elseif ($paymentMethod === 'BANK_TRANSFER') {
            $paymentMethod = 'Virtual Account - ' . $request->input('payment_channel');
        }

        // Update data pembayaran
        $payment->update([
            'status_pembayaran' => $status === 'PAID' ? 'Paid' : $status,
            'waktu_bayar' => now(),
            'metode_pembayaran' => $paymentMethod ?? $payment->metode_pembayaran,
        ]);

        // Opsional: update status pesanan jika dibutuhkan
        if ($status === 'PAID') {
            $payment->order->update(['status' => 'Process']);
        }

        return response()->json(['message' => 'Callback processed'], 200);
    }
}
