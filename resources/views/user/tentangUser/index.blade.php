@extends('user.layoutUser.app')

@section('title', 'Tentang DISTANHORTI')

@section('content')
    <div class="max-w-7xl mx-auto py-8">
        {{-- section 1 --}}
        <section class="flex flex-col lg:flex-row items-center gap-8 space-y-20">
            {{-- Kolom Kiri --}}
            <div class="w-full lg:w-1/3 relative">
                <div class="absolute -top-8 -left-8 w-32 h-32 rounded-full opacity-50 blur-xl"></div>
                <img src="{{ asset('images/tentang1.png') }}" alt="tentang-distanhorti"
                    class="rounded-3xl  relative z-10 w-full object-fill">
            </div>
            {{-- Kolom Kanan --}}
            <div class="w-full lg:w-2/3">
                <section class="flex flex-col lg:flex-row items-center gap-4">
                    <div class="w-full lg:w-2/3">
                        <p class="text-gray-600 font-semibold mb-2">Mendorong inovasi dan pemberdayaan petani untuk masa
                            depan
                            pangan yang berkelanjutan.</p>
                        <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight">
                            Membangun <span class="text-green">Pertanian Tangguh</span> dan <span class="text-green">Berdaya
                                Saing</span>
                        </h1>
                    </div>
                    <div class="lg:w-1/3">
                        <img src="{{ asset('images/tentang2.png') }}" alt="tentang-distanhorti"
                            class="rounded-3xl  relative z-10 w-full object-fill hover:shadow-lg transition-shadow duration-300 ease-in-out">
                    </div>
                </section>
                <p class="mt-6 text-gray-600">
                    Dinas Tanaman Pangan dan Hortikultura berperan merumuskan kebijakan, membina, serta mengembangkan
                    sektor
                    tanaman pangan dan hortikultura untuk mewujudkan pertanian yang produktif dan berkelanjutan.
                </p>
                <section class="mt-8 flex flex-col sm:flex-row text-center sm:text-left gap-8">
                    <div class="flex-1">
                        <p class="text-3xl font-bold text-green">1.200+</p>
                        <p class="text-gray-500">Desa Wilayah Binaan</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-3xl font-bold text-green">10.000+</p>
                        <p class="text-gray-500">Petani Telah Terfasilitasi</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-3xl font-bold text-green">145+</p>
                        <p class="text-gray-500">Inovasi Teknologi Pertanian</p>
                    </div>
                </section>
            </div>
        </section>
        {{-- section 2 --}}
        <section class="flex flex-col lg:flex-row items-center gap-8 mt-20">
            <div class="w-full mb-12 lg:w-2/3">
                <p class="text-green font-semibold">Dapatkan berita, program, dan inovasi terbaru dari Dinas Tanaman
                    Pangan dan Hortikultura.</p>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 mt-2">
                    Ikuti <span class="text-green">Kami</span> dan Akses Informasi Resmi <span
                        class="text-green">Distanhorti</span>
                </h2>
            </div>
            <div class="w-full lg:w-1/3">
                <img src="{{ asset('images/tentang4.png') }}" alt="tentang-distanhorti"
                    class="rounded-3xl hover:shadow-lg relative z-10 w-full object-fill transition-shadow duration-300 ease-in-out">
            </div>

        </section>
        {{-- section 3 --}}
        <section class="mt-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    class="group flex flex-col p-6 rounded-2xl text-gray-900 hover:text-white bg-white border border-gray-300 hover:shadow-lg hover:bg-green transition-all duration-300 ease-in-out">
                    <img src="{{ asset('images/tentang3.png') }}" alt="Kantor Distanhorti"
                        class="rounded-xl h-40 w-full object-cover mb-4">
                    <h3 class="text-xl font-bold">Website Resmi Dinas Tanaman Pangan dan Holtikultura</h3>
                    <p class="mt-2 text-sm flex-grow">Akses situs resmi kami untuk informasi program,
                        kegiatan, dan layanan publik sektor pertanian dan hortikultura.</p>
                    <a href="https://distanhorti.jabarprov.go.id/"
                        class="inline-flex items-center gap-2 mt-4 text-green font-bold group-hover:text-white transition-all duration-300 ease-in-out">
                        <span>Selengkapnya</span>
                        <x-icon class="material-icons-outlined">arrow_forward</x-icon>
                    </a>
                </div>
                <div class="space-y-8">
                    {{-- Instagram --}}
                    <div
                        class="group flex flex-col p-6 rounded-2xl text-gray-900 hover:text-white bg-white border border-gray-300 hover:shadow-lg hover:bg-green transition-all duration-300 ease-in-out">
                        <div class="flex items-center mb-2">
                            <svg class="w-8 h-8 mr-3 text-pink-500 bg-white rounded-full p-0.5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.85s-.011 3.584-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.85-.07c-3.252-.148-4.771-1.691-4.919-4.919-.058-1.265-.069-1.645-.069-4.85s.011-3.584.069-4.85c.149-3.225 1.664-4.771 4.919-4.919C8.416 2.175 8.796 2.163 12 2.163zm0 1.802c-3.116 0-3.483.01-4.71.066-2.61.12-3.778 1.282-3.9 3.9C3.327 9.25 3.316 9.617 3.316 12s.011 2.75.066 3.983c.12 2.61 1.29 3.778 3.9 3.9 1.227.056 1.594.066 4.71.066s3.483-.01 4.71-.066c2.61-.12 3.778-1.282 3.9-3.9.056-1.233.066-1.6.066-3.983s-.01-2.75-.066-3.983c-.12-2.61-1.29-3.778-3.9-3.9C15.483 3.975 15.116 3.965 12 3.965zM12 8.25a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5zm0 1.8a1.95 1.95 0 110 3.9 1.95 1.95 0 010-3.9zM16.866 6.33a1.146 1.146 0 100 2.292 1.146 1.146 0 000-2.292z">
                                </path>
                            </svg>
                            <h3 class="text-xl font-bold">Instagram</h3>
                        </div>
                        <p class="text-sm flex-grow">Explore informasi ter-update dan keseruan konten menarik
                            di sosial media yang dikelola Humas Distanhorti Jabar.</p>
                        <a href="https://www.instagram.com/distanhortijabar/"
                            class="inline-flex items-center gap-2 mt-4 text-green font-bold group-hover:text-white transition-all duration-300 ease-in-out">
                            <span>Selengkapnya</span>
                            <x-icon class="material-icons-outlined">arrow_forward</x-icon>
                        </a>
                    </div>
                    {{-- Facebook --}}
                    <div
                        class="group flex flex-col p-6 rounded-2xl text-gray-900 hover:text-white bg-white border border-gray-300 hover:shadow-lg hover:bg-green transition-all duration-300 ease-in-out">
                        <div class="flex items-center mb-2">
                            <svg class="w-8 h-8 mr-3 text-blue-600 bg-white rounded-full p-0.5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z">
                                </path>
                            </svg>
                            <h3 class="text-xl font-bold">Facebook</h3>
                        </div>
                        <p class="text-sm flex-grow">Dapatkan berita singkat, pengumuman penting, dan
                            informasi real-time mengenai sektor pertanian Provinsi Jawa Barat.</p>
                        <a href="https://www.facebook.com/distanhortijabar/"
                            class="inline-flex items-center gap-2 mt-4 text-green font-bold group-hover:text-white transition-all duration-300 ease-in-out">
                            <span>Selengkapnya</span>
                            <x-icon class="material-icons-outlined">arrow_forward</x-icon>
                        </a>
                    </div>
                </div>
                <div class="space-y-8">
                    {{-- Youtube --}}
                    <div
                        class="group flex flex-col p-6 rounded-2xl text-gray-900 hover:text-white bg-white border border-gray-300 hover:shadow-lg hover:bg-green transition-all duration-300 ease-in-out">
                        <div class="flex items-center mb-2">
                            <svg class="w-8 h-8 mr-3 text-red-600 bg-white rounded-full p-0.5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M21.582 7.64s-.19-1.323-.76-1.898c-.73-.74-1.542-.743-1.92-.79C16.9 4.8 12 4.8 12 4.8s-4.9 0-6.902.152c-.378.047-1.19.05-1.92.79-.57.575-.76 1.898-.76 1.898S2.23 9.205 2.23 12s0 4.36.188 5.918c.07.65.26 1.323.76 1.898.73.74 1.64.72 2.11.8C7.1 20.8 12 20.8 12 20.8s4.9 0 6.902-.152c.378-.047 1.19-.05 1.92-.79.57-.575.76-1.898.76-1.898S21.77 14.795 21.77 12s0-4.36-.188-5.918zM9.94 15.6v-7.2l6.06 3.6-6.06 3.6z">
                                </path>
                            </svg>
                            <h3 class="text-xl font-bold">Youtube</h3>
                        </div>
                        <p class="text-sm flex-grow">Saksikan liputan kegiatan, tips pertanian, dan
                            bincang-bincang inspiratif seputar hortikultura langsung dari channel resmi kami.</p>
                        <a href="https://www.youtube.com/@distanhortijabartv"
                            class="inline-flex items-center gap-2 mt-4 text-green font-bold group-hover:text-white transition-all duration-300 ease-in-out">
                            <span>Selengkapnya</span>
                            <x-icon class="material-icons-outlined">arrow_forward</x-icon>
                        </a>
                    </div>
                    {{-- Twitter/X --}}
                    <div
                        class="group flex flex-col p-6 rounded-2xl text-gray-900 hover:text-white bg-white border border-gray-300 hover:shadow-lg hover:bg-green transition-all duration-300 ease-in-out">
                        <div class="flex items-center mb-2">
                            <svg class="w-8 h-8 mr-3 text-gray-800 bg-white rounded-full p-0.5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z">
                                </path>
                            </svg>
                            <h3 class="text-xl font-bold">Twitter</h3>
                        </div>
                        <p class="text-sm flex-grow">Saluran informasi resmi mengenai kebijakan, program, dan
                            regulasi terkini di sektor tanaman pangan dan hortikultura Jawa Barat.</p>
                        <a href="https://x.com/distanhortijbr"
                            class="inline-flex items-center gap-2 mt-4 text-green font-bold group-hover:text-white transition-all duration-300 ease-in-out">
                            <span>Selengkapnya</span>
                            <x-icon class="material-icons-outlined">arrow_forward</x-icon>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
