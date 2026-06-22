<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 { margin-top: 0; }
        .trip-info {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .trip-info p { margin: 5px 0; }
        .service-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 5px 0;
            cursor: pointer;
        }
        .service-option:hover { background: #f0f0f0; }
        .service-option .price {
            margin-left: auto;
            font-weight: bold;
            color: #4CAF50;
        }
        .promo-section {
            display: flex;
            gap: 10px;
            margin: 10px 0;
        }
        .promo-section input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .promo-section button {
            background: #2196F3;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .payment-method-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 10px 0;
        }
        .payment-option {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: white;
            cursor: pointer;
        }
        .payment-option.active {
            background: #4CAF50;
            color: white;
            border-color: #4CAF50;
        }
        .tip-section input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }
        .total-section {
            text-align: center;
            padding: 15px;
            background: #e8f5e9;
            border-radius: 8px;
            margin: 15px 0;
        }
        .total-section .amount {
            font-size: 24px;
            font-weight: bold;
            color: #2e7d32;
        }
        .btn-bayar {
            width: 100%;
            padding: 15px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }
        .btn-bayar:hover { background: #45a049; }
        .promo-success {
            background: #e8f5e9;
            padding: 10px;
            border-radius: 5px;
            color: #2e7d32;
            margin: 10px 0;
        }
        .promo-error {
            background: #ffebee;
            padding: 10px;
            border-radius: 5px;
            color: #c62828;
            margin: 10px 0;
        }
        .back-link {
            display: block;
            margin-top: 15px;
            color: #666;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>💳 Pembayaran</h1>

        <div class="trip-info">
            <p><strong>📍 Pick Up:</strong> {{ $trip->pickup_point ?? 'Belum ada' }}</p>
            <p><strong>📍 Destination:</strong> {{ $trip->dropoff_point ?? 'Belum ada' }}</p>
            <p><strong>👤 Penumpang:</strong> {{ $passengerName ?? 'Guest' }}</p>
        </div>

        <form method="POST" action="{{ route('payments.process') }}">
            @csrf
            <input type="hidden" name="trip_id" value="{{ $trip->id }}">

            <h3>💰 Pilih Layanan</h3>
            <div class="service-option" onclick="document.getElementById('service_hemat').checked = true; updateTotal();">
                <input type="radio" name="service_type" id="service_hemat" value="hemat" checked>
                <label>Hemat</label>
                <span class="price">Rp 7.000</span>
            </div>
            <div class="service-option" onclick="document.getElementById('service_standar').checked = true; updateTotal();">
                <input type="radio" name="service_type" id="service_standar" value="standar">
                <label>Standar</label>
                <span class="price">Rp 10.000</span>
            </div>
            <div class="service-option" onclick="document.getElementById('service_comfort').checked = true; updateTotal();">
                <input type="radio" name="service_type" id="service_comfort" value="comfort">
                <label>Comfort</label>
                <span class="price">Rp 15.000</span>
            </div>

            <h3>🎫 Kode Promo</h3>
            <div class="promo-section">
                <input type="text" id="promo_code" placeholder="Masukkan kode promo">
                <button type="button" onclick="applyPromo()">Pakai</button>
                <a href="{{ route('promos.user') }}" style="background: #FF9800; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; display: inline-block;">
                    📋 Lihat Promo
                </a>
            </div>
            <div id="promo_message"></div>

            <h3>💳 Metode Pembayaran</h3>
            <div class="payment-method-group">
                @foreach($paymentMethods as $pm)
                    <button type="button" class="payment-option {{ $loop->first ? 'active' : '' }}"
                            data-method="{{ $pm->method }}"
                            onclick="selectPayment('{{ $pm->method }}')">
                        @if($pm->method == 'cash') 💵 Cash
                        @elseif($pm->method == 'qris') 📱 QRIS
                        @elseif($pm->method == 'bca') 🏦 BCA VA
                        @elseif($pm->method == 'card') 💳 Card
                        @else {{ ucfirst($pm->method) }}
                        @endif
                    </button>
                @endforeach
            </div>
            <input type="hidden" name="payment_method" id="payment_method" value="{{ $paymentMethods->first()->method ?? 'cash' }}">

            <h3>💵 Tip (opsional)</h3>
            <div class="tip-section">
                <input type="number" name="tip_amount" id="tip_amount" placeholder="Masukkan tip" min="0" oninput="updateTotal()">
            </div>

            <div class="total-section">
                <p style="margin: 0;">Total</p>
                <div class="amount" id="total_display">Rp 10.000</div>
            </div>

            <button type="submit" class="btn-bayar">Bayar Sekarang</button>
        </form>

        <a href="{{ route('dashboard') }}" class="back-link">← Kembali ke Dashboard</a>
    </div>

    <script>
        const servicePrices = { hemat: 7000, standar: 10000, comfort: 15000 };
        let discountAmount = 0;

        function getBasePrice() {
            const selected = document.querySelector('input[name="service_type"]:checked');
            return selected ? servicePrices[selected.value] : 10000;
        }

        function getTip() {
            return parseInt(document.getElementById('tip_amount').value) || 0;
        }

        function updateTotal() {
            let total = getBasePrice() + getTip() - discountAmount;
            document.getElementById('total_display').innerText = 'Rp ' + total.toLocaleString('id-ID');
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

            fetch('{{ route("promos.apply") }}', {
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
                    msg.innerHTML = '<div class="promo-success">✅ ' + data.message + '</div>';
                } else {
                    msg.innerHTML = '<div class="promo-error">❌ ' + data.message + '</div>';
                }
                updateTotal();
            })
            .catch(() => {
                msg.innerHTML = '<div class="promo-error">❌ Terjadi kesalahan</div>';
            });
        }

        document.addEventListener('DOMContentLoaded', updateTotal);
    </script>
</body>
</html>