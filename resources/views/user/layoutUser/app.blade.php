<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <title>@yield('title', 'Website Tamu DISTANHORTI')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-white flex flex-col min-h-screen">
    <nav id="navbar" class="bg-transparent sticky top-0 z-50 transition-shadow duration-300">
        <div class="container mx-auto px-8">
            <div class="flex justify-between items-center py-3">
                <a href="/" class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo.png') }}" class="h-16 me-3" alt="Logo" />
                </a>
                <div class="hidden md:flex items-center space-x-4">
                    <x-link-users-nav :href="route('berandaUser')" :active="Route::is('berandaUser')">beranda</x-link-users-nav>
                    <x-link-users-nav :href="route('rapatUser')" :active="Route::is('rapatUser')">Agenda Rapat</x-link-users-nav>
                    <x-link-users-nav :href="route('temuUser.create')" :active="Route::is('temuUser.create')">Janji Temu</x-link-users-nav>
                    <x-link-users-nav :href="route('public.tentang')" :active="Route::is('public.tentang')">tentang</x-link-users-nav>
                </div>
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-800 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden">
            <a href="/" class="block py-2 px-4 text-sm">Beranda</a>
            <a href="/rapatUser" class="block py-2 px-4 text-sm ">Agenda Rapat</a>
            <a href="/janji-temu" class="block py-2 px-4 text-sm ">Janji Temu</a>
            <a href="/tentang" class="block py-2 px-4 text-sm ">Tentang</a>
        </div>
    </nav>


    <main class="flex-grow">
        <div class="container mx-auto px-4 py-8">
            @yield('content')
        </div>
    </main>

    <footer class="bg-green text-white text-center p-4">
        <p>&copy; {{ date('Y') }} Dinas Tanaman Pangan Dan Holtikultura. Hak Cipta <span
                class="font-semibold">Dilindungi.</span></p>
    </footer>

    @stack('scripts')

    <script>
        document.getElementById('mobile-menu-button').onclick = function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }
        var navbar = document.getElementById('navbar');
        var navbarHeight = navbar.offsetHeight;
        window.onscroll = function() {
            if (window.scrollY > 0) {
                navbar.classList.add('shadow-md', 'bg-white', 'fixed', 'top-0', 'w-full', 'z-50');
            } else {
                navbar.classList.remove('shadow-md', 'bg-white', 'fixed', 'top-0', 'w-full', 'z-50');
            }
        };
    </script>
</body>

</html>
