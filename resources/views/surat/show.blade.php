@extends('layouts.app')

@section('title', 'Lihat Arsip Surat')

@section('content')
<div class="container overflow-hidden">
    <h1 class="text-3xl font-bold mb-2 text-gray-800">Arsip Surat >> Lihat</h1>
    <div class="mb-4">
        <p><strong>Nomor:</strong> {{ $surat->nomor_surat }}</p>
        <p><strong>Kategori:</strong> {{ $surat->kategori->nama_kategori }}</p>
        <p><strong>Judul:</strong> {{ $surat->judul }}</p>
        <p><strong>Waktu Unggah:</strong> {{ $surat->created_at->format('d-m-Y H:i:s') }}</p>
    </div>

    <div class="w-[80%] h-[65vh] mb-4 border">
        <iframe
            src="{{ route('surat.view-pdf', $surat->id) }}"
            width="100%"
            height="100%"
            style="border: none;">
        </iframe>
    </div>

    <div class="flex items-center space-x-4">
        <a href="{{ route('surat.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            << Kembali
        </a>

        <a href="{{ route('surat.unduh', $surat->id) }}"
           class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
            Unduh
        </a>

        <a href="{{ route('surat.edit', $surat->id) }}"
           class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Edit/Ganti File
        </a>
    </div>
</div>
@endsection
