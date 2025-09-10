<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Arsip Surat')</title>
    @vite('resources/css/app.css', 'resources/js/app.js') 
</head>
<body class="bg-white-100 font-sans">
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>