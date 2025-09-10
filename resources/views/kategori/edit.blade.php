@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-2 text-gray-800">Kategori Surat >> Edit</h1>
    <p class="mb-6 text-gray-600">Tambahkan atau edit data kategori surat. Jika sudah, jangan lupa klik tombol "Simpan".</p>
    
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <label for="id" class="block text-sm font-medium text-gray-700">ID Kategori</label>
                    <input type="text" name="id" id="id" class="mt-1 block w-200 bg-gray-100 border border-gray-300 rounded-md shadow-sm py-2 px-3" value="{{ $kategori->id }}" readonly>
                </div>

                <div>
                    <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="nama_kategori" class="mt-1 block w-200 border border-gray-300 rounded-md shadow-sm py-2 px-3" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                    @error('nama_kategori') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="4" class="mt-1 block w-200 border border-gray-300 rounded-md shadow-sm py-2 px-3">{{ old('keterangan', $kategori->keterangan) }}</textarea>
                    @error('keterangan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div class="mt-6 flex items-center space-x-4">
                <a href="{{ route('kategori.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    << Kembali
                </a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection