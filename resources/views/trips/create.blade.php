<h2>Buat Pesanan</h2>

<form action="{{ route('trips.store') }}" method="POST">
    @csrf

    <div style="margin-bottom: 15px;">
        <label for="pickup_location" style="display:block; font-weight:bold; margin-bottom:5px;">Lokasi Jemput (Pick Up):</label>
        <input type="text" id="pickup_location" name="pickup_location" list="lokasi-list" placeholder="Ketik lokasi jemput (misal: Senayan...)" style="width: 100%; padding: 10px;" required>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="dropoff_location" style="display:block; font-weight:bold; margin-bottom:5px;">Lokasi Tujuan (Drop Off):</label>
        <input type="text" id="dropoff_location" name="dropoff_location" list="lokasi-list" placeholder="Ketik lokasi tujuan..." style="width: 100%; padding: 10px;" required>
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

    <div style="margin-bottom: 20px;">
        <label style="display:block; font-weight:bold; margin-bottom:5px;">Rute Peta:</label>
        <div style="width: 100%; height: 300px; border: 2px solid #ccc; border-radius: 8px; overflow: hidden; background-color: #f0f0f0; display: flex; justify-content: center; align-items: center; position: relative;">
            
            <img src="https://maps.googleapis.com/maps/api/staticmap?center=-6.2088,106.8456&zoom=13&size=600x300&sensor=false" alt="Peta Dummy Jakarta" style="width: 100%; height: 100%; object-fit: cover;">
            
            <div style="position: absolute; color: red; font-size: 24px; font-weight: bold; top: 40%; left: 50%; transform: translate(-50%, -50%);">📍</div>
        </div>
    </div>

    <button type="submit" style="padding: 12px 20px; background-color: #28a745; color: white; border: none; font-weight: bold; border-radius: 5px; cursor: pointer;">
        Pesan Sekarang
    </button>
</form>

<br>
<a href="{{ route('dashboard') }}">← Kembali ke Dashboard</a>