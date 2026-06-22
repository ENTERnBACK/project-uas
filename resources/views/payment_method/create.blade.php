<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metode Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-[#e0f2fe] to-[#bae6fd] min-h-screen flex justify-center items-center p-4">

<div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8 border border-white/20">
    
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-[#0369a1]">Metode Pembayaran</h1>
        <p class="text-sm text-gray-500 mt-1">Silahkan Pilih Metode Pembayaran Anda Yaaa</p>
    </div>

    <form action="{{ route('payment_method.store') }}" method="POST" class="space-y-6">
        @csrf
        
        @if(request()->query('type') == 'bank')
            <input type="hidden" name="method" value="bank">
            
            <div class="space-y-4">
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-700 mb-2">Nama Bank</label>
                    <input type="text" name="bank_name" placeholder="Contoh: BCA, Mandiri, BNI" required class="w-full p-3 border-2 border-gray-100 rounded-xl bg-gray-50/50 focus:border-blue-500 focus:bg-white outline-none transition">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-700 mb-2">Nomor Kartu</label>
                    <input type="text" name="card_number" placeholder="xxxx - xxxx - xxxx - xxxx" required class="w-full p-3 border-2 border-gray-100 rounded-xl bg-gray-50/50 focus:border-blue-500 focus:bg-white outline-none transition">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-700 mb-2">Masa Berlaku</label>
                    <input type="text" name="expiry" placeholder="MM/YY" required class="w-full p-3 border-2 border-gray-100 rounded-xl bg-gray-50/50 focus:border-blue-500 focus:bg-white outline-none transition">
                </div>
            </div>

        @elseif(request()->query('type') == 'linkjago')
            <input type="hidden" name="method" value="linkjago">
            
            <div class="space-y-4">
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-700 mb-2">Nama Akun</label>
                    <input type="text" name="account_name" placeholder="Masukkan nama akun LinkJago" required class="w-full p-3 border-2 border-gray-100 rounded-xl bg-gray-50/50 focus:border-blue-500 focus:bg-white outline-none transition">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" placeholder="••••••••" required class="w-full p-3 border-2 border-gray-100 rounded-xl bg-gray-50/50 focus:border-blue-500 focus:bg-white outline-none transition">
                </div>
            </div>
        @endif

        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3.5 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/20 active:scale-[0.99] transition">
            Simpan Metode Pembayaran
        </button>
    </form>
</div>

</body>
</html>