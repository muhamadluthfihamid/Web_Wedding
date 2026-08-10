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
            'nama'      => 'required|string|max:255',
            'kehadiran' => 'required|in:1,0,true,false,Hadir,Tidak Hadir',
            'jumlah'    => 'nullable|integer|min:1|max:10',
            'ucapan'    => 'required|string|max:1000'
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

        // 1. Create Wish record (feed)
        $wish = Wish::create([
            'nama'      => $validated['nama'],
            'kehadiran' => $validated['kehadiran'],
            'ucapan'    => $validated['ucapan'],
        ]);

        // 2. Also create RSVP record (admin notification & tracking)
        try {
            \App\Models\Rsvp::create([
                'nama_tamu' => $validated['nama'],
                'jumlah'    => $validated['jumlah'] ?? 1,
                'kehadiran' => $validated['kehadiran'],
            ]);
        } catch (\Throwable $e) {
            // silent fallback
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Konfirmasi kehadiran & ucapan doa berhasil dikirim!',
                'data'    => [
                    'nama'       => $wish->nama,
                    'kehadiran'  => $wish->kehadiran ? 'Hadir' : 'Tidak Hadir',
                    'ucapan'     => $wish->ucapan,
                    'created_at' => $wish->created_at->diffForHumans()
                ]
            ]);
        }

        return redirect()->back()->with('success', 'Konfirmasi kehadiran & ucapan doa berhasil dikirim!');
    }

    public function destroy(Wish $wish)
    {
        $wish->delete();
        return redirect()->route('wish.index')->with('success', 'Ucapan berhasil dihapus.');
    }

    /**
     * Export data ucapan & doa restu ke format CSV.
     */
    public function exportCsv()
    {
        $wishes = Wish::latest()->get();
        $fileName = 'Rekap_Ucapan_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function () use ($wishes) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF"); // UTF-8 BOM
            fputcsv($file, ['No', 'Nama Pengirim', 'Status Kehadiran', 'Ucapan & Doa', 'Tanggal Dikirim']);

            foreach ($wishes as $index => $wish) {
                fputcsv($file, [
                    $index + 1,
                    $wish->nama,
                    $wish->kehadiran ? 'Hadir' : 'Tidak Hadir',
                    $wish->ucapan,
                    $wish->created_at ? $wish->created_at->format('Y-m-d H:i') : '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
