<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Tipe Layanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-[#e0f2fe] to-[#bae6fd] min-h-screen flex justify-center items-center p-4">

<div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8 border border-white/20">
    
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-[#0369a1]">Tipe Layanan</h1>
        <p class="text-sm text-gray-500 mt-1">Pilih Tipe Layanan Duluu Bebb</p>
    </div>

    <form action="{{ route('service-types.store') }}" method="POST" class="space-y-4">
        @csrf

        <label class="flex items-center justify-between p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-blue-400 hover:bg-blue-50/30 transition group">
            <div class="flex items-center gap-4">
                <input type="radio" name="service_type" value="hemat" required class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                <div>
                    <span class="block font-bold text-gray-800 group-hover:text-blue-600 transition">🌱 Hemat Rp.7000</span>
                    <span class="block text-xs text-gray-400 mt-0.5">Paling Ekonomis Buat Kamu Nih Bebb</span>
                </div>
            </div>
        </label>
            
        <label class="flex items-center justify-between p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-blue-400 hover:bg-blue-50/30 transition group">
            <div class="flex items-center gap-4">
                <input type="radio" name="service_type" value="standar" class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                <div>
                    <span class="block font-bold text-gray-800 group-hover:text-blue-600 transition">🛵 Standar Rp.10000</span>
                    <span class="block text-xs text-gray-400 mt-0.5">Yangg Tengah-Tengah Nih Bebb</span>
                </div>
            </div>
        </label>

        <label class="flex items-center justify-between p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-blue-400 hover:bg-blue-50/30 transition group">
            <div class="flex items-center gap-4">
                <input type="radio" name="service_type" value="comfort" class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                <div>
                    <span class="block font-bold text-gray-800 group-hover:text-blue-600 transition">✨ Comfort Rp.15000</span>
                    <span class="block text-xs text-gray-400 mt-0.5">Pelayanan Paling Wahh dan Nampol Buat Kamu Bebb</span>
                </div>
            </div>
        </label>

        <div class="mt-8 flex justify-center">
            <button type="submit" class="w-full max-w-md bg-blue-600 text-white font-bold py-3.5 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/20 text-center block transition active:scale-[0.99]">
                Lanjutkan ke Metode Pembayaran ➔
            </button>
        </div>
        
    </form>
</div>

</body>
</html>