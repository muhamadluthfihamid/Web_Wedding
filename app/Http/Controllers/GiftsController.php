<?php

namespace App\Http\Controllers;

use App\Models\Gifts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'deskripsi' => 'nullable|string',
            'nama_bank' => 'required|max:255',
            'no_rek' => 'required|string|max:255',
            'bg_color' => 'nullable|string|max:50',
        ]);

        $data = $validated;
        $data['user_id'] = Auth::id();

        Gifts::create($data);

        return redirect()->route('gifts.index')->with('success', 'Data hadiah/rekening berhasil ditambahkan.');
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
        'deskripsi' => 'nullable|string',
        'nama_bank' => 'required|max:255',
        'no_rek' => 'required|string|max:255',
        'bg_color' => 'nullable|string|max:50',
    ]);

    $gift->update($validatedData);

    return redirect()
        ->route('gifts.index')
        ->with('success', 'Data hadiah/rekening berhasil diperbarui.');
}


    public function destroy(Gifts $gift)
    {
        $gift->delete();

        return redirect()->route('gifts.index')->with('success', 'Data hadiah/rekening berhasil dihapus.');
    }
}