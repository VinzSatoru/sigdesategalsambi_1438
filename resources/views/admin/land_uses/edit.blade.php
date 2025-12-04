@extends('layouts.admin')

@section('title', 'Edit Area Penggunaan Lahan')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.land-uses.update', $landUse->id) }}" method="POST" id="landUseForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="geometry" id="geometry">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Form Fields -->
                <div class="lg:col-span-1">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama Area/Blok</label>
                        <input type="text" name="name" id="name" value="{{ $landUse->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category">Kategori</label>
                        <select name="category" id="category" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="Sawah" {{ $landUse->category == 'Sawah' ? 'selected' : '' }}>Sawah</option>
                            <option value="Pemukiman" {{ $landUse->category == 'Pemukiman' ? 'selected' : '' }}>Pemukiman</option>
                            <option value="Kebun" {{ $landUse->category == 'Kebun' ? 'selected' : '' }}>Kebun</option>
                            <option value="Fasilitas Umum" {{ $landUse->category == 'Fasilitas Umum' ? 'selected' : '' }}>Fasilitas Umum</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="area_sqm">Luas (m²)</label>
                        <input type="number" step="0.01" name="area_sqm" id="area_sqm" value="{{ $landUse->area_sqm }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
                    </div>

                    @php $attrs = json_decode($landUse->attributes ?? '{}'); @endphp

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Deskripsi</label>
                        <textarea name="description" id="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $attrs->description ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        Update Data
                    </button>
                    
                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded text-sm text-yellow-800">
                        <i class="fas fa-info-circle mr-1"></i> <strong>Edit Area:</strong>
                        <p>Klik "Reset" untuk menggambar ulang area jika diperlukan.</p>
                    </div>
                </div>

                <!-- Map Picker -->
                <div class="lg:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Gambar Area di Peta</label>
                    <div class="mb-2 flex space-x-2">
                        <button type="button" id="btn-undo" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm disabled:opacity-50 disabled:cursor-not-allowed"><i class="fas fa-undo"></i> Undo</button>
                        <button type="button" id="btn-clear" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"><i class="fas fa-trash"></i> Reset</button>
                    </div>
                    <div id="map-picker" style="height: 500px; width: 100%; border-radius: 0.5rem; border: 2px solid #e2e8f0;"></div>
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
        
        L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; Google Maps'
        }).addTo(map);

        // Show Village Boundary
        @if(isset($villageBoundary) && $villageBoundary->geometry)
            const villageGeoJSON = {!! $villageBoundary->geometry !!};
            L.geoJSON(villageGeoJSON, {
                style: {
                    color: '#ff7800',
                    weight: 2,
                    opacity: 0.6,
                    dashArray: '5, 10',
                    fillOpacity: 0
                }
            }).addTo(map);
        @endif

        let points = [];
        let polygon = null;
        let markers = [];
        
        let history = [[]];
        let historyIndex = 0;

        const btnUndo = document.getElementById('btn-undo');
        const btnClear = document.getElementById('btn-clear');
        const inputGeometry = document.getElementById('geometry');
        const inputArea = document.getElementById('area_sqm');

        // Load Existing Geometry
        const existingGeoJSON = {!! $landUse->geometry !!};
        if (existingGeoJSON) {
            // GeoJSON Polygon coordinates: [ [ [lng, lat], ... ] ]
            // We need the first ring
            const coords = existingGeoJSON.coordinates[0];
            // Remove the last closing point for editing logic
            if (coords.length > 0 && coords[0][0] === coords[coords.length-1][0] && coords[0][1] === coords[coords.length-1][1]) {
                coords.pop();
            }
            
            points = coords.map(c => L.latLng(c[1], c[0]));
            history = [[...points]];
            historyIndex = 0;
            
            // Initial Draw
            polygon = L.polygon(points, {color: 'purple', fillColor: '#a855f7', fillOpacity: 0.4}).addTo(map);
            map.fitBounds(polygon.getBounds());
        }

        function calculateArea(coords) {
            let area = 0;
            const R = 6378137;
            if (coords.length > 2) {
                for (let i = 0; i < coords.length; i++) {
                    const p1 = coords[i];
                    const p2 = coords[(i + 1) % coords.length];
                    const x1 = (p1.lng * Math.PI) / 180;
                    const y1 = (p1.lat * Math.PI) / 180;
                    const x2 = (p2.lng * Math.PI) / 180;
                    const y2 = (p2.lat * Math.PI) / 180;
                    area += (x2 - x1) * (2 + Math.sin(y1) + Math.sin(y2));
                }
                area = Math.abs(area * R * R / 2);
            }
            return area;
        }

        function updateButtons() {
            btnUndo.disabled = historyIndex === 0;
            if (points.length > 0) btnClear.classList.remove('hidden');
            else btnClear.classList.add('hidden');
        }

        function saveState() {
            if (historyIndex < history.length - 1) {
                history = history.slice(0, historyIndex + 1);
            }
            history.push([...points]);
            historyIndex++;
            updateButtons();
        }

        function redraw() {
            if (polygon) map.removeLayer(polygon);
            markers.forEach(m => map.removeLayer(m));
            markers = [];

            if (points.length > 0) {
                polygon = L.polygon(points, {color: 'purple', fillColor: '#a855f7', fillOpacity: 0.4}).addTo(map);
                
                points.forEach(p => {
                    const marker = L.circleMarker(p, {
                        radius: 5,
                        color: 'white',
                        fillColor: 'purple',
                        fillOpacity: 1
                    }).addTo(map);
                    markers.push(marker);
                });

                if (points.length > 2) {
                    const area = calculateArea(points);
                    inputArea.value = area.toFixed(2);
                    
                    const coords = points.map(p => [p.lng, p.lat]);
                    coords.push([points[0].lng, points[0].lat]);
                    
                    const geojson = {
                        type: "Polygon",
                        coordinates: [coords]
                    };
                    inputGeometry.value = JSON.stringify(geojson);
                } else {
                    inputArea.value = '';
                    inputGeometry.value = '';
                }
            } else {
                inputArea.value = '';
                inputGeometry.value = '';
            }
            updateButtons();
        }

        map.on('click', function(e) {
            points.push(e.latlng);
            saveState();
            redraw();
        });

        btnUndo.addEventListener('click', () => {
            if (historyIndex > 0) {
                historyIndex--;
                points = [...history[historyIndex]];
                redraw();
            }
        });

        btnClear.addEventListener('click', () => {
            if(!confirm('Reset gambar area?')) return;
            points = [];
            history = [[]];
            historyIndex = 0;
            redraw();
        });

        updateButtons();
    </script>
@endsection
