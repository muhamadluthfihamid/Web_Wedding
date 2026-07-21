<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentalPackage;
use Illuminate\Http\Request;

class RentalPackageController extends Controller
{
    public function index()
    {
        $packages = RentalPackage::orderBy('harga')->get();
        return view('admin.rental.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.rental.packages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'        => 'required|string|max:100',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|integer|min:0',
            'durasi_hari' => 'required|integer|min:1',
            'fitur'       => 'nullable|string',
            'warna_badge' => 'required|string',
            'is_aktif'    => 'boolean',
            'is_populer'  => 'boolean',
        ]);

        // Konversi fitur (textarea baris per baris) ke array
        $data['fitur']      = $this->parseFitur($request->fitur);
        $data['is_aktif']   = $request->boolean('is_aktif', true);
        $data['is_populer'] = $request->boolean('is_populer', false);

        RentalPackage::create($data);

        return redirect()->route('admin.rental.packages.index')
            ->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit(RentalPackage $package)
    {
        return view('admin.rental.packages.edit', compact('package'));
    }

    public function update(Request $request, RentalPackage $package)
    {
        $data = $request->validate([
            'nama'        => 'required|string|max:100',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|integer|min:0',
            'durasi_hari' => 'required|integer|min:1',
            'fitur'       => 'nullable|string',
            'warna_badge' => 'required|string',
            'is_aktif'    => 'boolean',
            'is_populer'  => 'boolean',
        ]);

        $data['fitur']      = $this->parseFitur($request->fitur);
        $data['is_aktif']   = $request->boolean('is_aktif', true);
        $data['is_populer'] = $request->boolean('is_populer', false);

        $package->update($data);

        return redirect()->route('admin.rental.packages.index')
            ->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(RentalPackage $package)
    {
        if ($package->orders()->whereIn('status', ['active', 'pending'])->exists()) {
            return back()->with('error', 'Paket tidak bisa dihapus karena masih ada pesanan aktif/pending.');
        }

        $package->delete();
        return redirect()->route('admin.rental.packages.index')
            ->with('success', 'Paket berhasil dihapus.');
    }

    private function parseFitur(?string $raw): array
    {
        if (!$raw) return [];
        return array_filter(array_map('trim', explode("\n", $raw)));
    }
}
