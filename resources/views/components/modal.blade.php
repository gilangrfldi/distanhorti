@props(['id', 'title'])

<!-- Kerangka Modal Generik -->
<div id="{{ $id }}" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Konten Modal -->
        <div class="relative bg-[#FDFBF5] rounded-lg border-2 border-stone-400 ">
            <!-- Header Modal -->

            <div class="flex items-start justify-between p-4 border-b rounded-t border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900">
                    {{ $title }}
                </h3>
                <button type="button"
                    class="text-gray-700 cursor-pointer hover:text-black rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="{{ $id }}">
                    <x-icon>close</x-icon>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Body Modal (Konten akan dimasukkan di sini) -->
            <div class="p-6 space-y-6">
                {{ $slot }}
            </div>

        </div>
    </div>
</div>
