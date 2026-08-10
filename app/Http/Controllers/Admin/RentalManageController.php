<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RentalManageController extends Controller
{
    /**
     * Daftar semua pesanan.
     */
    public function index(Request $request)
    {
        $orders = Order::with(['user', 'package'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(15);

        $stats = [
            'pending'  => Order::where('status', 'pending')->count(),
            'active'   => Order::where('status', 'active')->count(),
            'expired'  => Order::where('status', 'expired')->count(),
            'rejected' => Order::where('status', 'rejected')->count(),
        ];

        return view('admin.rental.orders.index', compact('orders', 'stats'));
    }

    /**
     * Detail pesanan.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'package', 'approvedBy']);
        return view('admin.rental.orders.show', compact('order'));
    }

    /**
     * Approve pesanan → aktifkan sewa & jadikan role admin.
     */
    public function approve(Request $request, Order $order)
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'Pesanan sudah diproses sebelumnya.');
        }

        $request->validate([
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        $package = $order->package;
        $mulai   = Carbon::today();
        $selesai = $mulai->copy()->addDays($package->durasi_hari);

        // Generate slug dari nama user jika belum ada
        $user = $order->user;
        if (!$user->slug) {
            $slug = Str::slug($user->name . '-' . Str::random(4));
            $user->slug = $slug;
        }

        // Upgrade role user → admin (kecuali jika superadmin) & set event_type & theme_id
        if (!$user->isSuperAdmin()) {
            $user->role = 'admin';
        }
        if ($order->event_type) {
            $user->event_type = $order->event_type;
        }
        if ($order->theme_id) {
            $user->theme_id = $order->theme_id;
        }
        $user->save();

        // Aktifkan order
        $order->update([
            'status'          => 'active',
            'tanggal_mulai'   => $mulai,
            'tanggal_selesai' => $selesai,
            'catatan_admin'   => $request->catatan_admin,
            'approved_at'     => now(),
            'approved_by'     => Auth::id(),
        ]);

        return redirect()->route('admin.rental.orders.index')
            ->with('success', "Pesanan #{$order->id} ({$user->full_name}) berhasil diaktifkan selama {$package->durasi_hari} hari.");
    }

    /**
     * Reject pesanan.
     */
    public function reject(Request $request, Order $order)
    {
        if (!in_array($order->status, ['pending'])) {
            return back()->with('error', 'Pesanan tidak bisa ditolak.');
        }

        $request->validate([
            'catatan_admin' => 'required|string|max:500',
        ]);

        $order->update([
            'status'        => 'rejected',
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->route('admin.rental.orders.index')
            ->with('success', "Pesanan #{$order->id} berhasil ditolak.");
    }

    /**
     * Menonaktifkan sewa yang sedang aktif.
     */
    public function deactivate(Request $request, Order $order)
    {
        if ($order->status !== 'active') {
            return back()->with('error', 'Hanya pesanan aktif yang bisa dinonaktifkan.');
        }

        $request->validate([
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        // Demote role user dari admin ke user jika bukan superadmin dan tidak ada order aktif lain
        $user = $order->user;
        if ($user && !$user->isSuperAdmin() && $user->role === 'admin') {
            $hasOtherActiveOrder = $user->orders()->where('id', '!=', $order->id)->where('status', 'active')->exists();
            if (!$hasOtherActiveOrder) {
                $user->role = 'user';
                $user->save();
            }
        }

        // Set status order menjadi expired
        $order->update([
            'status'        => 'expired',
            'catatan_admin' => $request->catatan_admin ?: 'Sewa dinonaktifkan oleh Admin.',
        ]);

        return redirect()->route('admin.rental.orders.index')
            ->with('success', "Sewa #{$order->id} ({$user->full_name}) berhasil dinonaktifkan.");
    }
}
