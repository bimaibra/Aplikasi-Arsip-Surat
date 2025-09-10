@extends('layouts.app')

@section('title', 'Arsip Surat')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-2 text-gray-800">Arsip Surat</h1>
    <p class="mb-6 text-gray-600">Berikut ini adalah surat-surat yang telah terbit dan diarsipkan. <br> Klik "Lihat" untuk menampilkan surat.</p>

    <div class="flex justify-between items-center mb-4">
        <form action="{{ route('surat.index') }}" method="GET" class="flex items-center">
            <label for="search" class="mr-2 font-medium text-gray-700">Cari surat:</label>
            <input type="text" name="search" id="search" placeholder="Cari berdasarkan judul..." class="border rounded-2xl px-3 py-2 w-200" value="{{ request('search') }}">
            <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cari</button>
        </form>
    </div>

    @if (session('success_create'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success_create') }}</span>
    </div>
    @endif

    @if (session('success_delete'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success_delete') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-600 text-white">
                <tr>
                    <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Nomor Surat</th>
                    <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Kategori</th>
                    <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm text-left">Judul</th>
                    <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Waktu Pengarsipan</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($surats as $surat)
                <tr>
                    <td class="py-3 px-4">{{ $surat->nomor_surat }}</td>
                    <td class="py-3 px-4">{{ $surat->kategori->nama_kategori }}</td>
                    <td class="py-3 px-4">{{ $surat->judul }}</td>
                    <td class="py-3 px-4">{{ $surat->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i:s'); }}</td>
                    <td class="py-3 px-4 flex items-center space-x-2">
                        <form action="{{ route('surat.destroy', $surat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                onclick="openDeleteModal({{ $surat->id }})"
                                class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                        <a href="{{ route('surat.unduh', $surat->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">Unduh</a>
                        <a href="{{ route('surat.show', $surat->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">Lihat</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Tidak ada data surat yang ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $surats->links() }}
    </div>
    <div>
        <a href="{{ route('surat.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
            Arsipkan Surat..
        </a>
    </div>
</div>

<div id="deleteModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-800/40">
    <div id="deleteBox" class="bg-white rounded-2xl shadow-2xl p-6 w-96 transform scale-90 opacity-0 transition duration-200 border border-gray-300">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h2>
        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus surat ini? Tindakan ini tidak bisa dibatalkan.</p>

        <div class="flex justify-end space-x-2">
            <button type="button" onclick="closeDeleteModal()"
                class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                Batal
            </button>

            <form id="deleteForm" method="POST" onsubmit="disableButton(this)">
                @csrf
                @method('DELETE')
                <button type="submit" id="submitDeleteBtn" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(id) {
        const modal = document.getElementById('deleteModal');
        const box = document.getElementById('deleteBox');
        const form = document.getElementById('deleteForm');

        form.action = `/surat/${id}`;

        modal.classList.remove('hidden');
        setTimeout(() => {
            box.classList.remove('scale-90', 'opacity-0');
            box.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const box = document.getElementById('deleteBox');

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