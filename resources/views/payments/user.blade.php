<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { margin-top: 0; }
        .trip-info { background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .trip-info p { margin: 5px 0; }
        .service-option { display: flex; align-items: center; gap: 10px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; margin: 5px 0; cursor: pointer; }
        .service-option:hover { background: #f0f0f0; }
        .service-option .price { margin-left: auto; font-weight: bold; color: #4CAF50; }
        .promo-section { display: flex; gap: 10px; margin: 10px 0; flex-wrap: wrap; align-items: center; }
        .promo-section input { flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px; min-width: 150px; }
        .promo-section .btn-pakai { background: #2196F3; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
        .promo-section .btn-lihat { background: #FF9800; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; display: inline-block; }
        .payment-method-group { display: flex; flex-wrap: wrap; gap: 10px; margin: 10px 0; }
        .payment-option { padding: 10px 15px; border: 1px solid #ddd; border-radius: 5px; background: white; cursor: pointer; }
        .payment-option.active { background: #4CAF50; color: white; border-color: #4CAF50; }
        .tip-section input { padding: 10px; border: 1px solid #ddd; border-radius: 5px; width: 100%; box-sizing: border-box; }
        .total-section { text-align: center; padding: 15px; background: #e8f5e9; border-radius: 8px; margin: 15px 0; }
        .total-section .amount { font-size: 24px; font-weight: bold; color: #2e7d32; }
        .btn-bayar { width: 100%; padding: 15px; background: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 18px; cursor: pointer; }
        .btn-bayar:hover { background: #45a049; }
        .promo-success { background: #e8f5e9; padding: 12px 15px; border-radius: 5px; color: #2e7d32; margin: 10px 0; border-left: 4px solid #4CAF50; }
        .promo-error { background: #ffebee; padding: 12px 15px; border-radius: 5px; color: #c62828; margin: 10px 0; border-left: 4px solid #f44336; }
        .back-link { display: block; margin-top: 15px; color: #666; text-decoration: none; }
        .batal-promo { color: #c62828; margin-left: 10px; font-weight: bold; text-decoration: underline; cursor: pointer; }
        .batal-promo:hover { color: #b71c1c; }
    </style>
</head>
<body>
    <div class="container">
        <h1>💳 Pembayaran</h1>

        @if(session('success'))
            <div class="promo-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="promo-error">❌ {{ session('error') }}</div>
        @endif

        <div class="trip-info">
            <p><strong>📍 Pick Up:</strong> {{ $trip->pickup_point ?? 'Belum ada' }}</p>
            <p><strong>📍 Destination:</strong> {{ $trip->dropoff_point ?? 'Belum ada' }}</p>
            <p><strong>👤 Penumpang:</strong> {{ $passengerName ?? 'Guest' }}</p>
        </div>

        <form method="POST" action="{{ route('payments.process') }}">
            @csrf
            <input type="hidden" name="trip_id" value="{{ $trip->id }}">

           <h3> Layanan Dipilih</h3>
            <div class="service-option">
                <strong>{{ ucfirst($selectedService) }}</strong>
            </div>

            <h3> Kode Promo</h3>
            <div class="promo-section">
                <input type="text" id="promo_code" placeholder="Masukkan kode promo">
                <button type="button" class="btn-pakai" onclick="applyPromo()">Pakai</button>
                <button type="button" class="btn-lihat" onclick="goToPromo()">Lihat Promo </button>
            </div>

            <div id="promo_message">
                @if($appliedPromo && $discountAmount > 0)
                    <div class="promo-success">
                        ✅ Promo <strong>{{ $appliedPromo }}</strong> sedang dipakai (Diskon Rp {{ number_format($discountAmount, 0, ',', '.') }})
                        <a href="{{ route('promos.remove') }}" class="batal-promo">[Batal]</a>
                    </div>
                @endif
            </div>

            <h3>Metode Pembayaran</h3>

            <div class="service-option">
                <span>
                    {{ $paymentMethod->label ?? 'Cash' }}
                </span>

                <span class="price">
                    Aktif
                </span>
            </div>

            <input
                type="hidden", name="payment_method", value="{{ $paymentMethod->method ?? 'cash' }}" >

            <h3>💵 Tip (opsional)</h3>
            <div class="tip-section">
                <input type="number" name="tip_amount" id="tip_amount" placeholder="Masukkan tip" min="0" oninput="updateTotal()">
            </div>

            <div class="trip-info">
                <p><strong>Harga Layanan:</strong> Rp {{ number_format($basePrice,0,',','.') }}</p>

                <p>
                    <strong>Potongan Promo:</strong>
                    <span id="promo_discount">Rp {{ number_format($discountAmount,0,',','.') }}</span>
                </p>

                <p>
                    <strong>Tip:</strong>
                    <span id="tip_display">Rp 0</span>
                </p>

                <hr>

                <p>
                    <strong>Total:</strong>
                    <span id="total_display">
                        Rp {{ number_format($basePrice - $discountAmount,0,',','.') }}
                    </span>
                </p>
            </div>

            <button type="submit" class="btn-bayar">Bayar Sekarang</button>
        </form>

        <a href="{{ route('dashboard') }}" class="back-link">← Kembali ke Dashboard</a>
    </div>

    <script>
        let discountAmount = {{ $discountAmount ?? 0 }};
        let appliedPromo = '{{ $appliedPromo ?? '' }}';

        function getTip() {
            return parseInt(document.getElementById('tip_amount').value) || 0;
        }

        function updateTotal() {
            let tip = getTip();
            let total = {{ $basePrice }} + tip - discountAmount;

            document.getElementById('tip_display').innerText =
                'Rp ' + tip.toLocaleString('id-ID');

            document.getElementById('total_display').innerText =
                'Rp ' + total.toLocaleString('id-ID');
        }

        function selectPayment(method) {
            document.querySelectorAll('.payment-option').forEach(btn => btn.classList.remove('active'));
            document.querySelector(`.payment-option[data-method="${method}"]`)?.classList.add('active');
            document.getElementById('payment_method').value = method;
        }

        function applyPromo() {
            const code = document.getElementById('promo_code').value.trim();
            const msg = document.getElementById('promo_message');

            if (!code) {
                msg.innerHTML = '<div class="promo-error">❌ Masukkan kode promo!</div>';
                return;
            }

            fetch('/promos/apply', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ promo_code: code })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    discountAmount = data.discount;
                    appliedPromo = code;

                    document.getElementById('promo_discount').innerText =
                        'Rp ' + data.discount.toLocaleString('id-ID');

                    msg.innerHTML =
                        '<div class="promo-success">✅ ' +
                        data.message +
                        ' <a href="/promos/remove" class="batal-promo">[Batal]</a></div>';
                } else {
                    msg.innerHTML = '<div class="promo-error">❌ ' + data.message + '</div>';
                }
                updateTotal();
            })
            .catch(() => {
                msg.innerHTML = '<div class="promo-error">❌ Terjadi kesalahan</div>';
            });
        }

        function goToPromo() {
            window.location.href = '/promos/user';
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateTotal();
            document.getElementById('tip_amount').addEventListener('input', updateTotal);
        });
    </script>
</body>
</html>