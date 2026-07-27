<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mindshub')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    {{-- Alpine.js para interatividade --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <div class="relative flex flex-1">
        <!-- Sidebar -->
        <x-sidebar />

        <div id="main-content" class="flex flex-col flex-1 md:ml-20">
            <x-header />

            <!-- Conteúdo Principal -->
            <main class="flex-1 p-4 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />
</body>

</html>