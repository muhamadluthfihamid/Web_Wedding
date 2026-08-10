<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\RentalPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RentalController extends Controller
{
    /**
     * Halaman landing / pricing page (publik).
     */
    public function index()
    {
        $packages = RentalPackage::aktif()->orderBy('harga')->get();
        $themes   = \App\Models\Theme::active()->get();
        return view('rental.landing', compact('packages', 'themes'));
    }

    /**
     * Form pemesanan paket.
     */
    public function orderForm(RentalPackage $package)
    {
        if (!$package->is_aktif) {
            return redirect()->route('rental.index')->with('error', 'Paket tidak tersedia.');
        }

        $user = Auth::user();

        // Cek jika user bertipe Admin / Superadmin
        if ($user->isAdmin() || $user->isSuperAdmin()) {
            return redirect()->route('admin.home')->with('warning', 'Akun bertipe Admin / Superadmin tidak dapat melakukan pemesanan sewa paket baru.');
        }

        // Cek sudah punya sewa aktif
        if ($user->hasActiveRental()) {
            return redirect()->route('rental.status')->with('info', 'Anda sudah memiliki sewa yang aktif.');
        }

        // Cek sudah ada order pending
        if ($user->hasPendingOrder()) {
            return redirect()->route('rental.status')->with('info', 'Anda sudah memiliki pesanan yang sedang menunggu konfirmasi.');
        }

        $themes = \App\Models\Theme::active()->get();

        return view('rental.order', compact('package', 'themes'));
    }

    /**
     * Proses simpan pesanan + upload bukti transfer.
     */
    public function order(Request $request)
    {
        $request->validate([
            'rental_package_id' => 'required|exists:rental_packages,id',
            'event_type'        => 'required|in:wedding,khitanan',
            'theme_id'          => 'required|exists:themes,id',
            'bukti_transfer'    => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'catatan_user'      => 'nullable|string|max:500',
        ]);

        $user    = Auth::user();
        $package = RentalPackage::findOrFail($request->rental_package_id);

        // Cek jika user bertipe Admin / Superadmin
        if ($user->isAdmin() || $user->isSuperAdmin()) {
            return redirect()->route('admin.home')->with('warning', 'Akun bertipe Admin / Superadmin tidak dapat melakukan pemesanan sewa paket baru.');
        }

        if ($user->hasActiveRental() || $user->hasPendingOrder()) {
            return redirect()->route('rental.status')->with('info', 'Anda sudah memiliki pesanan aktif atau pending.');
        }

        // Upload bukti transfer
        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        Order::create([
            'user_id'           => $user->id,
            'rental_package_id' => $package->id,
            'event_type'        => $request->event_type,
            'theme_id'          => $request->theme_id,
            'status'            => 'pending',
            'bukti_transfer'    => $path,
            'catatan_user'      => $request->catatan_user,
        ]);

        return redirect()->route('rental.status')
            ->with('success', 'Pesanan berhasil dikirim! Admin akan segera memverifikasi pembayaran Anda.');
    }

    /**
     * Dashboard status sewa user.
     */
    public function status()
    {
        $user    = Auth::user();
        $order   = $user->orders()->with('package')->first();
        $packages = RentalPackage::aktif()->orderBy('harga')->get();

        return view('rental.status', compact('user', 'order', 'packages'));
    }
}
