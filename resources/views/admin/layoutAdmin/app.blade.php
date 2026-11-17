<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Memuat CSS dan JS yang sudah diproses oleh Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <div class="flex h-screen bg-gray-800 font-sans">

        <nav class="fixed bg-white shadow-md top-0 z-50 w-full">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start rtl:justify-end">
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                                </path>
                            </svg>
                        </button>
                        <a href="{{ route('berandaAdmin') }}" class="flex ms-2 md:me-24">
                            <img src="{{ asset('images/logo.png') }}" class="h-8 me-3" alt="Logo" />
                            <span
                                class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">DISTANHORTI</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-start ms-3">
                            <div>
                                <button type="button"
                                    class="flex text-sm bg-green-800 rounded-full focus:ring-4 cursor-pointer focus:ring-green-300 dark:focus:ring-green-600"
                                    aria-expanded="false" data-dropdown-toggle="dropdown-user"
                                    data-dropdown-placement="left-end">
                                    <span class="sr-only">Open user menu</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="26px" fill="#e3e3e3">
                                        <path
                                            d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="z-50 hidden my-4 text-base list-none divide-y divide-gray-100 rounded-sm shadow-md dark:bg-[#FDFBF5] dark:divide-gray-400"
                                id="dropdown-user">
                                @auth
                                    <div class="px-4 py-3" role="none">
                                        <p class="text-sm text-gray-900" role="none">
                                            {{ Auth::user()->name }}
                                        </p>
                                        <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                            {{ Auth::user()->username }}
                                        </p>
                                    </div>
                                @endauth
                                <li>
                                    <form action="{{ route('logoutAdmin') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-red-900 hover:bg-gray-100">
                                            Keluar
                                        </button>
                                    </form>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        @include('admin.layoutAdmin.partials._sidebar')

        <!-- Konten Utama -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white p-6">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>
