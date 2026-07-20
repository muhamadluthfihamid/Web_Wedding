<?php

namespace App\Http\Controllers;

use App\Models\BiodataPria;
use App\Models\BiodataWanita;
use App\Models\Gallery;
use App\Models\Gifts;
use App\Models\Info;
use App\Models\Story;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $infos = Info::all(); // Ambil semua data dari tabel infos
        $biodataPria = BiodataPria::all();
        $biodataWanita = BiodataWanita::all();
        $gifts = Gifts::all();
        $story = Story::latest()->first();
        $galeries = Gallery::all();
        $wishes = \App\Models\Wish::latest()->get();
        return view('front-end.master', compact('infos', 'biodataPria', 'biodataWanita', 'gifts', 'story', 'galeries', 'wishes')); // Kirim data ke view
    }
}
