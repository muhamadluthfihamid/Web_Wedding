<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{
    public function index()
    {
        $story = Story::latest()->first();
        return view('admin.story.index', compact('story'));
    }

    public function create()
    {
        return view('admin.story.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'deskripsi' => 'required',
            'judul_bertemu' => 'required',
            'tgl_bertemu' => 'required|date',
            'note_bertemu' => 'required',
            'foto_bertemu' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'judul_serius' => 'required',
            'tgl_serius' => 'required|date',
            'note_serius' => 'required',
            'foto_serius' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'judul_tunangan' => 'required',
            'tgl_tunangan' => 'required|date',
            'note_tunangan' => 'required',
            'foto_tunangan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $validated;

        // Upload foto bertemu
        if ($request->hasFile('foto_bertemu')) {
            $data['foto_bertemu'] = $request->file('foto_bertemu')->store('stories', 'public');
        }

        // Upload foto serius
        if ($request->hasFile('foto_serius')) {
            $data['foto_serius'] = $request->file('foto_serius')->store('stories', 'public');
        }

        // Upload foto tunangan
        if ($request->hasFile('foto_tunangan')) {
            $data['foto_tunangan'] = $request->file('foto_tunangan')->store('stories', 'public');
        }

        Story::create($data);

        return redirect()->route('story.index')->with('success', 'Story created successfully.');
    }



    public function edit(Story $story)
    {
        return view('admin.story.edit', compact('story'));
    }

    public function update(Request $request, $id)
    {
        $story = Story::findOrFail($id);

        $validated = $request->validate([
            'deskripsi' => 'required',

            'judul_bertemu' => 'required',
            'tgl_bertemu' => 'required|date',
            'note_bertemu' => 'required',
            'foto_bertemu' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'judul_serius' => 'required',
            'tgl_serius' => 'required|date',
            'note_serius' => 'required',
            'foto_serius' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'judul_tunangan' => 'required',
            'tgl_tunangan' => 'required|date',
            'note_tunangan' => 'required',
            'foto_tunangan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $validated;

        // helper function biar tidak duplikat kode
        $handleUpload = function ($field) use ($request, $story, &$data) {
            if ($request->hasFile($field)) {

                // hapus file lama
                if ($story->$field && Storage::disk('public')->exists($story->$field)) {
                    Storage::disk('public')->delete($story->$field);
                }

                // simpan file baru
                $data[$field] = $request->file($field)->store('stories', 'public');
            }
        };

        // panggil untuk masing-masing field
        $handleUpload('foto_bertemu');
        $handleUpload('foto_serius');
        $handleUpload('foto_tunangan');

        $story->update($data);

        return redirect()->route('story.index')
            ->with('success', 'Story berhasil diupdate');
    }

    public function destroy($id)
    {
        $story = Story::findOrFail($id);

        // Hapus foto bertemu
        if ($story->foto_bertemu && Storage::exists('public/' . $story->foto_bertemu)) {
            Storage::delete('public/' . $story->foto_bertemu);
        }

        // Hapus foto serius
        if ($story->foto_serius && Storage::exists('public/' . $story->foto_serius)) {
            Storage::delete('public/' . $story->foto_serius);
        }

        // Hapus foto tunangan
        if ($story->foto_tunangan && Storage::exists('public/' . $story->foto_tunangan)) {
            Storage::delete('public/' . $story->foto_tunangan);
        }

        // Hapus data dari database
        $story->delete();

        return redirect()->route('story.index')->with('success', 'Story berhasil dihapus');
    }
}
