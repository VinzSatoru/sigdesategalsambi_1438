@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 max-w-2xl mx-auto">
        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Judul Berita</label>
                <input type="text" name="title" id="title" value="{{ $news->title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="content">Isi Berita</label>
                <textarea name="content" id="content" rows="6" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $news->content }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Gambar Utama</label>
                @if($news->image)
                    <div class="mb-2">
                        <img src="{{ Str::startsWith($news->image, 'http') ? $news->image : asset('storage/' . $news->image) }}" alt="Current Image" class="h-32 w-auto rounded-lg shadow-sm">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
            </div>

            <div class="flex items-center justify-end">
                <a href="{{ route('admin.news.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Berita
                </button>
            </div>
        </form>
    </div>
@endsection
