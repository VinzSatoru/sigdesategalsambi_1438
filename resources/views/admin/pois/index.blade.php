@extends('layouts.admin')

@section('title', 'Manajemen POI')

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Daftar Fasilitas</h3>
            <a href="{{ route('admin.pois.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                <i class="fas fa-plus mr-2"></i> Tambah POI
            </a>
        </div>
        


        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="py-4 px-6 bg-gray-50 font-bold uppercase text-sm text-gray-700 border-b border-gray-200">Nama</th>
                    <th class="py-4 px-6 bg-gray-50 font-bold uppercase text-sm text-gray-700 border-b border-gray-200">Kategori</th>
                    <th class="py-4 px-6 bg-gray-50 font-bold uppercase text-sm text-gray-700 border-b border-gray-200">Terakhir Update</th>
                    <th class="py-4 px-6 bg-gray-50 font-bold uppercase text-sm text-gray-700 border-b border-gray-200 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pois as $poi)
                <tr class="hover:bg-gray-50">
                    <td class="py-4 px-6 border-b border-gray-200">{{ $poi->name }}</td>
                    <td class="py-4 px-6 border-b border-gray-200">
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $poi->category }}</span>
                    </td>
                    <td class="py-4 px-6 border-b border-gray-200 text-sm text-gray-500">{{ $poi->updated_at->diffForHumans() }}</td>
                    <td class="py-4 px-6 border-b border-gray-200 text-right">
                        <a href="{{ route('admin.pois.edit', $poi->id) }}" class="text-blue-500 hover:text-blue-700 mr-4"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.pois.destroy', $poi->id) }}" method="POST" class="inline-block" data-confirm-delete="true">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-4 px-6 text-center text-gray-500">Belum ada data POI.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $pois->links() }}
        </div>
    </div>
@endsection
