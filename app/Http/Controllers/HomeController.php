<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rsvp;
use App\Models\User;
use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /** @var User|null $user */
        $user = Auth::user();

        // User biasa tanpa sewa aktif → redirect ke informasi rental
        if ($user && $user->isUser() && !$user->hasActiveRental()) {
            return redirect()->route('rental.info');
        }

        // Admin penyewa & Superadmin stats
        $totalRsvps            = Rsvp::all()->count();
        $totalWishes           = Wish::all()->count();
        $totalAttendingGuests  = Rsvp::where('kehadiran', 1)->get()->sum('jumlah');
        $confirmedAttending    = Rsvp::where('kehadiran', 1)->get()->count();
        $confirmedNotAttending = Rsvp::where('kehadiran', 0)->get()->count();

        $widget = [
            'users'                 => User::all()->count(),
            'totalRsvps'            => $totalRsvps,
            'totalWishes'           => $totalWishes,
            'totalAttendingGuests'  => $totalAttendingGuests,
            'confirmedAttending'    => $confirmedAttending,
            'confirmedNotAttending' => $confirmedNotAttending,
        ];

        return view('admin.home', compact('widget'));
    }
}
