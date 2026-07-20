@extends('admin.layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Edit Info Pernikahan</h1>
        <p class="text-sm text-slate-500 mt-1">Perbarui data detail dasar acara pernikahan Anda</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-lg shadow-sm" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-rose-500"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-semibold text-rose-800">Terdapat beberapa kesalahan:</h3>
                    <ul class="mt-2 list-disc list-inside text-sm text-rose-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="max-w-4xl bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-900">Form Informasi Acara</h3>
        </div>
        <div class="p-6">
            <form action="{{ route('info.update', $info->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Pengantin Pria<span class="text-rose-500">*</span></label>
                            <input type="text" name="nama_pengantin_pria" value="{{ old('nama_pengantin_pria', $info->nama_pengantin_pria) }}" required
                                   class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Pengantin Wanita<span class="text-rose-500">*</span></label>
                            <input type="text" name="nama_pengantin_istri" value="{{ old('nama_pengantin_istri', $info->nama_pengantin_istri) }}" required
                                   class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Pernikahan<span class="text-rose-500">*</span></label>
                            <input type="date" name="tanggal_pernikahan" value="{{ old('tanggal_pernikahan', $info->tanggal_pernikahan) }}" required
                                   class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Alamat Acara<span class="text-rose-500">*</span></label>
                            <textarea id="alamat" name="alamat" rows="2" required
                                      class="block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">{{ old('alamat', $info->alamat) }}</textarea>
                            <button type="button" id="cariLokasi" 
                                    class="mt-2 inline-flex items-center justify-center gap-1.5 px-3 py-1.5 border border-transparent rounded-lg text-xs font-semibold text-white bg-indigo-600 hover:bg-indigo-700 transition-colors shadow-sm">
                                <i class="fas fa-search"></i> Cari Koordinat Peta
                            </button>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-1">Latitude</label>
                                <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $info->latitude) }}" readonly
                                       class="block w-full px-3 py-2 border border-slate-100 bg-slate-50 text-slate-500 rounded-lg font-mono sm:text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-1">Longitude</label>
                                <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $info->longitude) }}" readonly
                                       class="block w-full px-3 py-2 border border-slate-100 bg-slate-50 text-slate-500 rounded-lg font-mono sm:text-xs">
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Mulai Akad<span class="text-rose-500">*</span></label>
                                <input type="time" name="mulai_akad" value="{{ old('mulai_akad', $info->mulai_akad) }}" required
                                       class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Selesai Akad<span class="text-rose-500">*</span></label>
                                <input type="time" name="selesai_akad" value="{{ old('selesai_akad', $info->selesai_akad) }}" required
                                       class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Mulai Resepsi<span class="text-rose-500">*</span></label>
                            <input type="time" name="mulai_resepsi" value="{{ old('mulai_resepsi', $info->mulai_resepsi) }}" required
                                   class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi / Catatan Acara:</label>
                            <textarea name="deskripsi" rows="3" placeholder="Masukkan keterangan tambahan..."
                                      class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">{{ old('deskripsi', $info->deskripsi) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Google Map Preview -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Preview Peta Lokasi (Geser marker merah untuk menyesuaikan koordinat):</label>
                    <div id="map" class="h-80 w-full rounded-xl border border-slate-200 shadow-inner overflow-hidden"></div>
                </div>

                <div class="border-t border-slate-100 pt-6 flex flex-col sm:flex-row justify-between gap-4">
                    <a href="{{ route('info.index') }}" 
                       class="inline-flex justify-center items-center gap-1.5 px-4 py-2 border border-slate-200 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex justify-center items-center gap-1.5 px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i class="fas fa-save"></i> Perbarui Info
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
{{-- Leaflet.js CSS: GRATIS, tanpa API key --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const defaultLat = parseFloat(document.getElementById('latitude').value) || -6.200000;
        const defaultLng = parseFloat(document.getElementById('longitude').value) || 106.816666;

        // Init Leaflet Map
        const map = L.map('map').setView([defaultLat, defaultLng], 15);

        // OpenStreetMap tiles (100% gratis)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19
        }).addTo(map);

        // Draggable Marker - posisi awal dari data tersimpan
        const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

        // Tampilkan popup koordinat saat halaman dimuat (jika sudah ada koordinat)
        if (document.getElementById('latitude').value) {
            marker.bindPopup('<b>Lokasi tersimpan</b><br>Seret marker untuk mengubah.').openPopup();
        }

        // Update koordinat saat marker digeser
        marker.on('dragend', function (e) {
            const { lat, lng } = e.target.getLatLng();
            setLatLng(lat, lng);
        });

        // Update koordinat saat klik peta
        map.on('click', function (e) {
            const { lat, lng } = e.latlng;
            marker.setLatLng([lat, lng]);
            setLatLng(lat, lng);
        });

        function setLatLng(lat, lng) {
            document.getElementById('latitude').value = lat.toFixed(6);
            document.getElementById('longitude').value = lng.toFixed(6);
        }

        // Geocoding via Nominatim (OpenStreetMap) - GRATIS, tanpa API key
        document.getElementById('cariLokasi').addEventListener('click', function () {
            const alamat = document.getElementById('alamat').value.trim();
            if (!alamat) {
                alert('Masukkan alamat terlebih dahulu.');
                return;
            }

            const btn = this;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mencari...';

            const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(alamat)}&limit=1&countrycodes=id`;

            fetch(url, { headers: { 'Accept-Language': 'id' } })
                .then(res => res.json())
                .then(data => {
                    if (data.length > 0) {
                        const lat = parseFloat(data[0].lat);
                        const lng = parseFloat(data[0].lon);
                        map.setView([lat, lng], 16);
                        marker.setLatLng([lat, lng]);
                        setLatLng(lat, lng);
                        marker.bindPopup(`<b>${data[0].display_name}</b>`).openPopup();
                    } else {
                        alert('Alamat tidak ditemukan. Coba masukkan nama jalan, kota, atau kecamatan yang lebih spesifik.');
                    }
                })
                .catch(() => alert('Gagal terhubung ke layanan peta. Periksa koneksi internet Anda.'))
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-search"></i> Cari Koordinat Peta';
                });
        });
    });
</script>
@endpush
