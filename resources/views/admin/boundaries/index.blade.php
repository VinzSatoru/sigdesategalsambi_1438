@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-gray-700 text-3xl font-medium">Data Batas Desa</h3>
        <a href="{{ route('admin.administrative-boundaries.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
            <i class="fas fa-plus mr-2"></i> Tambah Data
        </a>
    </div>



    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama Wilayah
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Tipe
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Update Terakhir
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($boundaries as $boundary)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                    <i class="fas fa-draw-polygon"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap font-medium">
                                        {{ $boundary->name }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <span class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                                <span aria-hidden="true" class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                <span class="relative">{{ $boundary->type }}</span>
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $boundary->updated_at->format('d M Y H:i') }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            <div class="flex justify-center space-x-3">
                                <a href="{{ route('admin.administrative-boundaries.edit', $boundary->id) }}" class="text-blue-600 hover:text-blue-900 transition duration-200" title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <form action="{{ route('admin.administrative-boundaries.destroy', $boundary->id) }}" method="POST" class="inline-block" data-confirm-delete="true">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition duration-200" title="Hapus">
                                        <i class="fas fa-trash text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-gray-500">
                            Belum ada data batas desa.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
            {{ $boundaries->links() }}
        </div>
    </div>
</div>
@endsection
