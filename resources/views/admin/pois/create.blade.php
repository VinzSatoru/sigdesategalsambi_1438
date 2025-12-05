@extends('layouts.admin')

@section('title', 'Tambah POI Baru')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.pois.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Form Fields -->
                <div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama Fasilitas</label>
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category">Kategori</label>
                        <select name="category" id="category" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="Pemerintahan">Pemerintahan</option>
                            <option value="Pendidikan">Pendidikan</option>
                            <option value="Kesehatan">Kesehatan</option>
                            <option value="Tempat Ibadah">Tempat Ibadah</option>
                            <option value="Tempat Wisata">Tempat Wisata</option>
                            <option value="Fasilitas Umum">Fasilitas Umum</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-bold mb-2">Foto (Opsional)</label>
                        <input type="file" name="image" id="image" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks: 2MB.</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="latitude">Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100" readonly required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="longitude">Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100" readonly required>
                        </div>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan Data
                    </button>
                </div>

                <!-- Map Picker -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Lokasi di Peta</label>
                    <div id="map-picker" style="height: 400px; width: 100%; border-radius: 0.5rem;"></div>
                    <p class="text-xs text-gray-500 mt-2">Klik pada peta untuk menandai lokasi.</p>
                </div>
            </div>
        </form>
    </div>

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Initialize Map
        const map = L.map('map-picker').setView([-6.619, 110.675], 15);
        L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; Google Maps'
        }).addTo(map);

        let marker;

        // Map Click Event
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            // Update Inputs
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // Update Marker
            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }
        });
    </script>
@endsection
