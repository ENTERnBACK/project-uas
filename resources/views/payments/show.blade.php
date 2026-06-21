<h1>Detail Pembayaran</h1>

<p><strong>ID:</strong> {{ $payment->id }}</p>
<p><strong>Trip ID:</strong> {{ $payment->trip_id }}</p>
<p><strong>Penumpang:</strong> {{ $payment->passenger_name }}</p>
<p><strong>Passenger ID:</strong> {{ $payment->passenger_id }}</p>

<hr>

<h3>Rincian Biaya</h3>
<p><strong>Harga Perjalanan:</strong> Rp {{ number_format($payment->total_amount - $payment->tip_amount, 0, ',', '.') }}</p>
<p><strong>Tip:</strong> Rp {{ number_format($payment->tip_amount, 0, ',', '.') }}</p>
<p><strong>Total Dibayar:</strong> Rp {{ number_format($payment->total_amount, 0, ',', '.') }}</p>

<hr>

<h3>Status</h3>
<p><strong>Status:</strong>
    @if($payment->status == 'pending') ⏳ Pending
    @elseif($payment->status == 'paid') ✅ Paid
    @elseif($payment->status == 'failed') ❌ Failed
    @else 🔄 Refunded @endif
</p>

@if($payment->payment_time)
    <p><strong>Waktu Bayar:</strong> {{ $payment->payment_time }}</p>
@endif

<p><strong>Dibuat pada:</strong> {{ $payment->created_at }}</p>

<br>
<a href="{{ route('payments.index') }}">Kembali</a>
<a href="{{ route('payments.edit', $payment) }}">Ubah Status</a>

@if($payment->status != 'paid')
<form action="{{ route('payments.mark-as-paid', $payment) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" style="color: green;">Bayar Sekarang</button>
</form>
@endif

<form action="{{ route('payments.destroy', $payment) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Hapus pembayaran?')">Hapus</button>
</form>