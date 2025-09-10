@extends('layouts.app')

@section('title', 'Kategori Surat')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-2 text-gray-800">Kategori Surat</h1>
    <p class="mb-6 text-gray-600">Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat. <br> Klik "Tambah" untuk menambah kategori baru.</p>

    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if (session('success_delete'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success_delete') }}</span>
    </div>
    @endif

    @if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-600 text-white">
                <tr>
                    <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">ID Kategori</th>
                    <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm text-left">Nama Kategori</th>
                    <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm text-left">Keterangan</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($kategoris as $kategori)
                <tr>
                    <td class="py-3 px-4">{{ $kategori->id }}</td>
                    <td class="py-3 px-4">{{ $kategori->nama_kategori }}</td>
                    <td class="py-3 px-4">{{ $kategori->keterangan ?: '-' }}</td>
                    <td class="py-3 px-4 flex items-center space-x-2">
                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                onclick="openDeleteKategoriModal({{ $kategori->id }})"
                                class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Tidak ada data kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $kategoris->links() }}
    </div>

    <div class="flex justify-start items-center mb-4">
        <a href="{{ route('kategori.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
            Tambah Kategori Baru...
        </a>
    </div>
</div>

<div id="deleteKategoriModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-800/40">
    <div id="deleteKategoriBox" class="bg-white rounded-2xl shadow-2xl p-6 w-96 transform scale-90 opacity-0 transition duration-200">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h2>
        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus kategori ini?</p>

        <div class="flex justify-end space-x-2">
            <button type="button" onclick="closeDeleteKategoriModal()"
                class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                Batal
            </button>

            <form id="deleteKategoriForm" method="POST" onsubmit="disableButton(this);">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteKategoriModal(id) {
        const modal = document.getElementById('deleteKategoriModal');
        const box = document.getElementById('deleteKategoriBox');
        const form = document.getElementById('deleteKategoriForm');


        form.action = `/kategori/${id}`;

        modal.classList.remove('hidden');
        setTimeout(() => {
            box.classList.remove('scale-90', 'opacity-0');
            box.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeDeleteKategoriModal() {
        const modal = document.getElementById('deleteKategoriModal');
        const box = document.getElementById('deleteKategoriBox');

        box.classList.remove('scale-100', 'opacity-100');
        box.classList.add('scale-90', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 200);
    }

    function disableButton(form) {
        const button = form.querySelector('button[type="submit"]');
        button.disabled = true;
        button.classList.add('opacity-50', 'cursor-not-allowed');
        button.innerText = 'Menghapus...';
    }
</script>

@endsection