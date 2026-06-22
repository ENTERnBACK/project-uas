<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Metode Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script> <style>
        body {
            background: linear-gradient(135deg,#4facfe,#00f2fe);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .login-card {
            width: 420px;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,.2);
            padding: 20px;
            background: white;
        }
    </style>
</head>
<body>

<div class="card login-card">
    <div class="max-w-md mx-auto p-6 bg-white">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">Atur Metode Pembayaran</h1>

        <form action="{{ route('payment_method.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="action" value="select"> 

            <label class="flex items-center justify-between p-4 border-b cursor-pointer hover:bg-gray-50">
                <div class="flex items-center gap-3">
                    <input type="radio" name="payment_option" value="cash" required>
                    <span class="font-semibold text-gray-800">CASH</span> <br><br>
                </div>
            </label>

            @if(in_array('bank', $myMethods->pluck('method')->toArray()))
                <label class="flex items-center justify-between p-4 border-b cursor-pointer hover:bg-gray-50">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="payment_option" value="bank" required>
                        <span class="font-semibold text-gray-800">BANK/DEBIT</span>
                    </div>
                    <span class="text-green-500 font-bold text-xs">Terdaftar</span>
                </label>
            @else
                <div class="flex items-center justify-between p-4 border-b">
                    <span class="font-semibold text-gray-400 ml-8">BANK/DEBIT</span> 
                    <a href="{{ route('payment_method.create', ['type' => 'bank']) }}" class="text-blue-600 font-bold text-sm">+ TAMBAH</a>
                </div><br><br>
            @endif

            @if(in_array('linkjago', $myMethods->pluck('method')->toArray()))
                <label class="flex items-center justify-between p-4 border-b cursor-pointer hover:bg-gray-50">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="payment_option" value="linkjago" required>
                        <span class="font-semibold text-gray-800">LINKJAGO</span>
                    </div>
                    <span class="text-green-500 font-bold text-xs">Terdaftar</span>
                </label>
            @else
                <div class="flex items-center justify-between p-4 border-b">
                    <span class="font-semibold text-gray-400 ml-8">LINKJAGO</span>
                    <a href="{{ route('payment_method.create', ['type' => 'linkjago']) }}" class="text-blue-600 font-bold text-sm">+ TAMBAH</a>
                </div>
            @endif
            <br><br>
            <button type="submit" class="w-full mt-6 bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition">
                Pilih Metode
            </button>
        </form>
    </div>
</div>

</body>
</html>