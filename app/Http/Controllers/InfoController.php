<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InfoController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $infos = $user->isSuperAdmin() ? Info::all() : Info::where('user_id', $user->id)->get();
        return view('admin.info.index', compact('infos'));
    }

    public function create()
    {
        return view('admin.info.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pengantin_istri' => 'required',
            'nama_pengantin_pria' => 'required',
            'tanggal_pernikahan' => 'required|date',
            'mulai_akad'   => 'required|date_format:H:i,H:i:s',
            'selesai_akad' => 'required|date_format:H:i,H:i:s',
            'mulai_resepsi'=> 'required|date_format:H:i,H:i:s',
            'alamat' => 'required',
            'deskripsi' => 'required',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'teks_arab'     => 'nullable|string',
            'salam_pembuka' => 'nullable|string|max:255',
            'teks_pembuka' => 'nullable|string',
            'teks_penutup' => 'nullable|string',
            'salam_penutup' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();
        
        Info::create($validated);

        return redirect()->route('info.index')->with('success', 'Info created successfully.');
    }



    public function edit(Info $info)
    {
        return view('admin.info.edit', compact('info'));
    }

    public function update(Request $request, Info $info)
    {
        $validated = $request->validate([
            'nama_pengantin_istri' => 'required|string|max:255',
            'nama_pengantin_pria' => 'required|string|max:255',
            'tanggal_pernikahan' => 'required|date',
            'mulai_akad'   => 'required|date_format:H:i,H:i:s',
            'selesai_akad' => 'required|date_format:H:i,H:i:s',
            'mulai_resepsi'=> 'required|date_format:H:i,H:i:s',
            'alamat' => 'required|string',
            'deskripsi' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'teks_arab'     => 'nullable|string',
            'salam_pembuka' => 'nullable|string|max:255',
            'teks_pembuka' => 'nullable|string',
            'teks_penutup' => 'nullable|string',
            'salam_penutup' => 'nullable|string|max:255',
        ]);

        $info->update($validated);

        return redirect()
            ->route('info.index')
            ->with('success', 'Info berhasil diperbarui.');
    }


    public function destroy(Info $info)
    {
        // Hapus data galeri yang bergantung terlebih dahulu
        \App\Models\Gallery::where('id_nama_pengantin_pria', $info->id)
            ->orWhere('id_nama_pengantin_istri', $info->id)
            ->delete();

        $info->delete();

        return redirect()->route('info.index')->with('success', 'Info deleted successfully.');
    }
}