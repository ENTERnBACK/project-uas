<h1>Detail Pembayaran</h1>

<div style="padding: 20px; border: 1px solid #ccc;">
    <p><strong>Metode:</strong> {{ $payment->method }}</p>
    
    @if($payment->method == 'bca')
        <p><strong>Nomor VA BCA:</strong></p>
        <h2 style="color: blue;">8808{{ $payment->trip_id }}</h2>
    @elseif($payment->method == 'qris')
        <p><strong>Kode QRIS:</strong></p>
        <h2 style="color: blue;">QRIS-{{ $payment->trip_id }}</h2>
    @endif
    
    <a href="{{ url()->previous() }}">Back</a>
</div>