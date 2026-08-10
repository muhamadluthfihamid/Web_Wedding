<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * Display general settings page (Super Admin only).
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user || !$user->isSuperAdmin()) {
            abort(403, 'Akses Ditolak: Hanya Super Admin yang memiliki hak akses untuk mengubah nama toko/platform.');
        }

        $storeName = Setting::getStoreName();

        return view('admin.settings.index', compact('storeName'));
    }

    /**
     * Update store settings.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user || !$user->isSuperAdmin()) {
            abort(403, 'Akses Ditolak: Hanya Super Admin yang memiliki hak akses untuk mengubah nama toko/platform.');
        }

        $request->validate([
            'store_name' => ['required', 'string', 'max:255'],
        ], [
            'store_name.required' => 'Nama Toko / Platform wajib diisi.',
            'store_name.max' => 'Nama Toko / Platform maksimal 255 karakter.',
        ]);

        Setting::set('store_name', trim($request->store_name));

        return redirect()->route('admin.settings.index')->with('success', 'Nama Toko / Platform berhasil diperbarui!');
    }

    /**
     * Switch event type (wedding / khitanan).
     */
    public function switchEventType(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $eventType = $request->input('event_type');
        if (in_array($eventType, ['wedding', 'khitanan'])) {
            $user->event_type = $eventType;
            $user->save();
        }

        $label = $eventType === 'khitanan' ? 'Khitanan 👦' : 'Pernikahan 💍';
        return redirect()->back()->with('success', "Berhasil beralih ke Mode Panel {$label}!");
    }
}
