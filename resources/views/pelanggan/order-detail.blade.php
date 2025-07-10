@php
    use Carbon\Carbon;
@endphp
<x-guest-layout>
    <x-slot name="title">Keranjang</x-slot>

    {{-- heading --}}
    <div class="fixed left-0 right-0 z-50 mx-auto bg-white shadow -top-1">
        <div class="flex items-center p-4 border-b border-slate-200">
            <span class="pr-7">
                <i class="mx-auto text-2xl ri-arrow-left-line"></i>
            </span>
            <h1 class="text-xl font-bold text-slate-800 sm:text-3xl">Detail Pesanan</h1>
            <div class="flex items-center justify-end ml-auto">
                <span class="">
                    <i class="my-auto text-2xl ri-customer-service-line"></i>
                </span>
            </div>
        </div>
        <div class="flex items-center justify-between px-4 py-2">
            <h3 class="text-lg font-medium text-amber-700 before:content-['#']">{{ $order->id }}</h3>
            <span
                class="{{ $order->status == 'pending' ? 'text-amber-500' : 'text-emerald-500' }}">{{ ucfirst($order->status) }}</span>
        </div>
    </div>

    @if ($order->status == 'pending')
        <div class="p-4 mt-24 mb-4 text-base font-medium rounded text-amber-600 bg-emerald-100">
            <i class="ri-information-2-line"></i> Pesanan Berhasil Dibuat
            <p class="font-normal leading-5 mt-1.5 text-amber-600">Harap tunggu makanan kamu datang yaa </p>
        </div>
    @else
        <div class="p-4 mt-24 mb-4 text-base font-medium rounded text-emerald-800 bg-emerald-100">
            <i class="ri-checkbox-circle-line"></i> Pesanan Selesai
            <p class="font-normal leading-5 mt-1.5 text-slate-600">Terima kasih telah memesan
            </p>
        </div>
    @endif

    <div class="container mx-auto">
        <div class="m-4 bg-white border rounded border-slate-200">
            <div class="flex items-center px-3 py-4">
                <span class="pr-3"><i class="mx-auto text-xl ri-file-list-3-line"></i></span>
                <h3 class="font-medium text-slate-700">Informasi pesanan</h3>
            </div>
            <div class="px-3 pb-3 text-slate-600">
                <div class="flex items-center justify-between mb-2">
                    <p>Id pesanan</p>
                    <p class="font-normal text-slate-700">ORDR-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div class="flex items-center justify-between mb-2">
                    <p>Meja</p>
                    <p class="font-normal text-slate-700">Meja {{ $order->table->nomor_meja }}</p>
                </div>
                <div class="flex items-center justify-between mb-2">
                    <p>Nama pelanggan</p>
                    <p class="font-normal text-slate-700">{{ $order->nama_pelanggan }}</p>
                </div>
                <div class="flex items-center justify-between mb-2">
                    <p>Tgl pesanan</p>
                    <p class="font-normal text-slate-700">
                        {{ Carbon::parse($order->tanggal_pesanan)->translatedFormat('d F Y') }}</p>
                </div>
                <div class="flex items-center justify-between mb-2">
                    <p>Status pesanan</p>
                    <p class="font-normal text-slate-700">{{ ucfirst($order->status) }}</p>
                </div>
            </div>
        </div>

        <div class="m-4 bg-white border rounded border-slate-200">
            <div class="flex items-center px-3 py-4">
                <span class="pr-3"><i class="mx-auto text-xl ri-list-unordered"></i></span>
                <h3 class="font-medium text-slate-700">Rincian menu</h3>
            </div>
            <div class="px-3 pb-3 text-slate-600">
                @foreach ($order->items as $item)
                    <div class="flex items-center justify-between mb-2">
                        <p>{{ $item->jumlah }} x {{ $item->menu->nama_menu }}</p>
                        <p class="font-normal text-slate-700"><span
                                class="text-sm">Rp</span>{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    </div>
                @endforeach
                <div class="flex items-center justify-between mt-4 text-xl font-normal text-slate-700">
                    <p>Total</p>
                    <p>Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="m-4 bg-white border rounded border-slate-200">
            <div class="flex items-center px-3 py-4">
                <span class="pr-3"><i class="mx-auto text-xl ri-bank-card-2-line"></i></span>
                <h3 class="font-medium text-slate-700">Info pembayaran</h3>
                <div class="flex items-center justify-end ml-auto">
                    @if ($order->payment->status_pembayaran == 'pending')
                        <p class="text-rose-500">Unpaid</p>
                    @elseif ($order->payment->status_pembayaran == 'paid')
                        <p class="text-emerald-500">Paid</p>
                    @endif
                </div>
            </div>
            <div class="px-3 pb-3 text-slate-600">
                <div class="flex items-center justify-between mb-2">
                    <p>Total bayar</p>
                    <p class="font-normal text-slate-700"><span
                            class="text-sm">Rp</span>{{ number_format($order->payment->total_bayar, 0, ',', '.') }}</p>
                </div>
                <div class="flex items-center justify-between mb-2">
                    <p>Metode pembayaran</p>
                    <p class="font-normal text-slate-700">{{ $order->payment->metode_pembayaran }}</p>
                </div>
                <div class="flex items-center justify-between mb-2">
                    <p>Waktu transaksi</p>
                    <p class="font-normal text-slate-700">
                        {{ optional($order->payment)->waktu_bayar ? Carbon::parse($order->payment->waktu_bayar)->translatedFormat('d F Y H:i') : 'Null' }}
                </div>
                <div class="flex items-center justify-between mb-2">
                    <p>Status</p>
                    <p class="font-normal text-slate-700">{{ ucfirst($order->payment->status_pembayaran) }}</p>
                </div>
                <div class="flex items-center justify-between mb-2">
                    <p>Atas nama</p>
                    <p class="font-normal text-slate-700">
                        {{ $order->nama_pelanggan }}</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
