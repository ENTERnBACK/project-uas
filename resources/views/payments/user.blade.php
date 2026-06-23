<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #e3f2fd; padding: 20px; }
        .container { max-width: 520px; margin: 0 auto; background: white; padding: 25px; border-radius: 16px; box-shadow: 0 4px 20px rgba(25, 118, 210, 0.15); }
        
        h1 { font-size: 24px; margin-bottom: 20px; color: #0d47a1; }
        .trip-info { background: #e3f2fd; padding: 16px; border-radius: 12px; margin-bottom: 20px; border-left: 4px solid #1976D2; }
        .trip-info p { margin: 6px 0; font-size: 14px; color: #333; }
        .trip-info strong { color: #0d47a1; }
        .section-title { font-size: 15px; font-weight: 600; color: #0d47a1; margin: 18px 0 10px 0; }
        .service-box { background: #e3f2fd; padding: 12px 16px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; }
        .service-box .service-name { font-weight: 600; color: #0d47a1; text-transform: capitalize; }
        .service-box .service-price { font-weight: 700; color: #1976D2; }
        
        .promo-section { display: flex; gap: 10px; margin: 10px 0; flex-wrap: wrap; }
        .promo-section input { flex: 1; padding: 11px 14px; border: 2px solid #bbdefb; border-radius: 10px; font-size: 14px; min-width: 150px; }
        .promo-section input:focus { outline: none; border-color: #1976D2; }
        
        .btn-pakai { background: #0d47a1; color: white; border: none; padding: 11px 24px; border-radius: 10px; cursor: pointer; font-weight: 600; }
        .btn-pakai:hover { background: #062a6e; }
        .btn-lihat { background: #F57C00; color: white; border: none; padding: 11px 18px; border-radius: 10px; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block; }
        .btn-lihat:hover { background: #0d47a1; }
        
        .promo-success { background: #e3f2fd; padding: 12px 16px; border-radius: 10px; color: #0d47a1; margin: 10px 0; border-left: 4px solid #1976D2; font-size: 14px; display: flex; justify-content: space-between; align-items: center; }
        .promo-error { background: #ffebee; padding: 12px 16px; border-radius: 10px; color: #c62828; margin: 10px 0; border-left: 4px solid #f44336; font-size: 14px; }
        .batal-promo { color: #c62828; font-weight: 600; cursor: pointer; background: none; border: none; font-size: 13px; }
        .batal-promo:hover { color: #b71c1c; }
        
        .payment-method-box { background: #e3f2fd; padding: 12px 16px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; }
        .payment-method-box .method-label { font-weight: 500; color: #0d47a1; }
        .payment-method-box .method-status { font-size: 13px; color: #1976D2; }
        
        .tip-section input { padding: 11px 14px; border: 2px solid #bbdefb; border-radius: 10px; width: 100%; box-sizing: border-box; font-size: 14px; }
        .tip-section input:focus { outline: none; border-color: #1976D2; }
        .divider { border: none; border-top: 2px dashed #bbdefb; margin: 16px 0; }
        
        .row { display: flex; justify-content: space-between; padding: 6px 0; font-size: 15px; color: #333; }
        .row.total { font-weight: 700; font-size: 18px; color: #0d47a1; padding-top: 12px; border-top: 2px solid #bbdefb; margin-top: 6px; }
        .total .amount { color: #1976D2; }
        
        .btn-bayar { width: 100%; padding: 16px; background: #4CAF50; color: white; border: none; border-radius: 12px; font-size: 18px; font-weight: 700; cursor: pointer; margin-top: 18px; }
        .btn-bayar:hover { background: #388E3C; }
        .back-link { display: block; margin-top: 16px; color: #1976D2; text-decoration: none; text-align: center; font-size: 14px; }
        .back-link:hover { color: #0d47a1; }
        #promo_message { min-height: 50px; }
        
        .flash-message { padding: 12px 16px; border-radius: 10px; margin-bottom: 16px; font-size: 14px; }
        .flash-success { background: #e3f2fd; color: #0d47a1; border-left: 4px solid #1976D2; }
        .flash-error { background: #ffebee; color: #c62828; border-left: 4px solid #f44336; }
        @media (max-width: 480px) { .container { padding: 16px; } .promo-section input { min-width: 120px; } }
    </style>
</head>
<body>
    <div class="container">
        <h1>💳 Pembayaran</h1>

        @if(session('success'))
            <div class="flash-message flash-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="flash-message flash-error">❌ {{ session('error') }}</div>
        @endif

        <div class="trip-info">
            <p><strong>📍 Pick Up:</strong> {{ $trip->pickup_point ?? 'Belum ada' }}</p>
            <p><strong>📍 Drop Off:</strong> {{ $trip->dropoff_point ?? 'Belum ada' }}</p>
            <p><strong>👤 Penumpang:</strong> {{ $passengerName ?? 'Guest' }}</p>
        </div>

        <form method="POST" action="{{ route('payments.process') }}" id="paymentForm">
            @csrf
            <input type="hidden" name="trip_id" value="{{ $trip->id }}">
            <input type="hidden" name="payment_method" id="payment_method" value="cash">

            <div class="section-title">Layanan Dipilih</div>
            <div class="service-box">
                <span class="service-name">{{ ucfirst($selectedService) }}</span>
                <span class="service-price">Rp {{ number_format($basePrice, 0, ',', '.') }}</span>
            </div>

            <div class="section-title">Kode Promo</div>
            <div class="promo-section">
                <input type="text" id="promo_code" placeholder="Masukkan kode promo" onkeypress="if(event.key==='Enter'){event.preventDefault();applyPromo();}">
                <button type="button" class="btn-pakai" onclick="applyPromo()">Pakai</button>
                <button type="button" class="btn-lihat" onclick="goToPromo()">Lihat Promo</button>
            </div>
            <div id="promo_message">
                @if($appliedPromo && $discountAmount > 0)
                    <div class="promo-success">
                        <span>✅ Promo <strong>{{ $appliedPromo }}</strong> (Diskon Rp {{ number_format($discountAmount, 0, ',', '.') }})</span>
                        <button type="button" class="batal-promo" onclick="removePromo()">Batal</button>
                    </div>
                @endif
            </div>

            <div class="section-title">💳 Metode Pembayaran</div>
            <div class="payment-method-box">
                <span class="method-label">Cash (Tunai)</span>
                <span class="method-status">✅ Aktif</span>
            </div>

            <div class="section-title">💵 Tip (opsional)</div>
            <div class="tip-section">
                <input type="number" name="tip_amount" id="tip_amount" placeholder="Masukkan nominal tip" min="0" step="1000" oninput="updateTotal()">
            </div>

            <hr class="divider">

            <div class="row"><span>Harga Layanan</span><span>Rp {{ number_format($basePrice, 0, ',', '.') }}</span></div>
            <div class="row"><span>Potongan Promo</span><span id="promo_discount">Rp {{ number_format($discountAmount, 0, ',', '.') }}</span></div>
            <div class="row"><span>Tip</span><span id="tip_display">Rp 0</span></div>
            <div class="row total"><span>Total</span><span class="amount" id="total_display">Rp {{ number_format($basePrice - $discountAmount, 0, ',', '.') }}</span></div>

            <button type="submit" class="btn-bayar">Bayar Sekarang</button>
        </form>

        <a href="{{ route('dashboard') }}" class="back-link">← Kembali ke Dashboard</a>
    </div>

    <script>
        let basePrice = {{ $basePrice }};
        let discountAmount = {{ $discountAmount ?? 0 }};

        function getTip() {
            return parseInt(document.getElementById('tip_amount').value) || 0;
        }

        function updateTotal() {
            let tip = getTip();
            let total = basePrice + tip - discountAmount;

            document.getElementById('tip_display').innerText = 'Rp ' + tip.toLocaleString('id-ID');
            document.getElementById('total_display').innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        function applyPromo() {
            const code = document.getElementById('promo_code').value.trim();
            const msg = document.getElementById('promo_message');

            if (!code) {
                msg.innerHTML = '<div class="promo-error">❌ Masukkan kode promo terlebih dahulu!</div>';
                return;
            }

            fetch('/promos/apply', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ 
                    promo_code: code,
                    base_price: basePrice 
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    discountAmount = data.discount_amount;

                    document.getElementById('promo_discount').innerText = 'Rp ' + data.discount_amount.toLocaleString('id-ID');
                    document.getElementById('promo_code').value = '';

                    msg.innerHTML = `<div class="promo-success">
                        <span>✅ ${data.message} (Diskon Rp ${data.discount_amount.toLocaleString('id-ID')})</span>
                        <button type="button" class="batal-promo" onclick="removePromo()">[Batal]</button>
                    </div>`;

                    updateTotal();
                } else {
                    msg.innerHTML = '<div class="promo-error">❌ ' + data.message + '</div>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                msg.innerHTML = '<div class="promo-error">❌ Terjadi kesalahan</div>';
            });
        }

        function removePromo() {
            fetch('/promos/remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    discountAmount = 0;
                    document.getElementById('promo_discount').innerText = 'Rp 0';
                    document.getElementById('promo_message').innerHTML = '';
                    updateTotal();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal menghapus promo');
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