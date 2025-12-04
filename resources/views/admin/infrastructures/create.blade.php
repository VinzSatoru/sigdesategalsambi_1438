@extends('layouts.admin')

@section('title', 'Tambah Infrastruktur Baru')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.infrastructures.store') }}" method="POST" id="infraForm">
            @csrf
            <input type="hidden" name="geometry" id="geometry">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Form Fields -->
                <div class="lg:col-span-1">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama Jalan/Infrastruktur</label>
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required placeholder="Contoh: Jl. Utama Desa">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category">Kategori</label>
                        <select name="category" id="category" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="Jalan">Jalan</option>
                            <option value="Jembatan">Jembatan</option>
                            <option value="Drainase">Drainase</option>
                            <option value="Lampu Jalan">Lampu Jalan</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="condition">Kondisi</label>
                        <select name="condition" id="condition" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="Baik">Baik</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="width">Lebar (Meter)</label>
                        <input type="number" step="0.1" name="width" id="width" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="material">Material</label>
                        <input type="text" name="material" id="material" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Aspal, Beton, Paving...">
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        Simpan Data
                    </button>
                    
                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded text-sm text-yellow-800">
                        <i class="fas fa-info-circle mr-1"></i> <strong>Cara Menggambar:</strong>
                        <ul class="list-disc ml-4 mt-1">
                            <li>Klik peta untuk mulai menggambar garis.</li>
                            <li>Klik lagi untuk menambah titik belokan.</li>
                            <li>Klik tombol <strong>"Selesai Menggambar"</strong> jika sudah pas.</li>
                            <li>Klik <strong>"Hapus Gambar"</strong> untuk ulang.</li>
                        </ul>
                    </div>
                </div>

                <!-- Map Picker -->
                <div class="lg:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Gambar Jalur di Peta</label>
                    <div class="mb-2 flex space-x-2">
                        <button type="button" id="btn-undo" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm disabled:opacity-50 disabled:cursor-not-allowed"><i class="fas fa-undo"></i> Undo</button>
                        <button type="button" id="btn-redo" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm disabled:opacity-50 disabled:cursor-not-allowed"><i class="fas fa-redo"></i> Redo</button>
                        <button type="button" id="btn-finish" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm hidden"><i class="fas fa-check"></i> Selesai</button>
                        <button type="button" id="btn-clear" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm hidden"><i class="fas fa-trash"></i> Reset</button>
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
        
        // Google Satellite Layer
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
        let history = [[]]; // Initial state: empty points
        let historyIndex = 0;
        
        let polyline = null;
        let markers = [];
        let isDrawing = true;

        const btnUndo = document.getElementById('btn-undo');
        const btnRedo = document.getElementById('btn-redo');
        const btnFinish = document.getElementById('btn-finish');
        const btnClear = document.getElementById('btn-clear');
        const inputGeometry = document.getElementById('geometry');

        function updateButtons() {
            btnUndo.disabled = historyIndex === 0;
            btnRedo.disabled = historyIndex === history.length - 1;
            
            if (points.length > 1) {
                btnFinish.classList.remove('hidden');
                btnClear.classList.remove('hidden');
            } else {
                btnFinish.classList.add('hidden');
                if (points.length === 0) btnClear.classList.add('hidden');
                else btnClear.classList.remove('hidden');
            }
        }

        function saveState() {
            // Remove future history if we are in the middle
            if (historyIndex < history.length - 1) {
                history = history.slice(0, historyIndex + 1);
            }
            history.push([...points]); // Deep copy
            historyIndex++;
            updateButtons();
        }

        function redraw() {
            // Clear existing
            if (polyline) map.removeLayer(polyline);
            markers.forEach(m => map.removeLayer(m));
            markers = [];

            // Draw new
            if (points.length > 0) {
                polyline = L.polyline(points, {color: 'blue', weight: 4}).addTo(map);
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

            // Update Input
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
            if(polyline) polyline.setStyle({color: 'green', dashArray: null});
            markers.forEach(m => map.removeLayer(m)); // Remove dots
            alert('Jalur tersimpan! Silakan lengkapi form dan simpan.');
        });

        btnClear.addEventListener('click', () => {
            if(!confirm('Reset gambar?')) return;
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
