<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AudioController extends Controller
{
    /**
     * Halaman kelola musik / audio undangan.
     */
    public function index()
    {
        $user = auth()->user();

        // Cari info user, hubungkan record lama jika null, atau buat baru jika belum ada
        $info = Info::query()->where('user_id', $user->id)->first();
        if (!$info) {
            $info = Info::query()->whereNull('user_id')->first();
            if ($info) {
                $info->update(['user_id' => $user->id]);
            }
        }
        if (!$info) {
            $info = Info::create([
                'user_id'              => $user->id,
                'nama_pengantin_pria'  => 'Pengantin Pria',
                'nama_pengantin_istri' => 'Pengantin Wanita',
                'tanggal_pernikahan'   => now()->toDateString(),
                'mulai_akad'           => '08:00',
                'selesai_akad'         => '10:00',
                'mulai_resepsi'        => '11:00',
                'alamat'               => 'Alamat Acara Pernikahan',
                'deskripsi'            => 'Acara Pernikahan',
            ]);
        }

        // Ambil daftar preset musik di public/assets/audio/
        $presetPath = public_path('assets/audio');
        $presets = [];
        if (File::exists($presetPath)) {
            $files = File::files($presetPath);
            foreach ($files as $file) {
                if (in_array(strtolower($file->getExtension()), ['mp3', 'wav', 'ogg', 'm4a'])) {
                    $presets[] = [
                        'name'     => pathinfo($file->getFilename(), PATHINFO_FILENAME),
                        'filename' => $file->getFilename(),
                        'path'     => 'assets/audio/' . $file->getFilename(),
                    ];
                }
            }
        }

        return view('admin.audio.index', compact('info', 'presets'));
    }

    /**
     * Simpan / perbarui musik undangan.
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        $info = Info::where('user_id', $user->id)->first();

        if (!$info) {
            $info = Info::create([
                'user_id'              => $user->id,
                'nama_pengantin_pria'  => 'Pengantin Pria',
                'nama_pengantin_istri' => 'Pengantin Wanita',
                'tanggal_pernikahan'   => now()->toDateString(),
                'mulai_akad'           => '08:00',
                'selesai_akad'         => '10:00',
                'mulai_resepsi'        => '11:00',
                'alamat'               => 'Alamat Acara Pernikahan',
                'deskripsi'            => 'Acara Pernikahan',
            ]);
        }

        $request->validate([
            'audio_option'     => 'required|in:preset,upload,url',
            'preset_audio'     => 'nullable|string',
            'audio_file'       => 'nullable|file|mimes:mp3,wav,ogg,m4a|max:15360',
            'custom_audio_url' => 'nullable|url',
        ]);

        $musikUrl = $info->musik_url;

        if ($request->audio_option === 'upload' && $request->hasFile('audio_file')) {
            // Hapus audio upload lama jika ada
            if ($info->musik_url && str_starts_with($info->musik_url, 'storage/')) {
                Storage::disk('public')->delete(str_replace('storage/', '', $info->musik_url));
            }

            $path = $request->file('audio_file')->store('audio', 'public');
            $musikUrl = 'storage/' . $path;
        } elseif ($request->audio_option === 'preset' && $request->filled('preset_audio')) {
            $musikUrl = $request->preset_audio;
        } elseif ($request->audio_option === 'url' && $request->filled('custom_audio_url')) {
            $musikUrl = $request->custom_audio_url;
        }

        $info->update([
            'musik_url'       => $musikUrl,
            'is_audio_active' => $request->has('is_audio_active'),
        ]);

        return redirect()->route('audio.index')->with('success', 'Musik latar undangan berhasil diperbarui!');
    }
}
