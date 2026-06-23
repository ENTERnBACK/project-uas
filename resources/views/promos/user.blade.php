<!DOCTYPE html>
<html>
<head>
    <title>Pilih Promo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #e3f2fd; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 25px; order-radius: 16px; box-shadow: 0 4px 20px rgba(25, 118, 210, 0.15); }
        h1 { font-size: 24px; margin-bottom: 20px; color: #0d47a1; display: flex;align-items: center; gap: 10px;}
        .promo-grid { display: flex; flex-direction: column; gap: 15px; }
        
        .promo-card { background: #e3f2fd; border-radius: 12px; padding: 18px; border-left: 5px solid #1976D2; display: flex; justify-content: space-between; align-items: center; transition: all 0.3s;}
        .promo-card:hover { box-shadow: 0 2px 12px rgba(25, 118, 210, 0.3); transform: translateX(5px); }
        .promo-info h3 { margin: 0; color: #0d47a1; font-size: 18px; font-weight: 700; }
        
        .promo-info p { margin: 5px 0; color: #555; font-size: 14px; }
        .promo-info .min-trans { font-size: 12px;color: #1976D2;}
        .btn-pakai {
            background: #1976D2; color: white; border: none; padding: 10px 25px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 14px; transition: all 0.2s;  min-width: 100px; }
        .btn-pakai:hover { background: #0d47a1; transform: scale(1.02); }
        .btn-pakai:disabled { background: #90caf9; cursor: not-allowed; transform: none; }
        
        .promo-message { font-size: 12px; margin-top: 8px; font-weight: 600;text-align: center; }
        .promo-message.error { color: #c62828; }
        .promo-message.success { color: #0d47a1; }
        .promo-empty { background: #e3f2fd; padding: 40px; border-radius: 12px; text-align: center; color: #666; }
        
        .btn-kembali { display: block; margin-top: 20px; padding: 12px; background: #1976D2; color: white; text-align: center; text-decoration: none; border-radius: 8px; font-weight: 600; transition: background 0.2s; }
        .btn-kembali:hover { background: #0d47a1; }
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; }
        .alert-success { background: #e3f2fd; color: #0d47a1; border-left: 4px solid #1976D2; }
        .alert-error { background: #ffebee; color: #c62828; border-left: 4px solid #f44336;  }

    </style>
</head>
<body>
    <div class="container">
        <h1>🎫 Pilih Promo</h1>

        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">❌ {{ session('error') }}</div>
        @endif

        @if ($promos->isEmpty())
            <div class="promo-empty">
                <p style="font-size: 18px;"> Belum ada promo tersedia</p>
                <p style="font-size: 14px; margin-top: 8px;">Silakan cek kembali nanti</p>
            </div>
        @else
            <div class="promo-grid">
                @foreach ($promos as $promo)
                <div class="promo-card" id="promo-{{ $promo->code }}">
                    <div class="promo-info">
                        <h3>{{ $promo->code }}</h3>
                        <p>{{ $promo->description }}</p>
                        <div class="min-trans">
                             Min. transaksi Rp {{ number_format($promo->min_transaction, 0, ',', '.') }}
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <button class="btn-pakai" onclick="applyPromo('{{ $promo->code }}', {{ session('base_price', 10000) }})">
                            Pakai
                        </button>
                        <div class="promo-message" id="msg-{{ $promo->code }}"></div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        <a href="{{ route('dashboard') }}" class="btn-kembali">
            ← Kembali ke Dashboard
        </a>
    </div>

    <script>
        function applyPromo(code, basePrice) {
            const messageDiv = document.getElementById('msg-' + code);
            const btn = messageDiv.parentElement.querySelector('.btn-pakai');
            
            messageDiv.innerHTML = '';
            messageDiv.className = 'promo-message';
            btn.disabled = true;
            btn.innerText = 'Memproses...';

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
                    messageDiv.className = 'promo-message success';
                    messageDiv.innerHTML = '✅ ' + data.message;
                    btn.innerText = '✓ Dipakai';
                    
                    setTimeout(function() {
                        window.location.href = data.redirect;
                    }, 1500);
                } else {
                    messageDiv.className = 'promo-message error';
                    messageDiv.innerHTML = '❌ ' + data.message;
                    btn.disabled = false;
                    btn.innerText = 'Pakai';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                messageDiv.className = 'promo-message error';
                messageDiv.innerHTML = '❌ Terjadi kesalahan';
                btn.disabled = false;
                btn.innerText = 'Pakai';
            });
        }
    </script>
</body>
</html>