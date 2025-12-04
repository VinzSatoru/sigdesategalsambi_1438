@extends('layouts.admin')

@section('title', 'Edit POI')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.pois.update', $poi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Nama Fasilitas</label>
                        <input type="text" name="name" id="name" value="{{ $poi->name }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                    </div>
                    <div class="mb-4">
                        <label for="category" class="block text-gray-700 font-bold mb-2">Kategori</label>
                        <select name="category" id="category" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="Pemerintahan" {{ $poi->category == 'Pemerintahan' ? 'selected' : '' }}>Pemerintahan</option>
                            <option value="Pendidikan" {{ $poi->category == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                            <option value="Kesehatan" {{ $poi->category == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                            <option value="Tempat Ibadah" {{ $poi->category == 'Tempat Ibadah' ? 'selected' : '' }}>Tempat Ibadah</option>
                            <option value="Fasilitas Umum" {{ $poi->category == 'Fasilitas Umum' ? 'selected' : '' }}>Fasilitas Umum</option>
                            <option value="Lainnya" {{ $poi->category == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-bold mb-2">Foto (Opsional)</label>
                        @if($poi->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $poi->image) }}" alt="Current Image" class="h-32 w-auto rounded-lg shadow-sm">
                            </div>
                        @endif
                        <input type="file" name="image" id="image" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto.</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="latitude">Latitude</label>
                            <input type="text" name="latitude" id="latitude" value="{{ $poi->lat }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100" readonly required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="longitude">Longitude</label>
                            <input type="text" name="longitude" id="longitude" value="{{ $poi->lng }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100" readonly required>
                        </div>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Update Data
                    </button>
                </div>

                <!-- Map Picker -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Lokasi di Peta</label>
                    <div id="map-picker" style="height: 400px; width: 100%; border-radius: 0.5rem;"></div>
                    <p class="text-xs text-gray-500 mt-2">Klik pada peta untuk mengubah lokasi.</p>
                </div>
            </div>
        </form>
    </div>

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Initialize Map
        const lat = {{ $poi->lat }};
        const lng = {{ $poi->lng }};
        const map = L.map('map-picker').setView([lat, lng], 15);
        
        L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; Google Maps'
        }).addTo(map);

        let marker = L.marker([lat, lng]).addTo(map);

        // Map Click Event
        map.on('click', function(e) {
            const newLat = e.latlng.lat;
            const newLng = e.latlng.lng;

            // Update Inputs
            document.getElementById('latitude').value = newLat;
            document.getElementById('longitude').value = newLng;

            // Update Marker
            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }
        });
    </script>
@endsection
