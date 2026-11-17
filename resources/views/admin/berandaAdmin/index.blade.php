@extends('admin.layoutAdmin.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14 space-y-12">
            {{-- Agenda Rapat --}}
            <div class="bg-white/90 border border-black/5 p-4 rounded-lg shadow-lg">
                <div class="flex items-center text-center mb-2">
                    <hr class="flex-grow border-gray-600">
                    <h2 class="px-4 text-xl font-semibold text-black">Agenda Rapat Terbaru</h2>
                    <hr class="flex-grow border-gray-600">
                </div>
                @include('admin.partials._agendaTable', [
                    'agendas' => $agendaRapat,
                    'showActions' => false,
                ])
                @if ($totalAgendas > $agendaRapat->count())
                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('admin.rapatAdmin.index') }}"
                            class="text-blue-600 hover:text-blue-800 px-4 text-sm transition-colors duration-300 ease-in-out">
                            <span class="underline">Lihat Selengkapnya</span>
                        </a>
                    </div>
                @endif
            </div>

            {{-- Janji Temu --}}
            <div class="bg-white/90 border border-black/5 p-4 rounded-lg shadow-lg">
                <div class="flex items-center text-center mb-6">
                    <hr class="flex-grow border-gray-600">
                    <h2 class="px-4 text-xl font-semibold text-black">Janji Temu Terbaru</h2>
                    <hr class="flex-grow border-gray-600">
                </div>
                @include('admin.partials._janjiTemuTable', [
                    'janjiTemus' => $janjiTemus, // 5 data terbaru
                    'showActions' => false, // Tidak menampilkan aksi di dashboard
                ])
                @if ($totalJanjiTemus > $janjiTemus->count())
                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('temuAdmin.index') }}"
                            class="text-blue-600 hover:text-blue-800 px-4 text-sm transition-colors duration-300 ease-in-out">
                            <span class="underline">Lihat Selengkapnya</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
