<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private const AVAILABLE_ROLES = [
        'kader',
        'bidan_desa',
        'orang_tua',
    ];

    public function index(Request $request)
    {
        $search = $request->search;
        $role = $request->role;

        $users = User::with('roles')
            ->withCount('anak')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($role, function ($query) use ($role) {
                $query->role($role);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $roles = Role::whereIn('name', self::AVAILABLE_ROLES)
            ->orderBy('name')
            ->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::whereIn('name', self::AVAILABLE_ROLES)
            ->orderBy('name')
            ->get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'role' => ['required', Rule::in(self::AVAILABLE_ROLES)],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->syncRoles([$validated['role']]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data user berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        $user->load('roles', 'anak');

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $user->load('roles');

        $roles = Role::whereIn('name', self::AVAILABLE_ROLES)
            ->orderBy('name')
            ->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'role' => ['required', Rule::in(self::AVAILABLE_ROLES)],
        ]);

        $payload = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (! empty($validated['password'])) {
            $payload['password'] = Hash::make($validated['password']);
        }

        $user->update($payload);
        $user->syncRoles([$validated['role']]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ((int) $user->id === (int) auth()->id()) {
            return back()->with('success', 'Akun yang sedang digunakan tidak bisa dihapus.');
        }

        $user->delete();

        return back()->with('success', 'Data user berhasil dihapus.');
    }
}
