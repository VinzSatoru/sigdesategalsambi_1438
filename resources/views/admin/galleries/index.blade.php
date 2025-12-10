@extends('layouts.admin')

@section('title', 'Manajemen Galeri')

@section('content')
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-xl font-bold text-gray-800">Daftar Galeri</h2>
        <a href="{{ route('admin.galleries.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Foto
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($galleries as $item)
        <div class="bg-white rounded-lg shadow overflow-hidden group">
            <div class="relative h-48">
                <img src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-opacity flex items-center justify-center opacity-0 group-hover:opacity-100">
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.galleries.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-full">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.galleries.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white p-2 rounded-full">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-bold text-gray-800 truncate">{{ $item->title }}</h3>
                <p class="text-sm text-gray-500 truncate">{{ $item->description }}</p>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-6">
        {{ $galleries->links() }}
    </div>
@endsection
