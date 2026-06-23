<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $payment->id }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #e3f2fd; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 16px; box-shadow: 0 4px 20px rgba(25, 118, 210, 0.15); }
        .header { text-align: center; border-bottom: 2px solid #e3f2fd; padding-bottom: 20px; margin-bottom: 20px; }
        .header h1 { color: #0d47a1; font-size: 28px; }
        .header p { color: #666; font-size: 14px; }
       
        .info { display: flex; justify-content: space-between; margin-bottom: 20px; padding: 15px; background: #f8f9fa; border-radius: 10px; }
        .info-item { font-size: 14px; }
        .info-item strong { color: #0d47a1; }
        .divider { border: none; border-top: 2px dashed #e0e0e0; margin: 20px 0; }
        .row { display: flex; justify-content: space-between; padding: 8px 0; }
        .row.total { font-weight: bold; font-size: 20px; color: #0d47a1; border-top: 2px solid #0d47a1; padding-top: 15px; margin-top: 10px; }
       
        .status-badge { display: inline-block; padding: 4px 16px; border-radius: 20px; font-size: 14px; font-weight: 600; }
        .status-completed { background: #e8f5e9; color: #2e7d32; }
        .status-pending { background: #fff3e0; color: #e65100; }
        .status-failed { background: #ffebee; color: #c62828; }
        
        .btn-back { display: inline-block; margin-top: 20px; color: #1976D2; text-decoration: none; }
        .btn-back:hover { color: #0d47a1; }
        .btn-print { background: #1976D2; color: white; border: none; padding: 10px 25px; border-radius: 8px; cursor: pointer; font-weight: 600; margin-top: 10px; }
        .btn-print:hover { background: #0d47a1; }
        .text-center { text-align: center; }
        .footer { text-align: center; color: #999; font-size: 12px; margin-top: 30px; border-top: 1px solid #e0e0e0; padding-top: 20px; }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🧾 INVOICE</h1>
            <p>#{{ $payment->id }} • {{ $payment->created_at->format('d M Y, H:i') }}</p>
        </div>

        <div class="info">
            <div class="info-item">
                <strong>Penumpang</strong><br>
                {{ $payment->passenger_name }}
            </div>
            <div class="info-item" style="text-align: right;">
                <strong>Status</strong><br>
                <span class="status-badge status-{{ $payment->status }}">
                    {{ ucfirst($payment->status) }}
                </span>
            </div>
        </div>

        <div class="info" style="background: #e3f2fd;">
            <div class="info-item">
                <strong>Metode Pembayaran</strong><br>
                {{ ucfirst($payment->payment_method) }}
            </div>
            <div class="info-item" style="text-align: right;">
                <strong>Tanggal</strong><br>
                {{ $payment->created_at->format('d M Y H:i') }}
            </div>
        </div>

        <hr class="divider">

        <div class="row">
            <span>Base Price</span>
            <span>Rp {{ number_format($payment->base_price ?? $payment->total_amount, 0, ',', '.') }}</span>
        </div>

        @if(($payment->tip_amount ?? 0) > 0)
        <div class="row">
            <span>Tip</span>
            <span>+ Rp {{ number_format($payment->tip_amount, 0, ',', '.') }}</span>
        </div>
        @endif

        @if(($payment->discount_amount ?? 0) > 0)
        <div class="row" style="color: #c62828;">
            <span>Diskon</span>
            <span>- Rp {{ number_format($payment->discount_amount, 0, ',', '.') }}</span>
        </div>
        @endif

        @if($payment->promo_code)
        <div class="row" style="font-size: 12px; color: #666;">
            <span>Promo</span>
            <span>{{ $payment->promo_code }}</span>
        </div>
        @endif

        <div class="row total">
            <span>Total</span>
            <span>Rp {{ number_format($payment->total_amount, 0, ',', '.') }}</span>
        </div>

        <a href="{{ route('payments.index') }}" class="btn-back">← Kembali ke History</a>

    </div>
</body>
</html>