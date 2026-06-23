</div>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Driver Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 p-8">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-blue-100">
        
        <div class="mb-6 border-b border-blue-100 pb-4">
            <div class="flex items-center gap-3 mb-2">
                <span class="text-4xl">🚗🏍️</span>
                <h1 class="text-2xl font-bold text-blue-700">Profile Driver</h1>
            </div>
            <p class="text-sm text-gray-500">Masukkan informasi lengkap calon driver untuk disimpan ke dalam pangkalan data</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded-lg text-sm mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded-lg text-sm mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="/drivers" method="POST" class="space-y-5" enctype="multipart/form-data">
            @csrf

            {{-- Section Foto Profil --}}
            <div class="flex flex-col items-center gap-3 pb-4 border-b border-blue-100">
                <div class="relative">
                    {{-- Fallback inisial nama, tidak butuh internet --}}
                    <div id="avatar-inisial"
                         class="w-32 h-32 rounded-full border-4 border-blue-300 shadow bg-blue-500 flex items-center justify-center">
                        <span class="text-white text-4xl font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </span>
                    </div>
                    <img id="preview-foto" src="" alt=""
                         class="w-32 h-32 rounded-full object-cover border-4 border-blue-300 shadow cursor-pointer hidden absolute top-0 left-0">
                    <span class="absolute bottom-1 right-1 bg-blue-600 text-white text-xs rounded-full p-1.5 cursor-pointer z-10"
                          onclick="toggleFotoActions()">✏️</span>
                </div>
                <p class="text-xs text-gray-400">Klik ✏️ untuk pilih foto dari kamera atau galeri</p>

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

            {{-- Nama: hidden untuk POST, readonly untuk tampilan --}}
            <div>
                <label class="block text-sm font-semibold text-blue-700 mb-1">Nama Lengkap</label>
                <input type="hidden" name="nama" value="{{ auth()->user()->name }}">
                <input type="text" value="{{ auth()->user()->name }}" readonly
                       class="w-full bg-blue-50 border border-blue-200 p-2.5 rounded-lg cursor-not-allowed focus:outline-none text-gray-600">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Alamat Email</label>
                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                    <input type="text" value="{{ auth()->user()->email }}" readonly
                           class="w-full bg-blue-50 border border-blue-200 p-2.5 rounded-lg cursor-not-allowed focus:outline-none text-gray-600">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Nomor Telepon</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" required placeholder="Contoh: 081234567XXX" 
                           class="w-full border border-blue-200 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-blue-700 mb-1">Alamat Domisili Sekarang</label>
                <textarea name="alamat" required rows="3" placeholder="Tuliskan alamat lengkap beserta kota asal" 
                          class="w-full border border-blue-200 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('alamat') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Jenis Layanan Gojek</label>
                    <select name="jenis_kendaraan" required 
                            class="w-full border border-blue-200 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white">
                        <option value="GoRide" {{ old('jenis_kendaraan') == 'GoRide' ? 'selected' : '' }}>🏍️ GoRide (Sepeda Motor)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Nomor Registrasi Kendaraan (Plate Nomor)</label>
                    <input type="text" name="plate_nomor" value="{{ old('plate_nomor') }}" required placeholder="Contoh: B 1234 ABC" 
                           class="w-full border border-blue-200 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition uppercase">
                </div>
            </div>
            <div class="flex justify-between gap-3 pt-4 border-t border-blue-100">
                <a href="{{ route('dashboard.driver') }}" class="bg-gray-500 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-gray-600 transition text-sm">
                    ← Kembali ke Dashboard
                </a>
                <div class="flex gap-3">
                    <a href="/drivers" class="bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg font-medium hover:bg-gray-300 transition text-sm">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition text-sm shadow">
                        Simpan Data Driver
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Modal Kamera WebRTC --}}
    <div id="modal-kamera" class="hidden fixed inset-0 bg-black bg-opacity-70 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl p-5 w-full max-w-md shadow-xl mx-4">
            <h2 class="text-blue-700 font-bold text-center mb-3">📷 Ambil Foto</h2>
            <video id="video-kamera" autoplay playsinline
                   class="w-full rounded-xl border-2 border-blue-300 mb-3" style="max-height:300px;"></video>
            <canvas id="canvas-kamera" class="hidden"></canvas>
            <div class="flex gap-3">
                <button type="button" onclick="ambilFoto()"
                        class="flex-1 bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                    📸 Foto Sekarang
                </button>
                <button type="button" onclick="tutupKamera()"
                        class="flex-1 bg-gray-200 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">
                    Batal
                </button>
            </div>
        </div>
    </div>

    <script>
        const inputFoto = document.getElementById('input-foto');
        const previewFoto = document.getElementById('preview-foto');
        const avatarInisial = document.getElementById('avatar-inisial');
        const fotoActions = document.getElementById('foto-actions');
        const btnJadikanProfil = document.getElementById('btn-jadikan-profil');
        const namaFileTerpilih = document.getElementById('nama-file-terpilih');
        const modalKamera = document.getElementById('modal-kamera');
        const videoKamera = document.getElementById('video-kamera');
        const canvasKamera = document.getElementById('canvas-kamera');
        let streamKamera = null;

        function toggleFotoActions() {
            fotoActions.classList.toggle('hidden');
            fotoActions.classList.toggle('flex');
        }
       
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

                // Tampilkan preview, sembunyikan inisial
                previewFoto.src = canvasKamera.toDataURL('image/jpeg');
                previewFoto.classList.remove('hidden');
                avatarInisial.classList.add('hidden');

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
                    // Tampilkan preview, sembunyikan inisial
                    previewFoto.src = e.target.result;
                    previewFoto.classList.remove('hidden');
                    avatarInisial.classList.add('hidden');

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
            alert('✅ Foto profil berhasil dipilih! Klik "Simpan Data Driver" untuk menyimpan.');
        }

        function batalFoto() {
            inputFoto.value = '';
            previewFoto.src = '';
            previewFoto.classList.add('hidden');
            avatarInisial.classList.remove('hidden');
            fotoActions.classList.add('hidden');
            fotoActions.classList.remove('flex');
            btnJadikanProfil.classList.add('hidden');
            namaFileTerpilih.classList.add('hidden');
        }
    </script>

</body>
</html>
</div>