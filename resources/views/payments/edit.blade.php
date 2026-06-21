<h1>Ubah Status Pembayaran</h1>

<p><strong>Trip ID:</strong> {{ $payment->trip_id }}</p>
<p><strong>Penumpang:</strong> {{ $payment->passenger_name }}</p>
<p><strong>Total:</strong> Rp {{ number_format($payment->total_amount, 0, ',', '.') }}</p>

<hr>

<form method="POST" action="{{ route('payments.update', $payment) }}">
    @csrf
    @method('PUT')

    Status:
    <br>
    <select name="status">
        <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="paid" {{ $payment->status == 'paid' ? 'selected' : '' }}>Paid</option>
        <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Failed</option>
        <option value="refunded" {{ $payment->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
    </select>
    <br><br>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('payments.index') }}">Kembali</a>