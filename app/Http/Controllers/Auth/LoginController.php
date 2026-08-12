<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        session()->flash('success', 'Berhasil masuk! Selamat datang kembali, ' . $user->name . '.');
        if ($user && $user->isUser() && !$user->hasActiveRental()) {
            return redirect()->route('rental.status');
        }
        return redirect()->intended($this->redirectTo);
    }

    protected function loggedOut(\Illuminate\Http\Request $request)
    {
        return redirect()->route('login')->with('success', 'Berhasil keluar dari akun.');
    }
}
