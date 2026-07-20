<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InfoController extends Controller
{
    public function index()
    {
        $infos = Info::all();
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
            'mulai_akad' => 'required|date_format:H:i',
            'selesai_akad' => 'required|date_format:H:i',
            'mulai_resepsi' => 'required|date_format:H:i',
            'alamat' => 'required',
            'deskripsi' => 'required',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);
        
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
            'mulai_akad' => 'required|date_format:H:i',
            'selesai_akad' => 'required|date_format:H:i',
            'mulai_resepsi' => 'required|date_format:H:i',
            'alamat' => 'required|string',
            'deskripsi' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $info->update($validated);

        return redirect()
            ->route('info.index')
            ->with('success', 'Info berhasil diperbarui.');
    }


    public function destroy(Info $info)
    {
        // Hapus data yang bergantung terlebih dahulu
        $info->galleries()->delete(); // Misalnya, jika ada relasi dengan model 'Gallery'
        $info->delete();

        return redirect()->route('info.index')->with('success', 'Info deleted successfully.');
    }
}