<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mark RSVP notifications as read by storing the current timestamp in session.
     */
    public function markRsvpRead(Request $request)
    {
        session(['rsvp_last_read_at' => now()->toDateTimeString()]);

        return response()->json(['success' => true]);
    }

    /**
     * Mark Wish notifications as read by storing the current timestamp in session.
     */
    public function markWishRead(Request $request)
    {
        session(['wish_last_read_at' => now()->toDateTimeString()]);

        return response()->json(['success' => true]);
    }
}
