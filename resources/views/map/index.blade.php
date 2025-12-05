@extends('layouts.app')

@section('content')
    <div class="sidebar">
        <div class="sidebar-content">
            <div class="mb-6">
                <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Tipe Peta</h3>
                <div class="grid grid-cols-2 gap-3">
                    <label class="cursor-pointer relative">
                        <input type="radio" name="basemap" value="roadmap" checked class="peer sr-only">
                        <div class="p-3 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:text-blue-700 transition-all text-center">
                            <i class="fas fa-map text-xl mb-1 block text-gray-400 peer-checked:text-blue-500"></i>
                            <span class="text-xs font-bold">Google Jalan</span>
                        </div>
                    </label>
                    <label class="cursor-pointer relative">
                        <input type="radio" name="basemap" value="satellite" class="peer sr-only">
                        <div class="p-3 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:text-blue-700 transition-all text-center">
                            <i class="fas fa-satellite text-xl mb-1 block text-gray-400 peer-checked:text-blue-500"></i>
                            <span class="text-xs font-bold">Google Satelit</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Layer Peta</h3>
                
                <div class="layer-control">
                    <div class="layer-item">
                        <label for="toggle-boundaries" class="text-gray-700 text-sm font-medium flex-1">Batas Desa</label>
                        <label class="toggle-switch">
                            <input type="checkbox" id="toggle-boundaries" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <!-- ... other layers ... -->
                    <div class="layer-item">
                        <label for="toggle-pois" class="text-gray-700 text-sm font-medium flex-1">Fasilitas (POI)</label>
                        <label class="toggle-switch">
                            <input type="checkbox" id="toggle-pois" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="layer-item">
                        <label for="toggle-infrastructures" class="text-gray-700 text-sm font-medium flex-1">Jalan & Jembatan</label>
                        <label class="toggle-switch">
                            <input type="checkbox" id="toggle-infrastructures" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="layer-item">
                        <label for="toggle-land-uses" class="text-gray-700 text-sm font-medium flex-1">Penggunaan Lahan</label>
                        <label class="toggle-switch">
                            <input type="checkbox" id="toggle-land-uses" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Legend -->
            <div class="mb-6">
                <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Legenda</h3>
                <div class="bg-white/50 rounded-xl p-4 border border-white/60">
                    <div class="grid grid-cols-1 gap-3 text-sm">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center mr-3 shadow-sm text-white"><i class="fas fa-school text-xs"></i></div>
                            <span class="font-medium text-gray-700">Pendidikan</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center mr-3 shadow-sm text-white"><i class="fas fa-mosque text-xs"></i></div>
                            <span class="font-medium text-gray-700">Tempat Ibadah</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center mr-3 shadow-sm text-white"><i class="fas fa-landmark text-xs"></i></div>
                            <span class="font-medium text-gray-700">Pemerintahan</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center mr-3 shadow-sm text-white"><i class="fas fa-map-marker-alt text-xs"></i></div>
                            <span class="font-medium text-gray-700">Fasilitas Umum</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center mr-3 shadow-sm text-white"><i class="fas fa-camera text-xs"></i></div>
                            <span class="font-medium text-gray-700">Tempat Wisata</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-1 bg-red-500 mr-3 rounded"></div>
                            <span class="font-medium text-gray-700">Jalan / Infrastruktur</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-4 bg-green-500/40 border border-green-500 mr-3 rounded"></div>
                            <span class="font-medium text-gray-700">Sawah</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-4 bg-orange-500/40 border border-orange-500 mr-3 rounded"></div>
                            <span class="font-medium text-gray-700">Pemukiman</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-auto pt-6 border-t border-gray-100">
                <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Informasi</h3>
                <div id="info-panel" class="text-gray-600 text-sm mb-4">
                    Klik pada objek di peta untuk melihat detail.
                </div>
            </div>
        </div>
    </div>
    
    <div id="map-container" class="relative flex-1 h-full w-full">
        <div id="map" class="h-full w-full z-0"></div>

        <!-- Floating Search Bar -->
        <div class="absolute top-4 left-4 z-[1000] w-72 md:w-96">
            <div class="relative group">
                <input type="text" id="search-input" placeholder="Cari lokasi (sekolah, masjid...)" 
                    class="w-full pl-12 pr-4 py-3 rounded-full border-0 shadow-lg focus:ring-2 focus:ring-blue-500 transition-all outline-none text-sm bg-white/90 backdrop-blur-sm hover:bg-white">
                <div class="absolute left-4 top-3 text-gray-400 group-hover:text-blue-500 transition-colors">
                    <i class="fas fa-search text-lg"></i>
                </div>
                <!-- Search Results -->
                <div id="search-results" class="absolute w-full bg-white mt-2 rounded-xl shadow-xl border border-gray-100 hidden z-50 max-h-60 overflow-y-auto"></div>
            </div>
        </div>

        <!-- Welcome Hero Overlay -->
        <div id="welcomeHero" class="absolute inset-0 z-[2000] bg-gray-900/60 backdrop-blur-sm flex items-center justify-center transition-opacity duration-500">
            <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-lg w-full mx-4 text-center transform transition-all scale-100">
                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-map-marked-alt text-4xl text-blue-600"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang!</h1>
                <p class="text-gray-600 mb-8 text-lg">Jelajahi potensi dan infrastruktur Desa Tegalsambi melalui Peta Digital Interaktif.</p>
                
                <button onclick="dismissHero()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg shadow-blue-600/30 transition-all transform hover:-translate-y-1">
                    Mulai Jelajah <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </div>

    @include('map.profile')
    @include('map.guide')

    <!-- Stats Modal -->
    <div id="statsModal" class="fixed inset-0 z-[9999] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeStatsModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">
                                <i class="fas fa-chart-pie text-blue-500 mr-2"></i> Statistik Kependudukan
                            </h3>
                            
                            <!-- Summary Cards -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                <div class="bg-blue-50 p-3 rounded-lg text-center">
                                    <div class="text-xs text-blue-600 font-bold uppercase">Total Penduduk</div>
                                    <div class="text-xl font-bold text-gray-800">{{ $populations->sum('total_population') }}</div>
                                </div>
                                <div class="bg-green-50 p-3 rounded-lg text-center">
                                    <div class="text-xs text-green-600 font-bold uppercase">Total KK</div>
                                    <div class="text-xl font-bold text-gray-800">{{ $populations->sum('household_count') }}</div>
                                </div>
                                <div class="bg-indigo-50 p-3 rounded-lg text-center">
                                    <div class="text-xs text-indigo-600 font-bold uppercase">Laki-laki</div>
                                    <div class="text-xl font-bold text-gray-800">{{ $populations->sum('male_population') }}</div>
                                </div>
                                <div class="bg-pink-50 p-3 rounded-lg text-center">
                                    <div class="text-xs text-pink-600 font-bold uppercase">Perempuan</div>
                                    <div class="text-xl font-bold text-gray-800">{{ $populations->sum('female_population') }}</div>
                                </div>
                            </div>

                            <!-- Chart -->
                            <div class="relative h-64 w-full">
                                <canvas id="publicPopulationChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeStatsModal()">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function openStatsModal() {
        document.getElementById('statsModal').classList.remove('hidden');
        renderChart();
    }

    function closeStatsModal() {
        document.getElementById('statsModal').classList.add('hidden');
    }

    let publicChart = null;

    function renderChart() {
        if (publicChart) return; // Render once

        const ctx = document.getElementById('publicPopulationChart').getContext('2d');
        const labels = {!! json_encode($populations->pluck('region_name')) !!};
        const maleData = {!! json_encode($populations->pluck('male_population')) !!};
        const femaleData = {!! json_encode($populations->pluck('female_population')) !!};

        publicChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Laki-laki',
                        data: maleData,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Perempuan',
                        data: femaleData,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Map
        const map = L.map('map', { zoomControl: false }).setView([-6.619, 110.675], 14); // Coordinates for Tegalsambi, Jepara
        
        // Add Zoom Control to Top Right
        L.control.zoom({
            position: 'topright'
        }).addTo(map);

        // Base Layers
        const googleRoadLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; Google Maps'
        });

        const googleSatLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; Google Maps'
        });

    // Set Default Layer
    googleRoadLayer.addTo(map);

    // Map Type Switcher Logic
    const basemapInputs = document.querySelectorAll('input[name="basemap"]');
    basemapInputs.forEach(input => {
        input.addEventListener('change', (e) => {
            if (e.target.value === 'roadmap') {
                map.removeLayer(googleSatLayer);
                map.addLayer(googleRoadLayer);
            } else {
                map.removeLayer(googleRoadLayer);
                map.addLayer(googleSatLayer);
            }
        });
    });

    // Layers
    const layers = {
        boundaries: L.layerGroup().addTo(map),
        pois: L.layerGroup().addTo(map),
        infra: L.layerGroup().addTo(map),
        landuse: L.layerGroup().addTo(map)
    };

    // Search Logic
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');
    let allPois = []; // Store all POI features for searching

    // Modified POI loading to store data
    const loadPois = async () => {
        const response = await axios.get('/api/map/pois');
        allPois = response.data.features; // Save for search
        
        L.geoJSON(response.data, {
            pointToLayer: (feature, latlng) => {
                let iconClass = 'fa-map-marker-alt';
                let color = '#f97316'; 

                const category = feature.properties.category || '';
                const name = (feature.properties.name || '').toLowerCase();

                if (category === 'Pendidikan' || name.includes('sekolah') || name.includes('sd') || name.includes('smp') || name.includes('sma') || name.includes('mi') || name.includes('mts')) {
                    iconClass = 'fa-school';
                    color = '#2563eb';
                } else if (category === 'Tempat Ibadah' || name.includes('masjid') || name.includes('musholla') || name.includes('langgar')) {
                    iconClass = 'fa-mosque';
                    color = '#16a34a';
                } else if (category === 'Pemerintahan' || name.includes('balai') || name.includes('kantor')) {
                    iconClass = 'fa-landmark';
                    color = '#dc2626';
                } else if (category === 'Tempat Wisata' || name.includes('wisata') || name.includes('pantai') || name.includes('taman')) {
                    iconClass = 'fa-camera';
                    color = '#9333ea'; // Purple-600
                }

                const icon = L.divIcon({
                    className: 'custom-div-icon',
                    html: `<div style="background-color: ${color}; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);">
                            <i class="fas ${iconClass}" style="color: white; font-size: 16px;"></i>
                           </div>`,
                    iconSize: [32, 32],
                    iconAnchor: [16, 16],
                    popupAnchor: [0, -16]
                });

                return L.marker(latlng, { icon: icon });
            },
            onEachFeature: (feature, layer) => {
                // Add reference to layer in feature for search zooming
                feature.layer = layer;
                layer.bindPopup(`
                    <div style="text-align: center; width: 200px;">
                        ${feature.properties.image ? `<img src="/storage/${feature.properties.image}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; margin-bottom: 8px;">` : ''}
                        <h3 style="font-weight: bold; margin-bottom: 5px; color: #333;">${feature.properties.name}</h3>
                        <span style="background: #eee; padding: 2px 8px; border-radius: 4px; font-size: 0.8em;">${feature.properties.category}</span>
                    </div>
                `);
            }
        }).addTo(layers.pois);
    };

    // Override loadLayers to use new loadPois
    const loadLayers = async () => {
        try {
            // Boundaries
            const boundaries = await axios.get('/api/map/boundaries');
            L.geoJSON(boundaries.data, {
                style: { color: '#3b82f6', weight: 2, fillOpacity: 0.1 },
                onEachFeature: (feature, layer) => {
                    layer.bindPopup(`<b>${feature.properties.name}</b><br>${feature.properties.type}`);
                }
            }).addTo(layers.boundaries);

            // POIs (New Function)
            await loadPois();

            // Infrastructure
            const infra = await axios.get('/api/map/infrastructures');
            L.geoJSON(infra.data, {
                style: { color: '#ef4444', weight: 3 },
                onEachFeature: (feature, layer) => {
                    layer.bindPopup(`<b>${feature.properties.name}</b><br>${feature.properties.category}`);
                }
            }).addTo(layers.infra);

            // Land Use
            const landuse = await axios.get('/api/map/land-uses');
            L.geoJSON(landuse.data, {
                style: (feature) => {
                    let color = '#a855f7';
                    if(feature.properties.category === 'Sawah') color = '#22c55e';
                    if(feature.properties.category === 'Pemukiman') color = '#f97316';
                    return { color: color, fillColor: color, fillOpacity: 0.4 };
                },
                onEachFeature: (feature, layer) => {
                    layer.bindPopup(`<b>${feature.properties.name}</b><br>${feature.properties.category}<br>Luas: ${feature.properties.area_sqm} m²`);
                }
            }).addTo(layers.landuse);

        } catch (error) {
            console.error("Error loading layers:", error);
        }
    };

    // Search Event Listener
    searchInput.addEventListener('input', (e) => {
        const query = e.target.value.toLowerCase();
        searchResults.innerHTML = '';
        
        if (query.length < 2) {
            searchResults.classList.add('hidden');
            return;
        }

        const filtered = allPois.filter(p => p.properties.name.toLowerCase().includes(query));
        
        if (filtered.length > 0) {
            searchResults.classList.remove('hidden');
            filtered.forEach(feature => {
                const div = document.createElement('div');
                div.className = 'p-3 hover:bg-blue-50 cursor-pointer border-b border-gray-100 last:border-0 transition-colors';
                div.innerHTML = `
                    <div class="font-semibold text-gray-800 text-sm">${feature.properties.name}</div>
                    <div class="text-xs text-gray-500">${feature.properties.category}</div>
                `;
                div.onclick = () => {
                    const coords = feature.geometry.coordinates;
                    // GeoJSON is LngLat, Leaflet needs LatLng
                    map.flyTo([coords[1], coords[0]], 18);
                    if(feature.layer) feature.layer.openPopup();
                    searchResults.classList.add('hidden');
                };
                searchResults.appendChild(div);
            });
        } else {
            searchResults.classList.add('hidden');
        }
    });

    loadLayers();

    // Layer Controls
    document.getElementById('toggle-boundaries').addEventListener('change', e => {
        e.target.checked ? map.addLayer(layers.boundaries) : map.removeLayer(layers.boundaries);
    });
    document.getElementById('toggle-pois').addEventListener('change', e => {
        e.target.checked ? map.addLayer(layers.pois) : map.removeLayer(layers.pois);
    });
    document.getElementById('toggle-infrastructures').addEventListener('change', e => {
        e.target.checked ? map.addLayer(layers.infra) : map.removeLayer(layers.infra);
    });
    document.getElementById('toggle-land-uses').addEventListener('change', e => {
        e.target.checked ? map.addLayer(layers.landuse) : map.removeLayer(layers.landuse);
    });

    }); // End DOMContentLoaded

    // Sidebar Toggle Logic
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarIcon = sidebarToggle.querySelector('i');
    let isSidebarOpen = true;

    sidebarToggle.addEventListener('click', () => {
        isSidebarOpen = !isSidebarOpen;
        if (isSidebarOpen) {
            sidebar.style.transform = 'translateX(0)';
            sidebar.style.marginLeft = '0';
            sidebarIcon.classList.remove('fa-chevron-right');
            sidebarIcon.classList.add('fa-chevron-left');
        } else {
            sidebar.style.transform = 'translateX(-100%)';
            sidebar.style.marginLeft = '-380px'; // Negative margin to pull layout
            sidebarIcon.classList.remove('fa-chevron-left');
            sidebarIcon.classList.add('fa-chevron-right');
        }
        setTimeout(() => { map.invalidateSize(); }, 300); // Fix map render
    });

    // Hero Logic
    function dismissHero() {
        const hero = document.getElementById('welcomeHero');
        hero.style.opacity = '0';
        setTimeout(() => {
            hero.style.display = 'none';
        }, 500);
    }

    // Modal Logic
    function openProfileModal() { document.getElementById('profileModal').classList.remove('hidden'); }
    function closeProfileModal() { document.getElementById('profileModal').classList.add('hidden'); }
    
    function openGuideModal() { document.getElementById('guideModal').classList.remove('hidden'); }
    function closeGuideModal() { document.getElementById('guideModal').classList.add('hidden'); }

</script>
@endpush
