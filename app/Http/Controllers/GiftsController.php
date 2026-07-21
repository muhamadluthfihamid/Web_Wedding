<?php

namespace App\Http\Controllers;

use App\Models\Gifts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GiftsController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $gifts = ($user && $user->isSuperAdmin()) ? Gifts::all() : Gifts::where('user_id', Auth::id())->get();
        return view('admin.gifts.index', compact('gifts'));
    }

    public function create()
    {
        return view('admin.gifts.create');
    }

    public function store(Request $request)
    {
       $validated = $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'nama_bank' => 'required|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'no_rek' => 'required|numeric',
        ]);

        $data = $validated;
        $data['user_id'] = Auth::id();

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('gambar', 'public');
            $data['gambar'] = $path;
        }

        Gifts::create($data);

        return redirect()->route('gifts.index')->with('success', 'Gift created successfully.');
    }

    // public function show(Gifts $gift)
    // {
    //     return view('gifts.show', compact('gift'));
    // }

    public function edit(Gifts $gift)
    {
        return view('admin.gifts.edit', compact('gift'));
    }

   public function update(Request $request, Gifts $gift)
{
    $validatedData = $request->validate([
        'nama' => 'required|max:255',
        'deskripsi' => 'required',
        'nama_bank' => 'required|max:255',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'no_rek' => 'required|numeric',
    ]);

    if ($request->hasFile('gambar')) {
        // hapus gambar lama
        if ($gift->gambar) {
            Storage::disk('public')->delete($gift->gambar);
        }

        $validatedData['gambar'] = $request->file('gambar')
            ->store('gambar', 'public');
    }

    $gift->update($validatedData);

    return redirect()
        ->route('gifts.index')
        ->with('success', 'Gift updated successfully.');
}


    public function destroy(Gifts $gift)
    {
         // Hapus gambar dari storage jika ada
         if ($gift->gambar) {
            Storage::disk('public')->delete($gift->gambar);
        }

        $gift->delete();

        return redirect()->route('gifts.index')->with('success', 'Gift deleted successfully.');
    }
}