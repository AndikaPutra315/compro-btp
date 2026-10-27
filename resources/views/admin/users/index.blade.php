@extends('layouts.admin')

@section('title', 'Kelola Admin (Super Admin)')

@section('content')
<!-- Header Section -->
<div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
        <div class="flex items-center gap-2 mb-1">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-500/15 text-amber-700 border border-amber-300">
                <svg class="w-3.5 h-3.5 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd"/></svg>
                Khusus Super Administrator
            </span>
        </div>
        <h1 class="text-xl font-bold text-slate-800">Manajemen Pengguna Admin</h1>
        <p class="text-sm text-slate-500 mt-0.5">Pantau akun admin, buatkan akun baru, kelola hak akses, dan lakukan reset password admin.</p>
    </div>
    <a href="{{ route('admin.kelola-admin.create') }}" 
       class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition-all shadow-md hover:shadow-amber-500/30 transform hover:-translate-y-0.5 whitespace-nowrap">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
        Buat Akun Admin Baru
    </a>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Admin</p>
            <h3 class="text-2xl font-extrabold text-slate-800 mt-1">{{ $totalAdmins }}</h3>
            <p class="text-xs text-slate-500 mt-0.5">Semua pengguna berhak akses</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
    </div>
    
    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Super Administrator</p>
            <h3 class="text-2xl font-extrabold text-amber-600 mt-1">{{ $totalSuperAdmins }}</h3>
            <p class="text-xs text-slate-500 mt-0.5">Akses penuh &amp; kelola admin</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd"/></svg>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Admin Biasa</p>
            <h3 class="text-2xl font-extrabold text-slate-700 mt-1">{{ $totalRegularAdmins }}</h3>
            <p class="text-xs text-slate-500 mt-0.5">Kelola konten CMS</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
    </div>
</div>

<!-- Table Container -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <!-- Filter Header -->
    <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-3 bg-slate-50/50">
        <form action="{{ route('admin.kelola-admin.index') }}" method="GET" class="w-full sm:w-96 flex items-center gap-2">
            <div class="relative flex-1">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau email admin..."
                       class="w-full pl-10 pr-12 py-2 text-sm rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all bg-white text-slate-800">
                <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                @if(request('q') || request('role'))
                    <a href="{{ route('admin.kelola-admin.index') }}" class="absolute right-3 top-2.5 text-xs text-slate-400 hover:text-slate-600 bg-slate-100 hover:bg-slate-200 rounded px-1.5 py-0.5">Reset</a>
                @endif
            </div>
            <select name="role" onchange="this.form.submit()" 
                    class="py-2 px-3 text-xs rounded-xl border border-slate-200 bg-white text-slate-700 outline-none focus:border-amber-500">
                <option value="">Semua Role</option>
                <option value="superadmin" {{ request('role') === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin Biasa</option>
            </select>
        </form>
        <div class="text-xs text-slate-500 self-end sm:self-center">
            Menampilkan: <span class="font-bold text-slate-800">{{ $admins->count() }}</span> Akun
        </div>
    </div>

    <!-- Admin Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                    <th class="py-3.5 px-6">Administrator</th>
                    <th class="py-3.5 px-6">Username / Email Login</th>
                    <th class="py-3.5 px-6">Peran / Role</th>
                    <th class="py-3.5 px-6">Dibuat Pada</th>
                    <th class="py-3.5 px-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($admins as $admin)
                <tr class="hover:bg-slate-50/70 transition-colors {{ auth()->id() === $admin->id ? 'bg-amber-50/20' : '' }}">
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full {{ $admin->isSuperAdmin() ? 'bg-gradient-to-tr from-amber-500 to-amber-600 text-white shadow-sm ring-2 ring-amber-400/30' : 'bg-slate-100 text-slate-600 border border-slate-200' }} flex items-center justify-center font-bold text-sm flex-shrink-0">
                                @if($admin->isSuperAdmin())
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd"/></svg>
                                @else
                                    {{ strtoupper(substr($admin->name, 0, 2)) }}
                                @endif
                            </div>
                            <div>
                                <div class="font-bold text-slate-900 flex items-center gap-2">
                                    <span>{{ $admin->name }}</span>
                                    @if(auth()->id() === $admin->id)
                                        <span class="text-[10px] font-bold bg-amber-100 text-amber-800 px-2 py-0.5 rounded-full border border-amber-300">Anda</span>
                                    @endif
                                </div>
                                <span class="text-xs text-slate-400 font-mono">ID: #{{ $admin->id }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span class="font-mono text-slate-700 font-medium select-all">{{ $admin->email }}</span>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        @if($admin->isSuperAdmin())
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-300 shadow-xs">
                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                Super Administrator
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                Administrator
                            </span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-slate-500 text-xs">
                        {{ $admin->created_at ? $admin->created_at->format('d M Y, H:i') : '-' }}
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="inline-flex items-center gap-1.5">
                            <!-- Reset Password Button -->
                            <button type="button" 
                                    onclick="openResetPasswordModal({{ $admin->id }}, '{{ addslashes($admin->name) }}', '{{ addslashes($admin->email) }}')"
                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold text-xs transition-colors"
                                    title="Reset Password Admin">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                <span>Reset PW</span>
                            </button>

                            <!-- Edit Button -->
                            <a href="{{ route('admin.kelola-admin.edit', $admin->id) }}" 
                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 transition-colors"
                               title="Edit Profil Admin">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>

                            <!-- Delete Button -->
                            @if(auth()->id() === $admin->id)
                                <button type="button" 
                                        disabled 
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-300 cursor-not-allowed"
                                        title="Anda tidak dapat menghapus akun Anda sendiri">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            @else
                                <form action="{{ route('admin.kelola-admin.destroy', $admin->id) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun admin \'{{ addslashes($admin->name) }}\' ({{ addslashes($admin->email) }})? Akun yang dihapus tidak dapat dipulihkan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition-colors"
                                            title="Hapus Akun Admin">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center text-slate-500">
                        <p class="font-semibold text-slate-700">Tidak ada admin ditemukan</p>
                        <p class="text-xs text-slate-400 mt-1">Coba kata kunci pencarian lain.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Reset Password -->
<div id="reset-password-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs hidden transition-opacity">
    <div class="bg-white rounded-2xl shadow-2xl border border-slate-100 w-full max-w-md overflow-hidden transform transition-transform">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/70">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 text-base">Reset Password Admin</h3>
                    <p class="text-xs text-slate-500">Tentukan password baru untuk akun ini</p>
                </div>
            </div>
            <button type="button" onclick="closeResetPasswordModal()" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-200/60 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form id="reset-password-form" method="POST" action="" class="p-6 space-y-4">
            @csrf
            
            <div class="bg-slate-50 p-3 rounded-xl border border-slate-200 text-xs">
                <p class="text-slate-500">Target Akun:</p>
                <p class="font-bold text-slate-800 text-sm mt-0.5" id="modal-target-name">-</p>
                <p class="text-slate-600 font-mono mt-0.5" id="modal-target-email">-</p>
            </div>

            <div>
                <label for="new_password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Password Baru <span class="text-red-500">*</span>
                </label>
                <input type="password" name="new_password" id="new_password" required minlength="6"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-sm text-slate-800"
                       placeholder="Minimal 6 karakter">
            </div>

            <div>
                <label for="new_password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Ulangi Password Baru <span class="text-red-500">*</span>
                </label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" required minlength="6"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-sm text-slate-800"
                       placeholder="Ulangi password baru di atas">
            </div>

            <div class="pt-4 flex items-center justify-end gap-2.5 border-t border-slate-100">
                <button type="button" onclick="closeResetPasswordModal()"
                        class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                    Batal
                </button>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl font-semibold text-xs shadow-md transition-all flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Password Baru
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openResetPasswordModal(adminId, name, email) {
    const modal = document.getElementById('reset-password-modal');
    const form = document.getElementById('reset-password-form');
    const nameEl = document.getElementById('modal-target-name');
    const emailEl = document.getElementById('modal-target-email');

    nameEl.textContent = name;
    emailEl.textContent = email;
    form.action = "{{ url('ruang-manajemen/kelola-admin') }}/" + adminId + "/reset-password";
    
    document.getElementById('new_password').value = '';
    document.getElementById('new_password_confirmation').value = '';

    modal.classList.remove('hidden');
}

function closeResetPasswordModal() {
    const modal = document.getElementById('reset-password-modal');
    modal.classList.add('hidden');
}

// Close modal when pressing Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeResetPasswordModal();
    }
});
</script>
@endsection
