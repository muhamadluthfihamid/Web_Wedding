<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\{
    DashboardController,
    HomeController,
    InfoController,
    StoryController,
    GalleryController,
    RsvpController,
    GiftsController,
    BiodataPriaController,
    BiodataWanitaController,
    ProfileController,
    WishController,
    NotificationController,
    RentalController,
    AudioController,
};

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [RentalController::class, 'index'])->name('rental.index');
Route::get('/sewa', fn () => redirect()->route('rental.index'));

Route::get('/demo', [DashboardController::class, 'index'])->name('dashboard.demo');
Route::get('/dashboard', fn (Illuminate\Http\Request $request) => redirect()->route('dashboard.demo', $request->query()))->name('dashboard');

Route::post('/wish', [WishController::class, 'storePublic'])->name('wish.storePublic');

// Undangan publik per penyewa
Route::get('/undangan/{slug}', [DashboardController::class, 'undangan'])->name('undangan.show');

Route::middleware('auth')->group(function () {
    Route::get('/sewa/status',          [RentalController::class, 'status'])->name('rental.status');
    Route::get('/sewa/pesan/{package}', [RentalController::class, 'orderForm'])->name('rental.orderForm');
    Route::post('/sewa/pesan',          [RentalController::class, 'order'])->name('rental.order');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', fn () => view('auth.login'))->name('login');

Auth::routes([
    'register' => true,
]);

Route::get('/rental-info', function () {
    $user = Auth::user();
    if ($user && ($user->isAdmin() || $user->isSuperAdmin() || $user->hasActiveRental())) {
        return redirect()->route('admin.home');
    }
    return redirect()->route('rental.status');
})->middleware('auth')->name('rental.info');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (PROTECTED)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Auth::routes();

    Route::middleware(['auth', 'role:superadmin,admin'])->group(function () {

        Route::get('/home', [HomeController::class, 'index'])->name('admin.home');

        Route::resource('info',          InfoController::class);
        Route::get('/audio',             [AudioController::class, 'index'])->name('audio.index');
        Route::post('/audio',            [AudioController::class, 'update'])->name('audio.update');
        Route::resource('story',         StoryController::class);
        Route::resource('gallery',       GalleryController::class);
        Route::resource('rsvp',          RsvpController::class);
        Route::resource('gifts',         GiftsController::class);
        Route::resource('guests',        \App\Http\Controllers\Admin\GuestController::class);
        Route::resource('users',         \App\Http\Controllers\UserController::class)->middleware('role:superadmin');
        Route::post('users/{user}/reset-password', [\App\Http\Controllers\UserController::class, 'resetPassword'])
            ->name('users.resetPassword')->middleware('role:superadmin');

        Route::resource('biodata-pria',   BiodataPriaController::class)->names('biodataPria')->parameters(['biodata-pria' => 'biodataPria']);
        Route::resource('biodata-wanita', BiodataWanitaController::class)->names('biodataWanita')->parameters(['biodata-wanita' => 'biodataWanita']);

        Route::resource('turut-mengundang', \App\Http\Controllers\TurutMengundangController::class)->names('turutMengundang')->parameters(['turut-mengundang' => 'turutMengundang']);

        Route::resource('wish', WishController::class)->only(['index', 'destroy']);

        Route::get('/profile',  [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile-user', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile',  [ProfileController::class, 'update'])->name('profile.update');

        // Notification mark-as-read (AJAX)
        Route::post('/notifications/mark-rsvp-read',   [NotificationController::class, 'markRsvpRead'])->name('notifications.markRsvpRead');
        Route::post('/notifications/mark-wish-read',   [NotificationController::class, 'markWishRead'])->name('notifications.markWishRead');
        Route::post('/notifications/mark-orders-read', [NotificationController::class, 'markOrdersRead'])->name('notifications.markOrdersRead');

        // ── RENTAL MANAGEMENT (superadmin only) ──────────────────
        Route::middleware('role:superadmin')->prefix('rental')->name('admin.rental.')->group(function () {
            // Orders
            Route::get('orders',                   [\App\Http\Controllers\Admin\RentalManageController::class, 'index'])->name('orders.index');
            Route::get('orders/{order}',           [\App\Http\Controllers\Admin\RentalManageController::class, 'show'])->name('orders.show');
            Route::post('orders/{order}/approve',    [\App\Http\Controllers\Admin\RentalManageController::class, 'approve'])->name('orders.approve');
            Route::post('orders/{order}/reject',     [\App\Http\Controllers\Admin\RentalManageController::class, 'reject'])->name('orders.reject');
            Route::post('orders/{order}/deactivate', [\App\Http\Controllers\Admin\RentalManageController::class, 'deactivate'])->name('orders.deactivate');

            // Packages CRUD
            Route::resource('packages', \App\Http\Controllers\Admin\RentalPackageController::class)
                ->names('packages');
        });
    });
});