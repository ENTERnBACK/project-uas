<h1>Daftar Pembayaran</h1>

<a href="{{ route('payments.create') }}">Buat Pembayaran Baru</a>
<br><br>

@if ($payments->isEmpty())
    <p>Belum ada pembayaran.</p>
@else
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Trip ID</th>
                <th>Penumpang</th>
                <th>Total</th>
                <th>Tip</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $payment->trip_id }}</td>
                <td>{{ $payment->passenger_name }}</td>
                <td>Rp {{ number_format($payment->total_amount, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($payment->tip_amount, 0, ',', '.') }}</td>
                <td>
                    @if($payment->status == 'pending')
                        <span style="color: orange;">Pending</span>
                    @elseif($payment->status == 'paid')
                        <span style="color: green;">✅ Paid</span>
                    @elseif($payment->status == 'failed')
                        <span style="color: red;">❌ Failed</span>
                    @else
                        <span style="color: blue;">Refunded</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('payments.show', $payment) }}">Lihat</a>
                    <a href="{{ route('payments.edit', $payment) }}">Ubah Status</a>
                    @if($payment->status != 'paid')
                    <form action="{{ route('payments.mark-as-paid', $payment) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" style="color: green;">Bayar</button>
                    </form>
                    @endif
                    <form action="{{ route('payments.destroy', $payment) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus pembayaran?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $payments->links() }}
@endif