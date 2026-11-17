<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white shadow-lg sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 flex flex-col justify-between overflow-y-auto ">
        <div>
            <ul class="space-y-2 font-medium">
                <li>
                    <x-link-sidebar :href="route('berandaAdmin')" :active="Route::is('berandaAdmin')" icon="dashboard">Beranda</x-link-sidebar>
                </li>
                <li class="pt-4">
                    <div class="flex items-center px-2 mb-2">
                        <span class="text-xs font-semibold uppercase text-gray-500">Menu</span>
                        <hr class="flex-grow ml-3 border-gray-300">
                    </div>
                    <ul class="space-y-2">
                        <li>
                            <x-link-sidebar :href="route('admin.rapatAdmin.index')" :active="Route::is('admin.rapatAdmin.*')" icon="event">
                                Agenda Rapat
                            </x-link-sidebar>
                        </li>
                        <li>
                            <x-link-sidebar :href="route('temuAdmin.index')" :active="Route::is('temuAdmin.*')" icon="schedule">
                                Janji Temu
                            </x-link-sidebar>
                        </li>
                        <li>
                            <x-link-sidebar :href="route('admin.penggunaAdmin.index')" :active="Route::is('admin.penggunaAdmin.*')" icon="person">
                                Pengguna
                            </x-link-sidebar>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</aside>
