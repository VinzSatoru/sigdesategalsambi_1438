@extends('layouts.content')

@section('title', $news->title)

@section('content')
<div class="pb-16 bg-slate-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm text-slate-500">
            <a href="{{ route('landing') }}" class="hover:text-blue-600">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-slate-800">Berita</span>
        </nav>

        <article class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Featured Image -->
            <div class="relative h-64 md:h-96 w-full">
                <img src="{{ Str::startsWith($news->image, 'http') ? $news->image : asset('storage/' . $news->image) }}" 
                     alt="{{ $news->title }}" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 text-white">
                    <div class="mb-2 inline-flex items-center bg-blue-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                        Berita Desa
                    </div>
                    <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-2">{{ $news->title }}</h1>
                    <div class="flex items-center text-sm md:text-base text-slate-200">
                        <i class="far fa-calendar-alt mr-2"></i>
                        {{ $news->published_at->format('d F Y') }}
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8 md:p-12">
                <div class="prose prose-lg prose-blue max-w-none text-slate-700 leading-relaxed">
                    {!! nl2br(e($news->content)) !!}
                </div>

                <hr class="my-8 border-slate-200">

                <!-- Share/Back -->
                <div class="flex justify-between items-center">
                    <a href="{{ route('landing') }}#berita" class="inline-flex items-center text-slate-600 hover:text-blue-600 font-semibold transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Berita
                    </a>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection
