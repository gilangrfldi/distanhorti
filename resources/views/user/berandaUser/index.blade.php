@extends('user.layoutUser.app')

@section('title', 'Beranda - Website Resmi Dinas ...')

@section('content')
    <div class="relative">
        <div class="container mx-auto px-4 lg:-mt-28">
            <div class="grid grid-cols-1 lg:grid-cols-12 items-center gap-10">
                <!-- Kiri -->
                <div class="order-2 lg:order-1 lg:col-span-6">
                    <div class="">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block">Dinas <span class="text-green">Tanaman</span></span>
                            <span class="block text-green">Pangan <span class="text-gray-900">dan</span><br>
                                Hortikultura</span>
                            <span class="block xl:inline">Provinsi Jawa Barat</span>
                        </h1>
                        <p class="mt-5 text-slate-600 text-base sm:text-lg lg:text-xl max-w-xl">
                            Distanhorti Jabar bertugas mengelola kebijakan, koordinasi, dan pelaksanaan urusan tanaman
                            pangan dan hortikultura, termasuk produksi, sarana-prasarana, dan penyuluhan.
                        </p>
                        <div class="mt-8 flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('rapatUser') }}"
                                class="inline-flex items-center justify-center rounded-full px-8 py-3 text-base font-semibold text-white bg-yellow-400 border border-yellow-400 hover:bg-white hover:text-yellow-400 transition-all duration-300 ease-in-out">
                                Agenda Rapat
                            </a>
                            <a href="{{ route('temuUser.create') }}"
                                class="inline-flex items-center justify-center rounded-full px-8 py-3 text-base font-semibold text-green border border-green bg-white hover:bg-green hover:text-white transition-all duration-300 ease-in-out">
                                Janji Temu
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Kanan -->
                <div class="order-1 lg:order-2 lg:col-span-6 justify-self-end">
                    <div
                        class="relative overflow-hidden rounded-tl-[96px] rounded-bl-[96px] rounded-tr-[24px] rounded-br-[24px]">
                        <img src="{{ asset('images/beranda.png') }}" alt="Gedung Kantor"
                            class="block ml-auto w-full md:w-[75%] h-auto object-cover" />
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
