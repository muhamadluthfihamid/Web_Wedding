<?php

namespace App\Http\Controllers;

use App\Models\BiodataPria;
use Illuminate\Http\Request;

class BiodataPriaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $biodataPria = $user->isSuperAdmin() ? BiodataPria::all() : BiodataPria::where('user_id', $user->id)->get();
        return view('admin.pria.index', compact('biodataPria'));
    }

    public function create()
    {
        return view('admin.pria.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'ibu' => 'required|string|max:255',
            'bapak' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string',
            'asal' => 'nullable|string|max:255',
        ]);

        $biodataPria = new BiodataPria();
        $biodataPria->user_id = auth()->id();
        $biodataPria->nama = $validatedData['nama'];
        $biodataPria->ibu = $validatedData['ibu'];
        $biodataPria->bapak = $validatedData['bapak'];
        $biodataPria->deskripsi = $validatedData['deskripsi'];
        $biodataPria->asal = $validatedData['asal'] ?? null;

        if ($request->hasFile('foto')) {
            $biodataPria->foto = $request->file('foto')->store('foto_pria', 'public');
        }

        $biodataPria->save();

        return redirect()->route('biodataPria.index')->with('success', 'Biodata pria berhasil ditambahkan.');
    }

    public function show(BiodataPria $biodataPria)
    {
        return view('admin.pria.index', compact('biodataPria'));
    }

    public function edit(BiodataPria $biodataPria)
    {
        return view('admin.pria.edit', compact('biodataPria'));
    }

    public function update(Request $request, BiodataPria $biodataPria)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'ibu' => 'required|string|max:255',
            'bapak' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string',
            'asal' => 'nullable|string|max:255',
        ]);

        $biodataPria->fill($validatedData);

        if ($request->hasFile('foto')) {
            $biodataPria->foto = $request->file('foto')->store('foto_pria', 'public');
        }

        $biodataPria->save();

        return redirect()->route('biodataPria.index')->with('success', 'Biodata pria berhasil diupdate.');
    }

    public function destroy(BiodataPria $biodataPria)
    {
        $biodataPria->delete();

        return redirect()->route('biodataPria.index')->with('success', 'Biodata pria berhasil dihapus.');
    }
}
