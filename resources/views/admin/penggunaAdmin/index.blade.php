@extends('admin.layoutAdmin.app')

@section('title', 'Kelola Pengguna')
@section('page-title', 'Kelola Pengguna')

@section('content')
    <div class="p-4 sm:ml-64 mt-14">
        <div class="bg-white/90 border border-black/5 p-4 rounded-lg shadow-lg">
            <div class="flex items-center text-center mb-2">
                <hr class="flex-grow border-gray-600">
                <h2 class="px-4 text-xl font-bold text-black">Daftar Pengguna</h2>
                <hr class="flex-grow border-gray-600">
            </div>
            <div class="flex justify-between items-center mb-4">
                <button type="button" data-modal-target="tambah-modal" data-modal-show="tambah-modal"
                    class="bg-green/80 hover:bg-green text-white font-bold py-2 px-4 rounded cursor-pointer">
                    + Tambah Pengguna
                </button>
            </div>
            <div class="relative overflow-x-auto sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs font-bold text-white uppercase bg-green">
                        <tr>
                            <th scope="col" class="px-6 py-3">#</th>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Instansi</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="border-t border-gray-200 hover:bg-gray-50">
                                <th class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</th>
                                <td class="px-6 py-4">
                                    <div class="text-base font-semibold">{{ $user->name }}</div>
                                    <div class="font-normal text-gray-500">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4">{{ $user->instansi ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                        {{ ucfirst($user->status) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-4">
                                        <x-tombol-edit :modalTarget="'edit-modal-' . $user->id">
                                            Edit
                                        </x-tombol-edit>
                                        <x-tombol-hapus :action="route('admin.penggunaAdmin.destroy', $user->id)">Hapus</x-tombol-hapus>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit untuk setiap user -->
                            <x-modal :id="'edit-modal-' . $user->id" :title="'Edit Data: ' . $user->name">
                                <form action="{{ route('admin.penggunaAdmin.update', $user->id) }}" method="POST"
                                    class="edit-user-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="name-{{ $user->id }}"
                                                class="block mb-2 text-sm font-medium">Nama Lengkap</label>
                                            <input type="text" name="name" id="name-{{ $user->id }}"
                                                value="{{ old('name', $user->name) }}"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                                required>
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="email-{{ $user->id }}"
                                                class="block mb-2 text-sm font-medium">Email</label>
                                            <input type="email" name="email" id="email-{{ $user->id }}"
                                                value="{{ old('email', $user->email) }}"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                                required>
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="instansi-{{ $user->id }}"
                                                class="block mb-2 text-sm font-medium">Instansi</label>
                                            <input type="text" name="instansi" id="instansi-{{ $user->id }}"
                                                value="{{ old('instansi', $user->instansi) }}"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            {{-- Kolom kosong untuk merapikan layout --}}
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="password-{{ $user->id }}"
                                                class="block mb-2 text-sm font-medium">Password Baru</label>
                                            {{-- Hapus atribut 'value' agar selalu kosong --}}
                                            <input type="password" name="password" id="password-{{ $user->id }}"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 password-input"
                                                placeholder="••••••••">
                                            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah.</p>
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="password_confirmation-{{ $user->id }}"
                                                class="block mb-2 text-sm font-medium">Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation"
                                                id="password_confirmation-{{ $user->id }}"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 password-confirm-input"
                                                placeholder="••••••••">
                                            {{-- Tempat untuk pesan error --}}
                                            <p class="text-xs text-red-500 mt-1 password-error-message hidden">Password
                                                tidak cocok.</p>
                                        </div>
                                    </div>
                                    <x-modal-footer>
                                        {{-- Tambahkan class 'submit-button' untuk target JavaScript --}}
                                        <button type="submit"
                                            class="submit-button text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:bg-gray-400 disabled:cursor-not-allowed">
                                            Simpan Perubahan
                                        </button>
                                    </x-modal-footer>
                                </form>
                            </x-modal>
                        @empty
                            <tr class="bg-white border-b">
                                <td colspan="5" class="px-6 py-4 text-center">Tidak ada data pengguna.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $users->links() }} {{-- Untuk pagination --}}
            </div>
        </div>
        <x-modal id="tambah-modal" title="Tambah Pengguna Baru">
            <form action="{{ route('admin.penggunaAdmin.index') }}" method="POST">
                @csrf
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="name-tambah" class="block mb-2 text-sm font-medium">Nama Lengkap</label>
                        <input type="text" name="name" id="name-tambah" value="{{ old('name') }}"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            required>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email-tambah" class="block mb-2 text-sm font-medium">Email</label>
                        <input type="email" name="email" id="email-tambah" value="{{ old('email') }}"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            required>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="instansi-tambah" class="block mb-2 text-sm font-medium">Instansi</label>
                        <input type="text" name="instansi" id="instansi-tambah" value="{{ old('instansi') }}"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="password-tambah" class="block mb-2 text-sm font-medium">Password</label>
                        <input type="password" name="password" id="password-tambah"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            placeholder="••••••••" required>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="password_confirmation-tambah" class="block mb-2 text-sm font-medium">Konfirmasi
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation-tambah"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            placeholder="••••••••" required>
                    </div>
                </div>
                <x-modal-footer>
                    <x-tombol-simpan>Simpan Pengguna</x-tombol-simpan>
                </x-modal-footer>
            </form>
        </x-modal>
    </div>
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
            <div
                class="flex items-center w-full max-w-sm p-4 space-x-4 text-gray-600 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow-lg">
                <div class="text-green-500">
                    <x-icon class="text-3xl">check_circle</x-icon>
                </div>
                <div class="ps-4 text-md font-semibold">{{ session('success') }}</div>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
            <div
                class="flex items-center w-full max-w-sm p-4 space-x-4 text-gray-600 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow-lg">
                <div class="text-red-500">
                    <x-icon class="text-3xl">cancel</x-icon>
                </div>
                <div class="ps-4 text-md font-semibold">{{ session('error') }}</div>
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" {{-- Beri waktu lebih lama untuk dibaca --}} x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
            <div
                class="flex items-center w-full max-w-sm p-4 space-x-4 text-gray-600 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow-lg">
                <div class="text-red-500">
                    <x-icon class="text-3xl">warning</x-icon>
                </div>
                <div class="ps-4 text-md font-semibold">Oops! Terjadi kesalahan validasi.</div>
            </div>
        </div>
    @endif
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.edit-user-form');
            forms.forEach(form => {
                const passwordInput = form.querySelector('.password-input');
                const confirmInput = form.querySelector('.password-confirm-input');
                const errorMessage = form.querySelector('.password-error-message');
                const submitButton = form.querySelector('.submit-button');
                if (passwordInput && confirmInput && errorMessage && submitButton) {
                    const validatePassword = () => {
                        const password = passwordInput.value;
                        const confirmPassword = confirmInput.value;
                        if (password === '' && confirmPassword === '') {
                            errorMessage.classList.add('hidden');
                            submitButton.disabled = false;
                            return;
                        }
                        if (password !== confirmPassword) {
                            errorMessage.classList.remove('hidden');
                            submitButton.disabled = true;
                        } else {
                            errorMessage.classList.add('hidden');
                            submitButton.disabled = false;
                        }
                    };
                    passwordInput.addEventListener('input', validatePassword);
                    confirmInput.addEventListener('input', validatePassword);
                }
            });
        });
    </script>
@endpush
