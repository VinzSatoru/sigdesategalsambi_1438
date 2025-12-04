@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h3 class="text-gray-700 text-3xl font-medium mb-6">Edit Batas Desa</h3>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden p-6">
        <form action="{{ route('admin.administrative-boundaries.update', $boundary->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Nama Wilayah
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" id="name" type="text" name="name" value="{{ old('name', $boundary->name) }}">
                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                    Tipe Wilayah
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('type') border-red-500 @enderror" id="type" name="type">
                    <option value="">Pilih Tipe</option>
                    <option value="Desa" {{ old('type', $boundary->type) == 'Desa' ? 'selected' : '' }}>Desa</option>
                    <option value="RW" {{ old('type', $boundary->type) == 'RW' ? 'selected' : '' }}>RW</option>
                    <option value="RT" {{ old('type', $boundary->type) == 'RT' ? 'selected' : '' }}>RT</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="geojson_file">
                    Update File GeoJSON (Opsional)
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('geojson_file') border-red-500 @enderror" id="geojson_file" type="file" name="geojson_file" accept=".json,.geojson">
                <p class="text-gray-500 text-xs italic mt-1">Biarkan kosong jika tidak ingin mengubah geometri wilayah.</p>
                @error('geojson_file')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300" type="submit">
                    Simpan Perubahan
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800" href="{{ route('admin.administrative-boundaries.index') }}">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
