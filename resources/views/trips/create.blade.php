<h2>Buat Pesanan</h2>

<form action="{{ route('trips.store') }}" method="POST">
    @csrf

    <div style="margin-bottom: 15px;">
        <label for="pickup_point" style="display:block; font-weight:bold; margin-bottom:5px;">Lokasi Jemput (Pick Up):</label>
        <input type="text" id="pickup_point" name="pickup_point" list="lokasi-list" placeholder="Ketik lokasi jemput (misal: Senayan...)" style="width: 100%; padding: 10px;" required>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="dropoff_point" style="display:block; font-weight:bold; margin-bottom:5px;">Lokasi Tujuan (Drop Off):</label>
        <input type="text" id="dropoff_point" name="dropoff_point" list="lokasi-list" placeholder="Ketik lokasi tujuan..." style="width: 100%; padding: 10px;" required>
    </div>

    <datalist id="lokasi-list">
        <option value="Senayan Park (SPARK)">
        <option value="GBK Madya B, Jakarta">
        <option value="Mal Ciputra Jakarta">
        <option value="Fore Coffee - Mall Ambasador">
        <option value="Social Beans Cafe">
        <option value="Stasiun Gambir">
        <option value="Bandara Soekarno-Hatta">
        <option value="UNTAR">
        <option value="Universitas Tarumanagara">
        <option value="Central Park">
    </datalist>

    <button type="submit" style="padding: 12px 20px; background-color: #28a745; color: white; border: none; font-weight: bold; border-radius: 5px; cursor: pointer;">
        Pesan Sekarang
    </button>
</form>

<br>
<a href="{{ route('dashboard') }}">← Kembali ke Dashboard</a>