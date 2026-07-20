@extends('admin.layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ __('Ucapan Tamu') }}</h1>
        <p class="text-sm text-slate-500 mt-1">Daftar ucapan selamat dan doa restu dari para tamu undangan</p>
    </div>
    
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-[5%]">No.</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-[20%]">Nama Tamu</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-[15%]">Kehadiran</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-[40%]">Ucapan & Doa</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-[10%]">Waktu</th>
                        <th scope="col" class="px-6 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider w-[10%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @if ($wishes->isEmpty())
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center">
                                <div class="text-slate-400 text-sm">Belum ada ucapan tamu yang tersedia.</div>
                            </td>
                        </tr>
                    @else
                        @foreach ($wishes as $wish)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-900">{{ $wish->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $wish->kehadiran ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $wish->kehadiran ? 'Hadir' : 'Tidak Hadir' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600 whitespace-normal break-words max-w-xs">{{ $wish->ucapan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">{{ $wish->created_at->diffForHumans() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                    <form action="{{ route('wish.destroy', $wish->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ucapan ini?');" class="inline-block">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-lg text-xs font-semibold transition-colors">
                                             <i class="fas fa-trash"></i> Hapus
                                         </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
