@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg p-6 mb-8 text-white relative overflow-hidden">
        <div class="relative z-10">
            <h3 class="text-2xl font-bold mb-2">Selamat Datang, Administrator!</h3>
            <p class="text-blue-100 max-w-2xl">
                Panel ini memberikan ringkasan lengkap mengenai data spasial dan kependudukan Desa Tegalsambi.
                Kelola data fasilitas, infrastruktur, dan penggunaan lahan dengan mudah.
            </p>
        </div>
        <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-10 translate-y-10">
            <i class="fas fa-map-marked-alt text-9xl"></i>
        </div>
    </div>

    <!-- Population Stats -->
    <h4 class="text-gray-600 font-semibold mb-4 uppercase tracking-wider text-sm">Data Kependudukan</h4>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Population -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-b-4 border-blue-500 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Total Penduduk</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($counts['population_total']) }}</h3>
                    <p class="text-sm text-green-500 mt-1"><i class="fas fa-user-friends mr-1"></i> Jiwa</p>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg text-blue-500">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Male -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-b-4 border-indigo-500 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Laki-laki</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($counts['population_male']) }}</h3>
                    <p class="text-sm text-indigo-500 mt-1"><i class="fas fa-male mr-1"></i> Jiwa</p>
                </div>
                <div class="p-3 bg-indigo-50 rounded-lg text-indigo-500">
                    <i class="fas fa-male text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Female -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-b-4 border-pink-500 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Perempuan</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($counts['population_female']) }}</h3>
                    <p class="text-sm text-pink-500 mt-1"><i class="fas fa-female mr-1"></i> Jiwa</p>
                </div>
                <div class="p-3 bg-pink-50 rounded-lg text-pink-500">
                    <i class="fas fa-female text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Households -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-b-4 border-green-500 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Kepala Keluarga</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($counts['population_kk']) }}</h3>
                    <p class="text-sm text-green-500 mt-1"><i class="fas fa-home mr-1"></i> KK</p>
                </div>
                <div class="p-3 bg-green-50 rounded-lg text-green-500">
                    <i class="fas fa-file-contract text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Spatial Data Stats -->
    <h4 class="text-gray-600 font-semibold mb-4 uppercase tracking-wider text-sm">Data Spasial</h4>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- POI -->
        <div class="bg-white rounded-xl shadow-sm p-6 relative overflow-hidden group hover:shadow-md transition-all">
            <div class="absolute right-0 top-0 h-full w-1 bg-gradient-to-b from-orange-400 to-red-500"></div>
            <div class="flex items-center">
                <div class="p-4 rounded-full bg-orange-100 text-orange-500 mr-4 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <i class="fas fa-map-marker-alt text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Fasilitas (POI)</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $counts['pois'] }} <span class="text-sm font-normal text-gray-400">Lokasi</span></p>
                </div>
            </div>
        </div>
        <!-- LUAS Desa-->
        <div class="bg-white rounded-xl shadow-sm p-6 relative overflow-hidden group hover:shadow-md transition-all">
            <div class="absolute right-0 top-0 h-full w-1 bg-gradient-to-b from-gray-400 to-gray-600"></div>
            <div class="flex items-center">
                <div class="p-4 rounded-full bg-gray-100 text-gray-500 mr-4 group-hover:bg-gray-500 group-hover:text-white transition-colors">
                    <i class="fas fa-ruler-combined text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Luas Desa</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($area_ha, 2) }} <span class="text-sm font-normal text-gray-400">Hektar</span></p>
                </div>
            </div>
        </div>

        <!-- Infrastructure -->
        <div class="bg-white rounded-xl shadow-sm p-6 relative overflow-hidden group hover:shadow-md transition-all">
            <div class="absolute right-0 top-0 h-full w-1 bg-gradient-to-b from-blue-400 to-cyan-500"></div>
            <div class="flex items-center">
                <div class="p-4 rounded-full bg-blue-100 text-blue-500 mr-4 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                    <i class="fas fa-road text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Infrastruktur</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $counts['infrastructures'] }} <span class="text-sm font-normal text-gray-400">Ruas</span></p>
                </div>
            </div>
        </div>

        <!-- Land Use -->
        <div class="bg-white rounded-xl shadow-sm p-6 relative overflow-hidden group hover:shadow-md transition-all">
            <div class="absolute right-0 top-0 h-full w-1 bg-gradient-to-b from-green-400 to-emerald-500"></div>
            <div class="flex items-center">
                <div class="p-4 rounded-full bg-green-100 text-green-500 mr-4 group-hover:bg-green-500 group-hover:text-white transition-colors">
                    <i class="fas fa-layer-group text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Penggunaan Lahan</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $counts['land_uses'] }} <span class="text-sm font-normal text-gray-400">Area</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent POIs -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="font-bold text-gray-800">POI Terbaru Ditambahkan</h3>
                <a href="{{ route('admin.pois.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 bg-gray-50 text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 bg-gray-50 text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recent_pois as $poi)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $poi->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                    {{ $poi->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $poi->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500 text-sm">Belum ada data POI.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-bold text-gray-800 mb-4">Aksi Cepat</h3>
            <div class="space-y-3">
                <a href="{{ route('admin.pois.create') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition-all group">
                    <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-3 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800 group-hover:text-blue-700">Tambah POI</p>
                        <p class="text-xs text-gray-500">Input lokasi fasilitas baru</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.infrastructures.create') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-green-500 hover:bg-green-50 transition-all group">
                    <div class="h-10 w-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3 group-hover:bg-green-600 group-hover:text-white transition-colors">
                        <i class="fas fa-road"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800 group-hover:text-green-700">Tambah Infrastruktur</p>
                        <p class="text-xs text-gray-500">Input data jalan/jembatan</p>
                    </div>
                </a>

                <a href="{{ route('admin.population.create') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-indigo-500 hover:bg-indigo-50 transition-all group">
                    <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mr-3 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800 group-hover:text-indigo-700">Update Penduduk</p>
                        <p class="text-xs text-gray-500">Perbarui data demografi</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
