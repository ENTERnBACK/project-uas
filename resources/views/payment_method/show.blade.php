<div style="max-width: 500px; margin: 40px auto; padding: 20px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); font-family: sans-serif;">
    <h2 style="text-align: center; color: #333;">Konfirmasi Pembayaran</h2>
    <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

    <p style="color: #666; font-size: 0.9em;">Metode yang Anda pilih:</p>
    <div style="background: #f8f9fa; padding: 10px; border-radius: 8px; font-weight: bold; margin-bottom: 20px;">
        {{ strtoupper($payment->method) }}
    </div>

    {{-- LOGIKA TAMPILAN --}}
    @if($payment->method == 'cash')
        <div style="text-align: center; padding: 20px;">
            <p>Silakan siapkan uang tunai saat kedatangan.</p>
        </div>

    @elseif($payment->method == 'qris')
        <div style="text-align: center;">
            <p>Silakan Scan QRIS Berikut:</p>
            <img src="{{ asset('images/qris.png') }}" alt="QRIS" style="width: 250px; border-radius: 10px; border: 2px solid #eee;">
        </div>
    
    @elseif($payment->method == 'bca')
        <p>Nomor Virtual Account:</p>
        <div style="background: #eef7ff; padding: 20px; border-radius: 10px; border: 1px solid #007bff; text-align: center;">
            <h2 id="vaNumber" style="color: #007bff; margin: 0;">88081311712330{{ $payment->trip_id }}</h2>
            <button onclick="copyVA()" style="margin-top: 15px; cursor: pointer; background: #007bff; color: white; border: none; padding: 8px 15px; border-radius: 5px;">Copy Nomor</button>
        </div>
    @endif

    <div style="margin-top: 30px; text-align: center;">
        <a href="{{ route('dashboard') }}" style="text-decoration: none; color: #666; font-size: 0.9em;">Kembali ke Dashboard</a>
    </div>
</div>

<script>
function copyVA() {
    var va = document.getElementById("vaNumber").innerText;
    navigator.clipboard.writeText(va).then(() => {
        alert("Nomor VA berhasil disalin!");
    });
}
</script>