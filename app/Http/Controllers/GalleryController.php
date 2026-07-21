<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $galeries = $user->isSuperAdmin()
            ? Gallery::with(['images', 'pria', 'istri'])->get()
            : Gallery::where('user_id', $user->id)->with(['images', 'pria', 'istri'])->get();

        return view('admin.gallery.index', compact('galeries'));
    }

    public function create()
    {
        $user = auth()->user();
        $infos = $user->isSuperAdmin() ? Info::all() : Info::where('user_id', $user->id)->get();
        return view('admin.gallery.create', compact('infos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_nama_pengantin_istri' => 'required|exists:infos,id',
            'id_nama_pengantin_pria' => 'required|exists:infos,id',
            'deskripsi' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        DB::beginTransaction();

        try {
            $gallery = Gallery::create([
                'user_id' => auth()->id(),
                'id_nama_pengantin_istri' => $request->id_nama_pengantin_istri,
                'id_nama_pengantin_pria' => $request->id_nama_pengantin_pria,
                'deskripsi' => $request->deskripsi,
            ]);

            // upload multiple
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('galeries', 'public');

                    $gallery->images()->create([
                        'path' => $path
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('gallery.index')->with('success', 'Gallery berhasil dibuat');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    // public function show(Gallery $gallery)
    // {
    //     return view('galeries.show', compact('galery'));
    // }

    public function edit(Gallery $gallery)
    {
        $infos = Info::all();
        return view('admin.gallery.edit', compact('gallery', 'infos'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'id_nama_pengantin_istri' => 'required|exists:infos,id',
            'id_nama_pengantin_pria' => 'required|exists:infos,id',
            'deskripsi' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        DB::beginTransaction();

        try {
            // update data utama
            $gallery->update([
                'id_nama_pengantin_istri' => $request->id_nama_pengantin_istri,
                'id_nama_pengantin_pria' => $request->id_nama_pengantin_pria,
                'deskripsi' => $request->deskripsi,
            ]);

            // jika ada upload gambar baru → tambah (bukan replace)
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('galeries', 'public');

                    $gallery->images()->create([
                        'path' => $path
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('gallery.index')->with('success', 'Gallery berhasil diupdate');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Gallery $gallery)
    {
        DB::beginTransaction();

        try {
            // hapus semua file gambar
            foreach ($gallery->images as $image) {
                if ($image->path && Storage::exists('public/' . $image->path)) {
                    Storage::delete('public/' . $image->path);
                }
            }

            // hapus gallery (images ikut kehapus kalau pakai cascade)
            $gallery->delete();

            DB::commit();

            return redirect()->route('gallery.index')->with('success', 'Gallery berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
