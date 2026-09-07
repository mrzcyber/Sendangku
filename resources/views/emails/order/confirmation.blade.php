@component('mail::message')
# Konfirmasi Pembelian Tiket

Halo, **{{ $order->buyer_name }}**!

Terima kasih sudah melakukan pembelian tiket.

**Detail Order:**

| | |
|---|---|
| Kode Order | {{ $order->order_code }} |
| Total Bayar | Rp {{ number_format($order->total_price, 0, ',', '.') }} |

**Detail Tiket:**

@component('mail::table')
| Tiket | Qty | Harga |
|---|---|---|
@foreach($order->orderItems as $item)
| {{ $item->ticketType->name }} | {{ $item->qty }} | Rp {{ number_format($item->price, 0, ',', '.') }} |
@endforeach
@endcomponent

**QR Code Tiket Anda:**

<div style="text-align: center;">
    <img src="{{ $qrCode }}" alt="QR Code" width="300">
</div>

Tunjukkan QR code ini saat masuk ke venue.

@endcomponent