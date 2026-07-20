<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guests = Guest::orderBy('created_at', 'desc')->get();
        return view('admin.guests.index', compact('guests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'no_hp' => 'nullable|max:20',
            'keterangan' => 'nullable|max:255',
        ]);

        Guest::create($validated);

        return redirect()->route('guests.index')->with('success', 'Tamu berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guest = Guest::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|max:255',
            'no_hp' => 'nullable|max:20',
            'keterangan' => 'nullable|max:255',
        ]);

        $guest->update($validated);

        return redirect()->route('guests.index')->with('success', 'Data tamu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();

        return redirect()->route('guests.index')->with('success', 'Tamu berhasil dihapus.');
    }
}
