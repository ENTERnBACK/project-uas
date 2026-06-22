<!DOCTYPE html>
<html>
<head>
    <title>Pilih Promo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; background: #e3f2fd; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        h1 { color: #0d47a1; }
        .promo-grid { display: flex; flex-direction: column; gap: 15px; }
        .promo-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 5px solid #1976D2;
        }
        .promo-card:hover { box-shadow: 0 4px 15px rgba(25, 118, 210, 0.3); }
        .promo-info h3 { margin: 0; color: #0d47a1; }
        .promo-info p { margin: 5px 0; color: #555; }
        .discount { color: #1976D2; font-weight: bold; font-size: 18px; }
        .min-trans { font-size: 12px; color: #999; }
        .btn-pakai {
            background: #1976D2;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-pakai:hover { background: #0d47a1; }
        .back-link {
            display: block;
            margin-top: 20px;
            color: #1976D2;
            text-decoration: none;
            text-align: center;
        }
        .back-link:hover { color: #0d47a1; }
        .promo-empty { background: white; padding: 30px; border-radius: 10px; text-align: center; color: #666; }
        .usage-badge {
            display: inline-block;
            background: #bbdefb;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 11px;
            color: #0d47a1;
        }
        .promo-message {
            font-size: 12px;
            margin-top: 5px;
            font-weight: bold;
        }
        .promo-message.error { color: #c62828; }
        .promo-message.success { color: #2e7d32; }
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
                <div class="promo-card" id="promo-{{ $promo->code }}">
                    <div class="promo-info">
                        <h3>{{ $promo->code }}</h3>
                        <p>{{$promo->description }}</p>

                        @if(isset($promo->usage_limit))
                            <span class="usage-badge">Sisa pemakaian: {{ $promo->usage_limit }}x</span>
                        @endif
                    </div>
                    <div style="text-align: right;">
                        <form action="{{ route('promos.apply') }}" method="POST" class="promo-form" data-code="{{ $promo->code }}">
                            @csrf
                            <input type="hidden" name="promo_code" value="{{ $promo->code }}">
                            <input type="hidden" name="trip_id" value="{{ session('current_trip_id', 1) }}">
                            <button type="submit" class="btn-pakai">Pakai</button>
                        </form>
                        <div class="promo-message" id="msg-{{ $promo->code }}"></div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        <a href="{{ route('payments.user', session('current_trip_id', 1)) }}" class="back-link">
            ← Kembali ke Pembayaran </a>
    </div>

    <script>
        document.querySelectorAll('.promo-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const code = this.dataset.code;
                const messageDiv = document.getElementById('msg-' + code);
                const formData = new FormData(this);

                messageDiv.innerHTML = '';
                messageDiv.className = 'promo-message';

                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {

                        messageDiv.className = 'promo-message success';
                        messageDiv.innerHTML = '✅ ' + data.message;

                        this.querySelector('.btn-pakai').disabled = true;
                        this.querySelector('.btn-pakai').innerText = 'Dipakai';

                        setTimeout(function() {
                            window.location.href = data.redirect;
                        }, 1500);

                    } else {
                        messageDiv.className = 'promo-message error';
                        messageDiv.innerHTML = '❌ ' + data.message;
                    }
                })
                .catch(() => {
                    messageDiv.className = 'promo-message error';
                    messageDiv.innerHTML = '❌ Terjadi kesalahan';
                });
            });
        });
    </script>
</body>
</html>