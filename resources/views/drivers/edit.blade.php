<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Driver</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 p-8">
   <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-blue-100">
        <div class="mb-6 border-b border-blue-100 pb-4">
            <div class="flex items-center gap-3 mb-2">
                <span class="text-4xl">🚗🏍️</span>
                <h1 class="text-2xl font-bold text-blue-700">Ubah Data Driver</h1>
            </div>
            <p class="text-sm text-gray-500">Perbarui informasi profil driver <strong>{{ $driver->nama }}</strong></p>
        </div>

        <form action="{{ route('drivers.update', $driver->id) }}" method="POST" class="space-y-5" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex flex-col items-center gap-3 pb-4 border-b border-blue-100">
                <div class="relative">
                    <img id="preview-foto"
                         src="{{ $driver->foto_profil ? asset('storage/' . $driver->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($driver->nama) . '&background=3b82f6&color=fff&size=128' }}"
                         class="w-32 h-32 rounded-full object-cover border-4 border-blue-300 shadow cursor-pointer"
                         title="Klik untuk ubah foto">
                    <span class="absolute bottom-1 right-1 bg-blue-600 text-white text-xs rounded-full p-1.5 cursor-pointer"
                          onclick="document.getElementById('foto-actions').classList.toggle('hidden'); document.getElementById('foto-actions').classList.toggle('flex');">
                        ✏️
                    </span>
                </div>
                <p class="text-xs text-gray-400">Klik ✏️ untuk ubah foto dari kamera atau galeri</p>

                <input type="file" id="input-foto" name="foto_profil" accept="image/*" class="hidden">

                <div id="foto-actions" class="hidden flex-col items-center gap-2 w-full max-w-xs">
                    <div class="flex gap-2 w-full">
                        <button type="button" onclick="bukaKamera()"
                                class="flex-1 bg-blue-600 text-white text-xs py-2 px-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                            📷 Kamera
                        </button>
                        <button type="button" onclick="bukaGaleri()"
                                class="flex-1 bg-green-600 text-white text-xs py-2 px-3 rounded-lg font-semibold hover:bg-green-700 transition">
                            🖼️ Galeri
                        </button>
                    </div>
                    <button type="button" id="btn-jadikan-profil" onclick="jadikanProfil()"
                            class="hidden w-full bg-emerald-500 text-white text-xs py-2 px-3 rounded-lg font-semibold hover:bg-emerald-600 transition">
                        ✅ Jadikan Foto Profil
                    </button>
                    <button type="button" onclick="batalFoto()"
                            class="text-xs text-gray-400 hover:text-red-500 transition">
                        Batal
                    </button>
                </div>
                <p id="nama-file-terpilih" class="text-xs text-emerald-600 hidden"></p>
            </div>

           <div>
                <label class="block text-sm font-semibold text-blue-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', $driver->nama) }}" required 
                       class="w-full border border-blue-200 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 opacity-70">
                <div>
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Alamat Email</label>
                    <input type="text" value="{{ $driver->email }}" readonly 
                           class="w-full bg-blue-50 border border-blue-200 p-2.5 rounded-lg cursor-not-allowed text-gray-600">
                </div>
                <div class="opacity-100">
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Nomor Telepon</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon', $driver->no_telepon) }}" required
                           class="w-full border border-blue-200 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-blue-700 mb-1">Alamat Domisili Sekarang</label>
                <textarea name="alamat" required rows="3"
                          class="w-full border border-blue-200 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">{{ old('alamat', $driver->alamat) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Jenis Layanan</label>
                    <select name="jenis_kendaraan" required
                            class="w-full border border-blue-200 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition bg-white">
                        <option value="GoRide" {{ old('jenis_kendaraan', $driver->jenis_kendaraan) == 'GoRide' ? 'selected' : '' }}>🏍️ GoRide (Sepeda Motor)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Plate Nomor</label>
                    <input type="text" name="plate_nomor" value="{{ old('plate_nomor', $driver->plate_nomor) }}" required
                           class="w-full border border-blue-200 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition uppercase">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-blue-100">
                <a href="{{ route('drivers.show', $driver->id) }}" class="bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg font-medium hover:bg-gray-300 transition text-sm">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition text-sm shadow">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    {{-- TAMBAHAN: MODAL KAMERA (WebRTC) --}}
    <div id="modal-kamera" class="hidden fixed inset-0 bg-black bg-opacity-70 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl p-5 w-full max-w-md shadow-xl mx-4">
            <h2 class="text-blue-700 font-bold text-center mb-3">📷 Ambil Foto</h2>
            <video id="video-kamera" autoplay playsinline class="w-full rounded-xl border-2 border-blue-300 mb-3" style="max-height:300px;"></video>
            <canvas id="canvas-kamera" class="hidden"></canvas>
            <div class="flex gap-3">
                <button type="button" onclick="ambilFoto()" class="flex-1 bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">📸 Foto Sekarang</button>
                <button type="button" onclick="tutupKamera()" class="flex-1 bg-gray-200 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">Batal</button>
            </div>
        </div>
    </div>

    {{-- TAMBAHAN: SCRIPT KAMERA --}}
    <script>
        const inputFoto = document.getElementById('input-foto');
        const previewFoto = document.getElementById('preview-foto');
        const fotoActions = document.getElementById('foto-actions');
        const btnJadikanProfil = document.getElementById('btn-jadikan-profil');
        const namaFileTerpilih = document.getElementById('nama-file-terpilih');
        const modalKamera = document.getElementById('modal-kamera');
        const videoKamera = document.getElementById('video-kamera');
        const canvasKamera = document.getElementById('canvas-kamera');
        const fotoAwal = previewFoto.src;
        let streamKamera = null;

        function bukaKamera() {
            modalKamera.classList.remove('hidden');
            navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' }, audio: false })
                .then(function(stream) {
                    streamKamera = stream;
                    videoKamera.srcObject = stream;
                })
                .catch(function(err) {
                    alert('Kamera tidak bisa diakses: ' + err.message);
                    tutupKamera();
                });
        }

        function ambilFoto() {
            canvasKamera.width = videoKamera.videoWidth;
            canvasKamera.height = videoKamera.videoHeight;
            canvasKamera.getContext('2d').drawImage(videoKamera, 0, 0);
            canvasKamera.toBlob(function(blob) {
                const file = new File([blob], 'foto-kamera.jpg', { type: 'image/jpeg' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                inputFoto.files = dataTransfer.files;
                previewFoto.src = canvasKamera.toDataURL('image/jpeg');
                btnJadikanProfil.classList.remove('hidden');
                namaFileTerpilih.textContent = '📎 foto-kamera.jpg';
                namaFileTerpilih.classList.remove('hidden');
                tutupKamera();
            }, 'image/jpeg', 0.9);
        }

        function tutupKamera() {
            if (streamKamera) {
                streamKamera.getTracks().forEach(track => track.stop());
                streamKamera = null;
            }
            modalKamera.classList.add('hidden');
        }

        function bukaGaleri() {
            inputFoto.removeAttribute('capture');
            inputFoto.click();
        }

        inputFoto.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewFoto.src = e.target.result;
                    btnJadikanProfil.classList.remove('hidden');
                    namaFileTerpilih.textContent = '📎 ' + inputFoto.files[0].name;
                    namaFileTerpilih.classList.remove('hidden');
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        function jadikanProfil() {
            fotoActions.classList.add('hidden');
            fotoActions.classList.remove('flex');
            btnJadikanProfil.classList.add('hidden');
            alert('✅ Foto baru dipilih! Klik "Simpan Perubahan" untuk menyimpan.');
        }

        function batalFoto() {
            inputFoto.value = '';
            previewFoto.src = fotoAwal;
            fotoActions.classList.add('hidden');
            fotoActions.classList.remove('flex');
            btnJadikanProfil.classList.add('hidden');
            namaFileTerpilih.classList.add('hidden');
        }
    </script>
</body>
</html>