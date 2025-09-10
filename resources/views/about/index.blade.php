@extends('layouts.app')

@section('title', 'About')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-4 text-gray-800">About</h1>
    <div class="bg-white p-8 rounded-sm shadow-md flex items-center space-x-8">
        <div>
            <img src="{{ asset('storage/images/fotoprofil.jpg') }}"
                alt="Foto Profil"
                class="w-40 h-50 rounded-md object-cover">
        </div>
        <div>
            <p class="text-xl">Aplikasi ini dibuat oleh:</p>
            <p class="text-2xl font-semibold mt-2">Nama: Bima Ibrahim</p>
            <p class="text-lg">NIM: 2331730126</p>
            <p class="text-lg">Tanggal Pembuatan: 5 September 2025</p>
        </div>
    </div>
</div>
@endsection