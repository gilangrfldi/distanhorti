<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-gray-100">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <h1 class="text-4xl mb-8 font-bold">Login Admin</h1>
        <div class="card border p-8 bg-white shadow-md rounded-lg max-w-md w-full">
            <form action="{{ route('loginAdmin.submit') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-md font-medium text-gray-900">Email</label>
                    <input type="email" id="email" name="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg block w-full p-2.5"
                        placeholder="admin@dinas.go.id" required value="{{ old('email') }}" autofocus />
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-md font-medium text-gray-900">Kata Sandi</label>
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg block w-full p-2.5"
                        placeholder="••••••••" required />
                </div>

                @error('email')
                    <div class="text-red-500 text-sm mb-4">{{ $message }}</div>
                @enderror

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md w-full px-5 py-2.5 text-center">
                    Login
                </button>
            </form>

        </div>
    </div>
</body>

</html>
