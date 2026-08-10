@extends('admin.layouts.admin')

@section('main-content')
<!-- Page Heading -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Daftar Turut Mengundang</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola daftar keluarga, tokoh, atau kerabat yang turut mengundang dalam acara pernikahan Anda</p>
    </div>
    <div class="flex-shrink-0">
        <a href="{{ route('turutMengundang.create') }}"
            class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
            <i class="fas fa-plus"></i> Tambah Nama
        </a>
    </div>
</div>

{{-- Flash Message --}}
@if (session('success'))
<div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm" role="alert">
    <div class="flex items-center gap-3">
        <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
        <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
    </div>
</div>
@endif

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50/50">
                <tr>
                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-[5%]">No.</th>
                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama / Keluarga</th>
                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Hubungan / Keterangan</th>
                    <th scope="col" class="px-6 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider w-[10%]">Urutan</th>
                    <th scope="col" class="px-6 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider w-[20%]">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @if ($turutMengundangs->isEmpty())
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="text-slate-400 text-sm flex flex-col items-center justify-center gap-2">
                            <i class="fas fa-users-rectangle text-4xl text-slate-300 mb-2"></i>
                            <span>Belum ada data Turut Mengundang. Klik "Tambah Nama" untuk menambahkan.</span>
                        </div>
                    </td>
                </tr>
                @else
                @foreach ($turutMengundangs as $item)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-900">{{ $item->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                        @if ($item->hubungan)
                        <span class="inline-flex items-center gap-1 bg-slate-100 text-slate-700 px-2.5 py-1 rounded-md text-xs font-medium border border-slate-200">
                            {{ $item->hubungan }}
                        </span>
                        @else
                        <span class="text-xs text-slate-400 font-normal italic">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-mono font-semibold text-slate-700">
                        {{ $item->urutan }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('turutMengundang.edit', $item) }}"
                                class="inline-flex items-center justify-center p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg text-xs font-semibold transition-colors"
                                title="Edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('turutMengundang.destroy', $item) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus nama ini?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center justify-center p-2 text-rose-600 hover:bg-rose-50 rounded-lg text-xs font-semibold transition-colors"
                                    title="Hapus">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection