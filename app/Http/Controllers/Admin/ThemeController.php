<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ThemeController extends Controller
{
    /**
     * Tampilkan daftar tema.
     */
    public function index(Request $request)
    {
        $themes = Theme::query()
            ->when($request->category, fn($q) => $q->where('category', $request->category))
            ->when($request->filled('status'), fn($q) => $q->where('is_active', $request->status))
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->latest()
            ->paginate(12);

        return view('admin.themes.index', compact('themes'));
    }

    /**
     * Form tambah tema baru.
     */
    public function create()
    {
        return view('admin.themes.create');
    }

    /**
     * Simpan tema baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|in:wedding,khitanan',
            'blade_path'  => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'thumbnail'   => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'is_active'   => 'boolean',
        ]);

        $slug = Str::slug($request->name);
        // Pastikan slug unik
        $count = Theme::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug = "{$slug}-" . ($count + 1);
        }

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('themes/thumbnails', 'public');
        }

        Theme::create([
            'name'        => $request->name,
            'slug'        => $slug,
            'category'    => $request->category,
            'blade_path'  => $request->blade_path,
            'description' => $request->description,
            'thumbnail'   => $thumbnailPath,
            'is_active'   => $request->has('is_active'),
        ]);

        return redirect()->route('admin.themes.index')
            ->with('success', 'Tema baru berhasil ditambahkan!');
    }

    /**
     * Form edit tema.
     */
    public function edit(Theme $theme)
    {
        return view('admin.themes.edit', compact('theme'));
    }

    /**
     * Update data tema.
     */
    public function update(Request $request, Theme $theme)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|in:wedding,khitanan',
            'blade_path'  => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'thumbnail'   => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'is_active'   => 'boolean',
        ]);

        $data = [
            'name'        => $request->name,
            'category'    => $request->category,
            'blade_path'  => $request->blade_path,
            'description' => $request->description,
            'is_active'   => $request->has('is_active'),
        ];

        if ($request->hasFile('thumbnail')) {
            if ($theme->thumbnail && Storage::disk('public')->exists($theme->thumbnail)) {
                Storage::disk('public')->delete($theme->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('themes/thumbnails', 'public');
        }

        $theme->update($data);

        return redirect()->route('admin.themes.index')
            ->with('success', 'Tema berhasil diperbarui!');
    }

    /**
     * Hapus tema.
     */
    public function destroy(Theme $theme)
    {
        if ($theme->thumbnail && Storage::disk('public')->exists($theme->thumbnail)) {
            Storage::disk('public')->delete($theme->thumbnail);
        }

        $theme->delete();

        return redirect()->route('admin.themes.index')
            ->with('success', 'Tema berhasil dihapus!');
    }

    /**
     * Toggle status aktif/nonaktif tema.
     */
    public function toggleStatus(Theme $theme)
    {
        $theme->update(['is_active' => !$theme->is_active]);

        $statusLabel = $theme->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()
            ->with('success', "Tema '{$theme->name}' berhasil {$statusLabel}!");
    }
}
