<?php

namespace App\Http\Controllers;

use App\Models\BiodataWanita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataWanitaController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $biodataWanita = ($user && $user->isSuperAdmin()) ? BiodataWanita::all() : BiodataWanita::where('user_id', Auth::id())->get();
        return view('admin.wanita.index', compact('biodataWanita'));
    }

    public function create()
    {
        return view('admin.wanita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'ibu' => 'required|string|max:255',
            'bapak' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string',
            'asal' => 'nullable|string|max:255',
        ]);

        $biodataWanita = new BiodataWanita();
        $biodataWanita->user_id = Auth::id();
        $biodataWanita->nama = $validated['nama'];
        $biodataWanita->ibu = $validated['ibu'];
        $biodataWanita->bapak = $validated['bapak'];
        $biodataWanita->deskripsi = $validated['deskripsi'];
        $biodataWanita->asal = $validated['asal'] ?? null;

        if ($request->hasFile('foto')) {
            $biodataWanita->foto = $request->file('foto')->store('foto_wanita', 'public');
        }

        $biodataWanita->save();

        return redirect()->route('biodataWanita.index')->with('success', 'Biodata wanita berhasil ditambahkan.');
    }

    public function show(BiodataWanita $biodataWanita)
    {
        // return view('biodata_Wanita.show', compact('biodataWanita'));
    }

    public function edit(BiodataWanita $biodataWanita)
    {
        return view('admin.wanita.edit', compact('biodataWanita'));
    }

    public function update(Request $request, BiodataWanita $biodataWanita)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'ibu' => 'required|string|max:255',
            'bapak' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string',
            'asal' => 'nullable|string|max:255',
        ]);

        $biodataWanita->fill($validatedData);

        if ($request->hasFile('foto')) {
            $biodataWanita->foto = $request->file('foto')->store('foto_wanita', 'public');
        }

        $biodataWanita->save();

        return redirect()->route('biodataWanita.index')->with('success', 'Biodata wanita berhasil diupdate.');
    }

    public function destroy(BiodataWanita $biodataWanita)
    {
        $biodataWanita->delete();

        return redirect()->route('biodataWanita.index')->with('success', 'Biodata wanita berhasil dihapus.');
    }
}