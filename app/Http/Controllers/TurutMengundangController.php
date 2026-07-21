<?php

namespace App\Http\Controllers;

use App\Models\TurutMengundang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TurutMengundangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $turutMengundangs = $user->isSuperAdmin()
            ? TurutMengundang::with('user')->orderBy('urutan', 'asc')->orderBy('created_at', 'asc')->get()
            : TurutMengundang::where('user_id', $user->id)->orderBy('urutan', 'asc')->orderBy('created_at', 'asc')->get();

        return view('admin.turut_mengundang.index', compact('turutMengundangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.turut_mengundang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'hubungan' => 'nullable|string|max:255',
            'urutan'   => 'nullable|integer|min:0',
        ]);

        TurutMengundang::create([
            'user_id'  => Auth::id(),
            'nama'     => $request->nama,
            'hubungan' => $request->hubungan,
            'urutan'   => $request->urutan ?? 0,
        ]);

        return redirect()->route('turutMengundang.index')
            ->with('success', 'Nama Turut Mengundang berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TurutMengundang $turutMengundang)
    {
        return view('admin.turut_mengundang.edit', compact('turutMengundang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TurutMengundang $turutMengundang)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'hubungan' => 'nullable|string|max:255',
            'urutan'   => 'nullable|integer|min:0',
        ]);

        $turutMengundang->update([
            'nama'     => $request->nama,
            'hubungan' => $request->hubungan,
            'urutan'   => $request->urutan ?? 0,
        ]);

        return redirect()->route('turutMengundang.index')
            ->with('success', 'Nama Turut Mengundang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TurutMengundang $turutMengundang)
    {
        $turutMengundang->delete();

        return redirect()->route('turutMengundang.index')
            ->with('success', 'Nama Turut Mengundang berhasil dihapus.');
    }
}
