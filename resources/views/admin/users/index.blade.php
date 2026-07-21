@extends('admin.layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ __('Kelola User') }}</h1>
            <p class="text-sm text-slate-500 mt-1">Daftar semua pengguna yang terdaftar di platform Luiz-Wedding</p>
        </div>
        <div class="flex-shrink-0">
            <a class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors" 
               href="{{ route('users.create') }}" title="Tambah User" role="button">
                <i class="fas fa-user-plus"></i> Tambah User
            </a>
        </div>
    </div>



    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-[5%]">No.</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Lengkap</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-[15%]">Role</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-[20%]">Tanggal Daftar</th>
                        <th scope="col" class="px-6 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider w-[15%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @if ($users->isEmpty())
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center">
                                <div class="text-slate-400 text-sm">Belum ada data user.</div>
                            </td>
                        </tr>
                    @else
                        @foreach ($users as $index => $user)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-900">
                                    {{ $user->full_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($user->isSuperAdmin())
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-50 text-rose-700">Superadmin</span>
                                    @elseif($user->isAdmin())
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">Admin</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700">User</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    {{ $user->created_at->translatedFormat('d F Y, H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                     <div class="flex items-center justify-center gap-2">
                                         <a href="{{ route('users.edit', $user->id) }}" 
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 rounded-lg text-xs font-semibold transition-colors">
                                             <i class="fas fa-edit"></i> Edit
                                         </a>

                                         <button type="button"
                                                 class="inline-flex items-center gap-1 px-3 py-1.5 bg-violet-50 hover:bg-violet-100 text-violet-700 rounded-lg text-xs font-semibold transition-colors btn-reset-password"
                                                 data-id="{{ $user->id }}"
                                                 data-name="{{ $user->full_name }}"
                                                 data-url="{{ route('users.resetPassword', $user->id) }}">
                                             <i class="fas fa-key"></i> Reset PW
                                         </button>
                                         
                                         @if(auth()->id() !== $user->id)
                                             <button type="button" 
                                                     class="inline-flex items-center gap-1 px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-lg text-xs font-semibold transition-colors btn-delete" 
                                                     data-id="{{ $user->id }}" 
                                                     data-name="{{ $user->full_name }}">
                                                 <i class="fas fa-trash"></i> Hapus
                                             </button>
                                         @else
                                             <button class="inline-flex items-center gap-1 px-3 py-1.5 bg-slate-100 text-slate-400 rounded-lg text-xs font-semibold cursor-not-allowed" 
                                                     disabled 
                                                     title="Anda tidak bisa menghapus akun sendiri">
                                                 <i class="fas fa-ban"></i> Hapus
                                             </button>
                                         @endif
                                     </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30 flex justify-center">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ─── HAPUS USER ─── */
            document.querySelectorAll('.btn-delete').forEach(function(button) {
                button.addEventListener('click', function() {
                    var userId   = this.getAttribute('data-id');
                    var userName = this.getAttribute('data-name');
                    var row      = this.closest('tr');

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "User " + userName + " akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('/admin/users/' + userId, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ _method: 'DELETE' })
                            })
                            .then(r => r.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Terhapus!', data.message, 'success');
                                    row.style.transition = 'opacity 0.5s';
                                    row.style.opacity = '0';
                                    setTimeout(() => location.reload(), 1000);
                                } else {
                                    Swal.fire('Gagal!', data.message || 'Terjadi kesalahan.', 'error');
                                }
                            })
                            .catch(() => Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus user.', 'error'));
                        }
                    });
                });
            });

            /* ─── RESET PASSWORD ─── */
            document.querySelectorAll('.btn-reset-password').forEach(function(button) {
                button.addEventListener('click', function() {
                    var userName = this.getAttribute('data-name');
                    var url      = this.getAttribute('data-url');

                    Swal.fire({
                        title: '<i class="fas fa-key text-violet-600"></i> Reset Password',
                        html: `
                            <p class="text-sm text-slate-500 mb-4">Reset password untuk <strong>${userName}</strong></p>
                            <div class="text-left space-y-3">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-600 mb-1">Password Baru <span class="text-rose-500">*</span></label>
                                    <div class="relative">
                                        <input id="swal-new-password" type="password"
                                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-violet-400 pr-10"
                                            placeholder="Minimal 8 karakter">
                                        <button type="button" onclick="toggleSwalEye('swal-new-password','swal-eye-1')"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-violet-500">
                                            <i id="swal-eye-1" class="fas fa-eye text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-600 mb-1">Konfirmasi Password <span class="text-rose-500">*</span></label>
                                    <div class="relative">
                                        <input id="swal-confirm-password" type="password"
                                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-violet-400 pr-10"
                                            placeholder="Ulangi password baru">
                                        <button type="button" onclick="toggleSwalEye('swal-confirm-password','swal-eye-2')"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-violet-500">
                                            <i id="swal-eye-2" class="fas fa-eye text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="swal-error" class="hidden text-xs text-rose-600 font-medium"></div>
                            </div>
                        `,
                        showCancelButton: true,
                        confirmButtonText: '<i class="fas fa-save"></i> Simpan Password',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#7c3aed',
                        cancelButtonColor: '#6b7280',
                        focusConfirm: false,
                        preConfirm: () => {
                            const newPw  = document.getElementById('swal-new-password').value;
                            const confPw = document.getElementById('swal-confirm-password').value;
                            const errEl  = document.getElementById('swal-error');

                            if (!newPw || !confPw) {
                                errEl.textContent = 'Semua field wajib diisi.';
                                errEl.classList.remove('hidden');
                                return false;
                            }
                            if (newPw.length < 8) {
                                errEl.textContent = 'Password minimal 8 karakter.';
                                errEl.classList.remove('hidden');
                                return false;
                            }
                            if (newPw !== confPw) {
                                errEl.textContent = 'Konfirmasi password tidak cocok.';
                                errEl.classList.remove('hidden');
                                return false;
                            }
                            errEl.classList.add('hidden');
                            return { new_password: newPw, new_password_confirmation: confPw };
                        }
                    }).then((result) => {
                        if (result.isConfirmed && result.value) {
                            fetch(url, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(result.value)
                            })
                            .then(r => r.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Berhasil!', data.message, 'success');
                                } else {
                                    Swal.fire('Gagal!', data.errors ? Object.values(data.errors).flat().join('<br>') : (data.message || 'Terjadi kesalahan.'), 'error');
                                }
                            })
                            .catch(() => Swal.fire('Gagal!', 'Terjadi kesalahan saat mereset password.', 'error'));
                        }
                    });
                });
            });
        });

        function toggleSwalEye(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon  = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
@endpush
