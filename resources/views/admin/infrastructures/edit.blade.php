@extends('layouts.admin')

@section('title', 'Edit Infrastruktur')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.infrastructures.update', $infrastructure->id) }}" method="POST" id="infraForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="geometry" id="geometry">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Form Fields -->
                <div class="lg:col-span-1">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama Jalan/Infrastruktur</label>
                        <input type="text" name="name" id="name" value="{{ $infrastructure->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category">Kategori</label>
                        <select name="category" id="category" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="Jalan" {{ $infrastructure->category == 'Jalan' ? 'selected' : '' }}>Jalan</option>
                            <option value="Jembatan" {{ $infrastructure->category == 'Jembatan' ? 'selected' : '' }}>Jembatan</option>
                            <option value="Drainase" {{ $infrastructure->category == 'Drainase' ? 'selected' : '' }}>Drainase</option>
                            <option value="Lampu Jalan" {{ $infrastructure->category == 'Lampu Jalan' ? 'selected' : '' }}>Lampu Jalan</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="condition">Kondisi</label>
                        <select name="condition" id="condition" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="Baik" {{ $infrastructure->condition == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Sedang" {{ $infrastructure->condition == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="Rusak" {{ $infrastructure->condition == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                            <option value="Rusak Berat" {{ $infrastructure->condition == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                    </div>

                    @php $attrs = json_decode($infrastructure->attributes ?? '{}'); @endphp

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="width">Lebar (Meter)</label>
                        <input type="number" step="0.1" name="width" id="width" value="{{ $attrs->width ?? '' }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="material">Material</label>
                        <input type="text" name="material" id="material" value="{{ $attrs->material ?? '' }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        Update Data
                    </button>
                    
                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded text-sm text-yellow-800">
                        <i class="fas fa-info-circle mr-1"></i> <strong>Edit Jalur:</strong>
                        <p>Klik tombol "Hapus & Gambar Ulang" jika ingin mengubah jalur peta.</p>
                    </div>
                </div>

                <!-- Map Picker -->
                <div class="lg:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Jalur Peta</label>
                    <div class="mb-2 flex space-x-2">
                        <button type="button" id="btn-undo" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm disabled:opacity-50 disabled:cursor-not-allowed"><i class="fas fa-undo"></i> Undo</button>
                        <button type="button" id="btn-redo" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm disabled:opacity-50 disabled:cursor-not-allowed"><i class="fas fa-redo"></i> Redo</button>
                        <button type="button" id="btn-finish" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm hidden"><i class="fas fa-check"></i> Selesai</button>
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
        let history = [[]];
        let historyIndex = 0;
        
        let polyline = null;
        let markers = [];
        let isDrawing = false;

        const btnUndo = document.getElementById('btn-undo');
        const btnRedo = document.getElementById('btn-redo');
        const btnFinish = document.getElementById('btn-finish');
        const btnClear = document.getElementById('btn-clear');
        const inputGeometry = document.getElementById('geometry');

        // Load Existing Geometry
        const existingGeoJSON = {!! $infrastructure->geometry !!};
        if (existingGeoJSON) {
            // GeoJSON coordinates are [lng, lat], Leaflet needs [lat, lng]
            const latlngs = existingGeoJSON.coordinates.map(c => L.latLng(c[1], c[0]));
            
            // Initialize state with existing data
            points = latlngs;
            history = [ [...points] ];
            historyIndex = 0;
            
            polyline = L.polyline(points, {color: 'green', weight: 4}).addTo(map);
            map.fitBounds(polyline.getBounds());
        }

        function updateButtons() {
            btnUndo.disabled = historyIndex === 0;
            btnRedo.disabled = historyIndex === history.length - 1;
            
            if (isDrawing && points.length > 1) {
                btnFinish.classList.remove('hidden');
            } else {
                btnFinish.classList.add('hidden');
            }
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
            if (polyline) map.removeLayer(polyline);
            markers.forEach(m => map.removeLayer(m));
            markers = [];

            if (points.length > 0) {
                const color = isDrawing ? 'blue' : 'green';
                polyline = L.polyline(points, {color: color, weight: 4}).addTo(map);
                
                if (isDrawing) {
                    points.forEach(p => {
                        const marker = L.circleMarker(p, {
                            radius: 5,
                            color: 'red',
                            fillColor: '#f03',
                            fillOpacity: 0.5
                        }).addTo(map);
                        markers.push(marker);
                    });
                }
            }

            if (points.length > 1) {
                const geojson = {
                    type: "LineString",
                    coordinates: points.map(p => [p.lng, p.lat])
                };
                inputGeometry.value = JSON.stringify(geojson);
            } else {
                inputGeometry.value = '';
            }
            
            updateButtons();
        }

        map.on('click', function(e) {
            if (!isDrawing) return;
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

        btnRedo.addEventListener('click', () => {
            if (historyIndex < history.length - 1) {
                historyIndex++;
                points = [...history[historyIndex]];
                redraw();
            }
        });

        btnFinish.addEventListener('click', () => {
            isDrawing = false;
            btnFinish.classList.add('hidden');
            btnUndo.classList.add('hidden');
            btnRedo.classList.add('hidden');
            redraw(); // Will redraw green without markers
            alert('Jalur baru tersimpan!');
        });

        btnClear.addEventListener('click', () => {
            if(!confirm('Hapus jalur yang ada dan gambar ulang?')) return;
            
            points = [];
            history = [[]];
            historyIndex = 0;
            isDrawing = true;
            
            btnUndo.classList.remove('hidden');
            btnRedo.classList.remove('hidden');
            redraw();
        });
        
        updateButtons();
    </script>
@endsection
