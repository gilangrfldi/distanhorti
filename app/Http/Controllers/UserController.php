<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.penggunaAdmin.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat pengguna baru.
     */
    public function create()
    {
        return view('admin.penggunaAdmin.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'instansi' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'instansi' => $request->instansi,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.penggunaAdmin.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    public function edit(User $pengguna)
    {
        return view('admin.penggunaAdmin.form', ['user' => $pengguna]);
    }

    public function update(Request $request, User $pengguna)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class . ',email,' . $pengguna->id],
            'instansi' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $pengguna->update([
            'name' => $request->name,
            'email' => $request->email,
            'instansi' => $request->instansi,
        ]);

        $pengguna->fill($request->only(['name', 'email', 'instansi']));
        if ($request->filled('password')) {
            $pengguna->update(['password' => Hash::make($request->password)]);
        }

        if (!$pengguna->isDirty()) {
            return redirect()->route('admin.penggunaAdmin.index')->with('info', 'Tidak ada perubahan data yang disimpan.');
        }
        $pengguna->save();
        return redirect()->route('admin.penggunaAdmin.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(User $penggunaAdmin)
    {
        if (Auth::id() == $penggunaAdmin->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $penggunaAdmin->delete();

        return redirect()->route('admin.penggunaAdmin.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
