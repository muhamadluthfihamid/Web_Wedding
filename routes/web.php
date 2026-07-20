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
    NotificationController
};

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/dashboard', fn (Illuminate\Http\Request $request) => redirect()->route('dashboard', $request->query()));

Route::post('/wish', [WishController::class, 'storePublic'])->name('wish.storePublic');


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', fn () => view('auth.login'))->name('login');

Auth::routes([
    'register' => true,
]);

Route::get('/rental-info', fn () => view('auth.rental_info'))
    ->middleware('auth')
    ->name('rental.info');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (PROTECTED)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    // Login page
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Auth::routes();

    // 🔒 SEMUA ROUTE ADMIN WAJIB LOGIN & MEMILIKI ROLE SUPERADMIN / ADMIN
    Route::middleware(['auth', 'role:superadmin,admin'])->group(function () {

        Route::get('/home', [HomeController::class, 'index'])->name('admin.home');

        Route::resource('info', InfoController::class);
        Route::resource('story', StoryController::class);
        Route::resource('gallery', GalleryController::class);
        Route::resource('rsvp', RsvpController::class);
        Route::resource('gifts', GiftsController::class);
        Route::resource('guests', \App\Http\Controllers\Admin\GuestController::class);
        Route::resource('users', \App\Http\Controllers\UserController::class)->middleware('role:superadmin');

        Route::resource('biodata-pria', BiodataPriaController::class)->names('biodataPria')->parameters(['biodata-pria' => 'biodataPria']);
        Route::resource('biodata-wanita', BiodataWanitaController::class)->names('biodataWanita')->parameters(['biodata-wanita' => 'biodataWanita']);

        Route::resource('wish', WishController::class)->only(['index', 'destroy']);

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Notification mark-as-read (AJAX)
        Route::post('/notifications/mark-rsvp-read', [NotificationController::class, 'markRsvpRead'])->name('notifications.markRsvpRead');
        Route::post('/notifications/mark-wish-read', [NotificationController::class, 'markWishRead'])->name('notifications.markWishRead');
    });
});