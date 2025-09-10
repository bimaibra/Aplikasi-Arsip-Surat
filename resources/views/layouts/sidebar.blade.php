<aside class="w-64 bg-white shadow-md">
    <div class="p-4 border-b">
        <h1 class="text-2xl font-bold text-black">Menu</h1>
    </div>
    <nav class="mt-6 space-y-1">
        <a href="{{ route('surat.index') }}" 
           class="flex items-center gap-2 px-6 py-3 text-black-500 hover:bg-gray-200 {{ request()->routeIs('surat.*') ? 'bg-gray-300 font-semibold' : '' }}">
           <x-heroicon-s-star class="w-5 h-5 text-black" />
           <span>Arsip Surat</span>
        </a>
        <a href="{{ route('kategori.index') }}" 
           class="flex items-center gap-2 px-6 py-3 text-black-500 hover:bg-gray-200 {{ request()->routeIs('kategori.*') ? 'bg-gray-300 font-semibold' : '' }}">
           <x-heroicon-c-list-bullet class="w-5 h-5 text-black" />
           <span>Kategori Surat</span>
        </a>
        <a href="{{ route('about.index') }}" 
           class="flex items-center gap-2 px-6 py-3 text-black-500 hover:bg-gray-200 {{ request()->routeIs('about.*') ? 'bg-gray-300 font-semibold' : '' }}">
           <x-heroicon-s-information-circle class="w-5 h-5 text-black" />
           <span>About</span>
        </a>
    </nav>
</aside>
