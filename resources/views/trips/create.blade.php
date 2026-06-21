<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 100vh; background-color: #f8fafc; padding: 20px; font-family: 'Segoe UI', Roboto, sans-serif;">

    <div style="width: 100%; max-width: 500px; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border: 1px solid #e2e8f0; margin-bottom: 20px;">
        
        <h2 style="margin-top: 0; margin-bottom: 25px; color: #1e3a8a; font-size: 24px; font-weight: 700; letter-spacing: -0.5px; text-align: center;">Buat Pesanan</h2>

        <form action="{{ route('trips.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label for="pickup_point" style="display:block; font-weight: 600; margin-bottom: 8px; color: #334155; font-size: 14px;">Lokasi Jemput (Pick Up):</label>
                <input type="text" id="pickup_point" name="pickup_point" list="lokasi-list" placeholder="Ketik lokasi jemput (misal: Senayan...)" style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#cbd5e1'" required>
            </div>

            <div style="margin-bottom: 25px;">
                <label for="dropoff_point" style="display:block; font-weight: 600; margin-bottom: 8px; color: #334155; font-size: 14px;">Lokasi Tujuan (Drop Off):</label>
                <input type="text" id="dropoff_point" name="dropoff_point" list="lokasi-list" placeholder="Ketik lokasi tujuan..." style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#cbd5e1'" required>
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

            <button type="submit" style="width: 100%; padding: 14px 20px; background-color: #2563eb; color: white; border: none; font-weight: 600; font-size: 16px; border-radius: 8px; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2); transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#1d4ed8'" onmouseout="this.style.backgroundColor='#2563eb'">
                Pesan Sekarang
            </button>
        </form>
    </div>

    <a href="{{ route('dashboard') }}" style="color: #2563eb; text-decoration: none; font-size: 14px; font-weight: 500; display: inline-flex; align-items: center; gap: 5px;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
        ← Kembali ke Dashboard
    </a>

</div>