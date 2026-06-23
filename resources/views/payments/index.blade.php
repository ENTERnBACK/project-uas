<!DOCTYPE html>
<html>
<head>
    <title>History Pembayaran</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #e3f2fd; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 25px; border-radius: 16px; box-shadow: 0 4px 20px rgba(25, 118, 210, 0.15); }
        h1 { font-size: 24px; color: #0d47a1; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        h1 .badge { font-size: 14px; background: #e3f2fd; padding: 5px 12px; border-radius: 20px; color: #0d47a1; }
        .total-earnings { background: #e3f2fd; padding: 15px; border-radius: 10px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .total-earnings .amount { font-size: 24px; font-weight: bold; color: #0d47a1; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #0d47a1; color: white; padding: 12px; text-align: center; }
        td { padding: 12px; border-bottom: 1px solid #e0e0e0; }
        tr:hover { background: #f5f5f5; }
        .status { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .status-completed { background: #e8f5e9; color: #2e7d32; }
        .status-pending { background: #fff3e0; color: #e65100; }
        .status-failed { background: #ffebee; color: #c62828; }
        .btn-detail { background: #1976D2; color: white; border: none; padding: 5px 15px; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 12px; }
        .btn-detail:hover { background: #0d47a1; }
        .btn-back { display: inline-block; margin-top: 20px; color: #1976D2; text-decoration: none; }
        .btn-back:hover { color: #0d47a1; }
        .pagination { margin-top: 20px; display: flex; justify-content: center; }
        .pagination a, .pagination span { padding: 8px 16px; margin: 0 4px; border: 1px solid #ddd; text-decoration: none; color: #1976D2; border-radius: 6px; }
        .pagination .active { background: #1976D2; color: white; border-color: #1976D2; }
        .empty { text-align: center; padding: 40px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <h1>
            📋 History Pembayaran
            <span class="badge">Total: {{ $payments->total() }} transaksi</span>
        </h1>

        <div class="total-earnings">
            <span>💰 Total Pengeluaran</span>
            <span class="amount">Rp {{ number_format($totalEarnings, 0, ',', '.') }}</span>
        </div>

        @if($payments->isEmpty())
            <div class="empty">
                <p style="font-size: 18px;"> Belum ada riwayat pembayaran</p>
                <p style="font-size: 14px; margin-top: 8px;">Silakan lakukan pembayaran untuk melihat history</p>
            </div>
        @else
            <table>
                <thead>
                <tr>
                    <th style="width:15%; text-align:center;">ID</th>
                    <th style="width:35%;">Tanggal</th>
                    <th style="width:20%; text-align:center;">Total</th>
                    <th style="width:15%; text-align:center;">Status</th>
                    <th style="width:15%; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td style="text-align:center;">
                        #PAY-{{ str_pad($payment->id, 4, '0', STR_PAD_LEFT) }}
                    </td>

                    <td>
                        {{ $payment->created_at->format('d M Y H:i') }}
                    </td>

                    <td style="text-align:center;">
                        Rp {{ number_format($payment->total_amount, 0, ',', '.') }}
                    </td>

                    <td style="text-align:center;">
                        <span class="status status-{{ $payment->status }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>

                    <td style="text-align:center;">
                        <a href="{{ route('payments.show', $payment->id) }}" class="btn-detail">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>

            <div class="pagination">
                {{ $payments->links() }}
            </div>
        @endif

        <a href="{{ route('dashboard') }}" class="btn-back">← Kembali ke Dashboard</a>
    </div>
</body>
</html>