<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $totalRsvps = \App\Models\Rsvp::count();
        $totalWishes = \App\Models\Wish::count();
        $totalAttendingGuests = \App\Models\Rsvp::where('kehadiran', 1)->sum('jumlah');
        $confirmedAttending = \App\Models\Rsvp::where('kehadiran', 1)->count();
        $confirmedNotAttending = \App\Models\Rsvp::where('kehadiran', 0)->count();

        $widget = [
            'users' => $users,
            'totalRsvps' => $totalRsvps,
            'totalWishes' => $totalWishes,
            'totalAttendingGuests' => $totalAttendingGuests,
            'confirmedAttending' => $confirmedAttending,
            'confirmedNotAttending' => $confirmedNotAttending,
        ];

        return view('admin.home', compact('widget'));
    }
}
