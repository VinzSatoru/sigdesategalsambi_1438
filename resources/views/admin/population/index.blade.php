@extends('layouts.admin')

@section('title', 'Data Penduduk')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Chart Container -->
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Grafik Penduduk per Wilayah</h3>
            <canvas id="populationChart"></canvas>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-blue-100 p-4 rounded-lg">
                <h4 class="text-sm font-bold text-blue-600">Total Penduduk</h4>
                <p class="text-2xl font-bold text-gray-800">{{ $populations->sum('total_population') }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg">
                <h4 class="text-sm font-bold text-green-600">Total KK</h4>
                <p class="text-2xl font-bold text-gray-800">{{ $populations->sum('household_count') }}</p>
            </div>
            <div class="bg-indigo-100 p-4 rounded-lg">
                <h4 class="text-sm font-bold text-indigo-600">Laki-laki</h4>
                <p class="text-2xl font-bold text-gray-800">{{ $populations->sum('male_population') }}</p>
            </div>
            <div class="bg-pink-100 p-4 rounded-lg">
                <h4 class="text-sm font-bold text-pink-600">Perempuan</h4>
                <p class="text-2xl font-bold text-gray-800">{{ $populations->sum('female_population') }}</p>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <a href="{{ route('admin.population.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus mr-2"></i> Tambah Data Wilayah
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Wilayah (RT/RW)
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Laki-laki
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Perempuan
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Total
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Jumlah KK
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($populations as $population)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap font-bold">{{ $population->region_name }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $population->male_population }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $population->female_population }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-bold">
                        {{ $population->total_population }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $population->household_count }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('admin.population.edit', $population->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                        <form action="{{ route('admin.population.destroy', $population->id) }}" method="POST" class="inline-block" data-confirm-delete="true">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('populationChart').getContext('2d');
        const labels = {!! json_encode($populations->pluck('region_name')) !!};
        const maleData = {!! json_encode($populations->pluck('male_population')) !!};
        const femaleData = {!! json_encode($populations->pluck('female_population')) !!};

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Laki-laki',
                        data: maleData,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Perempuan',
                        data: femaleData,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
