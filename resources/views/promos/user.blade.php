<!DOCTYPE html>
<html>
<head>
    <title>Pilih Promo</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        h1 { color: #333; }
        .promo-grid { display: flex; flex-direction: column; gap: 15px; }
        .promo-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .promo-card:hover { box-shadow: 0 4px 15px rgba(0,0,0,0.15); }
        .promo-info h3 { margin: 0; color: #333; }
        .promo-info p { margin: 5px 0; color: #666; }
        .discount { color: #e53935; font-weight: bold; font-size: 18px; }
        .min-trans { font-size: 12px; color: #999; }
        .btn-pakai {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-pakai:hover { background: #45a049; }
        .back-link {
            display: block;
            margin-top: 20px;
            color: #666;
            text-decoration: none;
            text-align: center;
        }
        .back-link:hover { color: #333; }
        .promo-empty { background: white; padding: 30px; border-radius: 10px; text-align: center; color: #666; }
        .usage-badge {
            display: inline-block;
            background: #e8f5e9;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 11px;
            color: #2e7d32;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎉 Pilih Promo</h1>

        @if ($promos->isEmpty())
            <div class="promo-empty">
                <p>Belum ada promo tersedia.</p>
            </div>
        @else
            <div class="promo-grid">
                @foreach ($promos as $promo)
                <div class="promo-card">
                    <div class="promo-info">
                        <h3>{{ $promo->code }}</h3>
                        <p>{{ $promo->name }}</p>
                        <p class="discount">
                            @if($promo->discount_type == 'percentage')
                                Diskon {{ $promo->discount_value }}%
                            @else
                                Diskon Rp {{ number_format($promo->discount_value, 0, ',', '.') }}
                            @endif
                        </p>
                        <p class="min-trans">Min. Transaksi: Rp {{ number_format($promo->min_transaction, 0, ',', '.') }}</p>
                        @if(isset($promo->usage_limit))
                            <span class="usage-badge">Sisa pemakaian: {{ $promo->usage_limit }}x</span>
                        @endif
                    </div>
                    <div>
                        <form action="{{ route('promos.apply') }}" method="POST">
                            @csrf
                            <input type="hidden" name="promo_code" value="{{ $promo->code }}">
                            <input type="hidden" name="trip_id" value="{{ session('current_trip_id', 1) }}">
                            <button type="submit" class="btn-pakai">Pakai</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        <a href="{{ route('dashboard') }}" class="back-link">← Kembali ke Dashboard</a>
    </div>
</body>
</html>