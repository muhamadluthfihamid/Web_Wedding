@extends('admin.layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Konfirmasi Kehadiran (RSVP)</h1>
            <p class="text-sm text-slate-500 mt-1">Daftar tamu yang telah mengonfirmasi kehadiran mereka</p>
        </div>
        <div class="flex items-center gap-2 flex-wrap sm:flex-nowrap">
            <a href="{{ route('rsvp.exportCsv') }}" 
               class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 border border-slate-300 rounded-lg shadow-sm text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                <i class="fas fa-file-csv text-emerald-600"></i> Export CSV
            </a>
            <a class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors" 
               href="{{ route('rsvp.create') }}" title="Tambah RSVP" role="button">
                <i class="fas fa-plus"></i> Tambah RSVP
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-[5%]">No.</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Tamu</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-[15%]">Kehadiran</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-[10%]">Jumlah</th>
                        <th scope="col" class="px-6 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider w-[20%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @if ($rsvps->isEmpty())
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center">
                                <div class="text-slate-400 text-sm">Belum ada konfirmasi kehadiran (RSVP) yang masuk.</div>
                            </td>
                        </tr>
                    @else
                        @foreach ($rsvps as $rsvp)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-900">{{ $rsvp->nama_tamu }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $rsvp->kehadiran ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $rsvp->kehadiran ? 'Hadir' : 'Tidak Hadir' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $rsvp->jumlah }} Orang</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('rsvp.edit', $rsvp) }}" 
                                           class="inline-flex items-center gap-1 px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 rounded-lg text-xs font-semibold transition-colors">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('rsvp.destroy', $rsvp) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data RSVP ini?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-lg text-xs font-semibold transition-colors">
                                                <i class="fas fa-trash"></i> Hapus
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
