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

        return redirect()->route('rsvp.index')->with('success', 'Rsvp created successfully.');
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

        return redirect()->route('rsvp.index')->with('success', 'Rsvp updated successfully.');
    }

    public function destroy(Rsvp $rsvp)
    {
        $rsvp->delete();

        return redirect()->route('rsvp.index')->with('success', 'Rspv deleted successfully.');
    }
}
