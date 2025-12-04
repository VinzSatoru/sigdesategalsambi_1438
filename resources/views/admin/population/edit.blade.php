@extends('layouts.admin')

@section('title', 'Edit Data Penduduk')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 max-w-lg mx-auto">
        <form action="{{ route('admin.population.update', $population->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="region_name">Nama Wilayah (RT/RW)</label>
                <input type="text" name="region_name" id="region_name" value="{{ $population->region_name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="male_population">Laki-laki</label>
                    <input type="number" name="male_population" id="male_population" value="{{ $population->male_population }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required oninput="calculateTotal()">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="female_population">Perempuan</label>
                    <input type="number" name="female_population" id="female_population" value="{{ $population->female_population }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required oninput="calculateTotal()">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="total_population">Total Penduduk</label>
                <input type="number" name="total_population" id="total_population" value="{{ $population->total_population }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight focus:outline-none focus:shadow-outline" readonly>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="household_count">Jumlah Kepala Keluarga (KK)</label>
                <input type="number" name="household_count" id="household_count" value="{{ $population->household_count }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Data
                </button>
                <a href="{{ route('admin.population.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        function calculateTotal() {
            const male = parseInt(document.getElementById('male_population').value) || 0;
            const female = parseInt(document.getElementById('female_population').value) || 0;
            document.getElementById('total_population').value = male + female;
        }
    </script>
@endsection
