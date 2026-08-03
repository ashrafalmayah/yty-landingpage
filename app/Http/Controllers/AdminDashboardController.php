<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query()->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('notes', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $bookings = $query->paginate(15)->withQueryString();

        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'contacted' => Booking::where('status', 'contacted')->count(),
            'completed' => Booking::where('status', 'completed')->count(),
        ];

        return view('admin.dashboard', compact('bookings', 'stats'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,contacted,completed',
        ]);

        $booking->update(['status' => $request->input('status')]);

        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->back()->with('success', 'تم حذف الطلب بنجاح');
    }
}
