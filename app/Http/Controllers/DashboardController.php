<?php

namespace App\Http\Controllers;

use App\Models\BiodataPria;
use App\Models\BiodataWanita;
use App\Models\Gallery;
use App\Models\Gifts;
use App\Models\Info;
use App\Models\Story;
use App\Models\TurutMengundang;
use App\Models\User;
use App\Models\Wish;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Halaman utama publik (tampilkan data tenant pertama yang aktif, jika ada).
     */
    public function index()
    {
        $infos            = Info::all();
        $biodataPria      = BiodataPria::all();
        $biodataWanita    = BiodataWanita::all();
        $gifts            = Gifts::all();
        $story            = Story::query()->orderByDesc('created_at')->first();
        $galeries         = Gallery::all();
        $wishes           = Wish::query()->orderByDesc('created_at')->get();
        $turutMengundangs = TurutMengundang::query()->orderBy('urutan', 'asc')->orderBy('created_at', 'asc')->get();

        return view('front-end.master', compact(
            'infos', 'biodataPria', 'biodataWanita',
            'gifts', 'story', 'galeries', 'wishes', 'turutMengundangs'
        ));
    }

    /**
     * Halaman undangan per penyewa berdasarkan slug.
     */
    public function undangan(string $slug)
    {
        /** @var User $tenant */
        $tenant = User::query()->where('slug', $slug)->firstOrFail();

        $infos            = Info::query()->where('user_id', $tenant->id)->get();
        $biodataPria      = BiodataPria::query()->where('user_id', $tenant->id)->get();
        $biodataWanita    = BiodataWanita::query()->where('user_id', $tenant->id)->get();
        $gifts            = Gifts::query()->where('user_id', $tenant->id)->get();
        $story            = Story::query()->where('user_id', $tenant->id)->orderByDesc('created_at')->first();
        $galeries         = Gallery::query()->where('user_id', $tenant->id)->get();
        $wishes           = Wish::query()->orderByDesc('created_at')->get();
        $turutMengundangs = TurutMengundang::query()->where('user_id', $tenant->id)->orderBy('urutan', 'asc')->orderBy('created_at', 'asc')->get();

        return view('front-end.master', compact(
            'infos', 'biodataPria', 'biodataWanita',
            'gifts', 'story', 'galeries', 'wishes', 'tenant', 'turutMengundangs'
        ));
    }
}
