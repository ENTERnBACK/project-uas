<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metode Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-[#4facfe] to-[#00f2fe] min-h-screen flex justify-center items-center p-4 m-0">

<div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-6 border border-white/20">
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Atur Metode Pembayaran</h1>
        <p class="text-sm text-gray-500 mt-1">Silahkan Pilih Atau Daftarkan Pembayaran Anda yaaa</p>
    </div>

    <form action="{{ route('payment_method.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="action" value="select"> 

        <label class="flex items-center justify-between p-4 border border-gray-100 rounded-xl cursor-pointer hover:bg-blue-50/50 transition">
            <div class="flex items-center gap-3">
                <input type="radio" name="payment_option" value="cash" required class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                <span class="font-semibold text-gray-700">💵 CASH</span>
            </div>
        </label>

        @if(in_array('bank', $myMethods->pluck('method')->toArray()))
            <label class="flex items-center justify-between p-4 border border-gray-100 rounded-xl cursor-pointer hover:bg-blue-50/50 transition">
                <div class="flex items-center gap-3">
                    <input type="radio" name="payment_option" value="bank" required class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                    <span class="font-semibold text-gray-700">🏦 BANK/DEBIT</span>
                </div>
                <span class="bg-green-100 text-green-600 font-bold text-[10px] px-2.5 py-1 rounded-full uppercase tracking-wider">Terdaftar</span>
            </label>
        @else
            <div class="flex items-center justify-between p-4 border border-gray-100 rounded-xl bg-gray-50/50">
                <span class="font-semibold text-gray-400">🏦 BANK/DEBIT</span> 
                <a href="{{ route('payment_method.create', ['type' => 'bank']) }}" class="text-blue-600 font-bold text-xs hover:text-blue-700 hover:underline">+ TAMBAH</a>
            </div>
        @endif

        @if(in_array('linkjago', $myMethods->pluck('method')->toArray()))
            <label class="flex items-center justify-between p-4 border border-gray-100 rounded-xl cursor-pointer hover:bg-blue-50/50 transition">
                <div class="flex items-center gap-3">
                    <input type="radio" name="payment_option" value="linkjago" required class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                    <span class="font-semibold text-gray-700">📱 LINKJAGO</span>
                </div>
                <span class="bg-green-100 text-green-600 font-bold text-[10px] px-2.5 py-1 rounded-full uppercase tracking-wider">Terdaftar</span>
            </label>
        @else
            <div class="flex items-center justify-between p-4 border border-gray-100 rounded-xl bg-gray-50/50">
                <span class="font-semibold text-gray-400">📱 LINKJAGO</span>
                <a href="{{ route('payment_method.create', ['type' => 'linkjago']) }}" class="text-blue-600 font-bold text-xs hover:text-blue-700 hover:underline">+ TAMBAH</a>
            </div>
        @endif

        <button type="submit" class="w-full mt-2 bg-blue-600 text-white font-bold py-3.5 rounded-xl hover:bg-blue-700 active:scale-[0.99] transition shadow-lg shadow-blue-600/20">
            Pilih Metode
        </button>
    </form>
</div>

</body>
</html>