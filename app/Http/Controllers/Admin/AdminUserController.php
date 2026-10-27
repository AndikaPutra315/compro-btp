<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    /**
     * Display a listing of all admin users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('q')) {
            $search = trim($request->input('q'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role') && in_array($request->role, ['admin', 'superadmin'])) {
            $query->where('role', $request->role);
        }

        $admins = $query->orderByRaw("FIELD(role, 'superadmin', 'admin')")->orderBy('name')->get();
        
        $totalAdmins = User::count();
        $totalSuperAdmins = User::where('role', 'superadmin')->count();
        $totalRegularAdmins = User::where('role', 'admin')->count();

        return view('admin.users.index', compact('admins', 'totalAdmins', 'totalSuperAdmins', 'totalRegularAdmins'));
    }

    /**
     * Show the form for creating a new admin account.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created admin in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'role'     => ['required', Rule::in(['admin', 'superadmin'])],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'name.required'     => 'Nama admin wajib diisi.',
            'email.required'    => 'Alamat email/username wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'email.unique'      => 'Email ini sudah digunakan oleh akun lain.',
            'role.required'     => 'Hak akses role wajib dipilih.',
            'role.in'           => 'Pilihan role tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal harus 6 karakter.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'name'     => trim($request->name),
            'email'    => strtolower(trim($request->email)),
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.kelola-admin.index')
            ->with('success', "Akun admin baru ({$request->name}) berhasil dibuat.");
    }

    /**
     * Show the form for editing the specified admin.
     */
    public function edit(string $id)
    {
        $admin = User::findOrFail($id);
        return view('admin.users.edit', compact('admin'));
    }

    /**
     * Update the specified admin account details (name, email, role).
     */
    public function update(Request $request, string $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($admin->id),
            ],
            'role'  => ['required', Rule::in(['admin', 'superadmin'])],
        ], [
            'name.required'  => 'Nama admin wajib diisi.',
            'email.required' => 'Email/username wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email ini sudah digunakan oleh admin lain.',
            'role.required'  => 'Hak akses role wajib dipilih.',
            'role.in'        => 'Pilihan role tidak valid.',
        ]);

        // Prevent current super admin from demoting themselves if they are the only super admin
        if ($admin->id === auth()->id() && $admin->role === 'superadmin' && $request->role !== 'superadmin') {
            $otherSuperAdminCount = User::where('role', 'superadmin')->where('id', '!=', $admin->id)->count();
            if ($otherSuperAdminCount === 0) {
                return back()->with('error', 'Anda adalah satu-satunya Super Admin. Anda tidak dapat mengubah peran Anda sendiri.');
            }
        }

        $admin->update([
            'name'  => trim($request->name),
            'email' => strtolower(trim($request->email)),
            'role'  => $request->role,
        ]);

        return redirect()->route('admin.kelola-admin.index')
            ->with('success', "Data admin {$admin->name} berhasil diperbarui.");
    }

    /**
     * Reset password for an admin by Super Admin.
     */
    public function resetPassword(Request $request, string $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'new_password.required'  => 'Password baru wajib diisi.',
            'new_password.min'       => 'Password baru minimal harus 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $admin->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('admin.kelola-admin.index')
            ->with('success', "Password untuk akun {$admin->name} ({$admin->email}) berhasil di-reset.");
    }

    /**
     * Remove the specified admin from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::findOrFail($id);

        if ($admin->id === auth()->id()) {
            return redirect()->route('admin.kelola-admin.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $adminName = $admin->name;
        $admin->delete();

        return redirect()->route('admin.kelola-admin.index')
            ->with('success', "Akun admin {$adminName} berhasil dihapus.");
    }
}
