<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use Illuminate\Http\Request;

class RsvpController extends Controller
{
    public function index()
    {
        $rsvps = Rsvp::all();
        return view('admin.rsvp.index', compact('rsvps'));
    }

    public function create()
    {
        return view('admin.rsvp.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_tamu' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'kehadiran' => 'required|in:1,0,true,false,Hadir,Tidak Hadir'
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

        $rsvp = Rsvp::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Konfirmasi kehadiran berhasil dikirim!'
            ]);
        }

        return redirect()->route('rsvp.index')->with('success', 'Konfirmasi RSVP berhasil ditambahkan.');
    }

    // public function show(Rsvp $rsvp)
    // {
    //     return view('rsv.show', compact('rspv'));
    // }

    public function edit(Rsvp $rsvp)
    {
        return view('admin.rsvp.edit', compact('rsvp'));
    }

    public function update(Request $request, Rsvp $rsvp)
    {
        $rules = [
            'nama_tamu' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'kehadiran' => 'required|in:1,0,true,false,Hadir,Tidak Hadir'
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

        $rsvp->update($validated);

        return redirect()->route('rsvp.index')->with('success', 'Data RSVP berhasil diperbarui.');
    }

    public function destroy(Rsvp $rsvp)
    {
        $rsvp->delete();

        return redirect()->route('rsvp.index')->with('success', 'Data RSVP berhasil dihapus.');
    }

    /**
     * Export data RSVP ke format CSV.
     */
    public function exportCsv()
    {
        $rsvps = Rsvp::latest()->get();
        $fileName = 'Rekap_RSVP_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function () use ($rsvps) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF"); // UTF-8 BOM
            fputcsv($file, ['No', 'Nama Tamu', 'Jumlah Tamu', 'Status Kehadiran', 'Tanggal Konfirmasi']);

            foreach ($rsvps as $index => $rsvp) {
                fputcsv($file, [
                    $index + 1,
                    $rsvp->nama_tamu,
                    $rsvp->jumlah,
                    $rsvp->kehadiran ? 'Hadir' : 'Tidak Hadir',
                    $rsvp->created_at ? $rsvp->created_at->format('Y-m-d H:i') : '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
