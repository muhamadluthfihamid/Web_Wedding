<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Carbon::setLocale('id');

        // Share recent RSVPs and Wishes with the admin layout
        view()->composer('admin.layouts.admin', function ($view) {
            $recentRsvps = collect();
            $unreadRsvpsCount = 0;
            $recentWishes = collect();
            $unreadWishesCount = 0;

            if (\Schema::hasTable('rsvps')) {
                $recentRsvps = \App\Models\Rsvp::orderBy('created_at', 'desc')->take(5)->get();

                // Count RSVPs newer than when the admin last opened the notifications dropdown
                $rsvpLastReadAt = session('rsvp_last_read_at');
                if ($rsvpLastReadAt) {
                    $unreadRsvpsCount = \App\Models\Rsvp::where('created_at', '>', $rsvpLastReadAt)->count();
                } else {
                    // First visit: count items from last 7 days
                    $unreadRsvpsCount = \App\Models\Rsvp::where('created_at', '>=', now()->subDays(7))->count();
                }
            }

            if (\Schema::hasTable('wishes')) {
                $recentWishes = \App\Models\Wish::orderBy('created_at', 'desc')->take(5)->get();

                // Count wishes newer than when the admin last opened the messages dropdown
                $wishLastReadAt = session('wish_last_read_at');
                if ($wishLastReadAt) {
                    $unreadWishesCount = \App\Models\Wish::where('created_at', '>', $wishLastReadAt)->count();
                } else {
                    // First visit: count items from last 7 days
                    $unreadWishesCount = \App\Models\Wish::where('created_at', '>=', now()->subDays(7))->count();
                }
            }

            $view->with([
                'recentRsvps' => $recentRsvps,
                'unreadRsvpsCount' => $unreadRsvpsCount,
                'recentWishes' => $recentWishes,
                'unreadWishesCount' => $unreadWishesCount,
            ]);
        });
    }
}