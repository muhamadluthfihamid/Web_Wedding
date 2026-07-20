<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use Illuminate\Http\Request;

class WishController extends Controller
{
    public function index()
    {
        $wishes = Wish::latest()->get();
        return view('admin.wish.index', compact('wishes'));
    }

    public function storePublic(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'kehadiran' => 'required|in:1,0,true,false,Hadir,Tidak Hadir',
            'ucapan' => 'required|string|max:1000'
        ];

        $data = $request->all();
        if (isset($data['kehadiran'])) {
            if ($data['kehadiran'] === 'Hadir' || $data['kehadiran'] === '1' || $data['kehadiran'] === 1 || $data['kehadiran'] === 'true') {
                $data['kehadiran'] = true;
            } else {
                $data['kehadiran'] = false;
            }
        }

        $validated = validator($data, $rules)->validate();

        $wish = Wish::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Ucapan selamat berhasil dikirim!',
                'data' => [
                    'nama' => $wish->nama,
                    'kehadiran' => $wish->kehadiran ? 'Hadir' : 'Tidak Hadir',
                    'ucapan' => $wish->ucapan,
                    'created_at' => $wish->created_at->diffForHumans()
                ]
            ]);
        }

        return redirect()->back()->with('success', 'Ucapan selamat berhasil dikirim!');
    }

    public function destroy(Wish $wish)
    {
        $wish->delete();
        return redirect()->route('wish.index')->with('success', 'Ucapan berhasil dihapus.');
    }
}
