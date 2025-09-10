@extends('layouts.app')

@section('title', 'Edit Arsip Surat')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-2 text-gray-800">Arsip Surat >> Edit</h1>
    <p class="mb-6 text-gray-600">Ubah data surat yang sudah diarsipkan. Jika tidak ingin mengganti file PDF, biarkan kosong.</p>
    
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('surat.update', $surat->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf
            @method('PUT')

            <div class="flex flex-col">
                <label for="nomor_surat" class="text-sm font-medium text-gray-700">Nomor Surat</label>
                <input type="text" name="nomor_surat" id="nomor_surat"
                       class="mt-1 w-200 border border-gray-300 rounded-md shadow-sm py-2 px-3"
                       value="{{ old('nomor_surat', $surat->nomor_surat) }}" required>
                @error('nomor_surat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col">
                <label for="kategori_id" class="text-sm font-medium text-gray-700">Kategori</label>
                <select name="kategori_id" id="kategori_id"
                        class="mt-1 w-200 border border-gray-300 rounded-md shadow-sm py-2 px-3" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id', $surat->kategori_id) == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col">
                <label for="judul" class="text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="judul" id="judul"
                       class="mt-1 w-200 border border-gray-300 rounded-md shadow-sm py-2 px-3"
                       value="{{ old('judul', $surat->judul) }}" required>
                @error('judul') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-700">File Surat (PDF)</label>
                <div class="flex items-center gap-2 w-100">
                    <input type="text" id="file_name" placeholder="Tidak ada file baru dipilih"
                           class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-50 cursor-not-allowed"
                           readonly>
                    <button type="button" onclick="document.getElementById('file_pdf').click()"
                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Browse
                    </button>
                </div>
                <input type="file" name="file_pdf" id="file_pdf" accept="application/pdf" class="hidden">
                @error('file_pdf') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <p class="text-xs text-gray-500 mt-1">File lama: <span class="font-semibold">{{ basename($surat->file_path) }}</span></p>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('surat.show', $surat->id) }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    << Kembali
                </a>
                <button type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('file_pdf').addEventListener('change', function () {
        if (this.files.length > 0) {
            document.getElementById('file_name').value = this.files[0].name;
        }
    });
</script>
@endsection
