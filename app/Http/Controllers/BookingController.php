<?php

namespace App\Http\Controllers;

use App\Helpers\MetaHelper;
use App\Jobs\SendMetaEventJob;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('landing');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'notes' => 'nullable|string|max:1000',
        ]);

        $booking = Booking::create($validated);

        // Meta CAPI & Pixel Lead Event Integration
        $eventId = 'lead_' . $booking->id;
        $userData = MetaHelper::getUserData($request, $validated);
        $customData = [
            'content_name' => 'Office Booking Form',
            'status' => 'submitted',
        ];

        SendMetaEventJob::dispatch(
            'Lead',
            $eventId,
            time(),
            $request->url(),
            $userData,
            $customData
        );

        MetaHelper::flashEvent('Lead', $eventId, $customData);
        MetaHelper::flashUserData($userData);

        return redirect()->back()->with('success_name', $validated['name']);
    }

    public function trackContact(Request $request)
    {
        $channel = $request->input('channel', 'General Contact');
        $eventId = $request->header('X-Event-ID') ?: 'contact_' . uniqid();
        $userData = MetaHelper::getUserData($request);
        $customData = [
            'content_name' => $channel,
            'status' => 'initiated',
        ];

        SendMetaEventJob::dispatch(
            'Contact',
            $eventId,
            time(),
            $request->url(),
            $userData,
            $customData
        );

        return response()->json(['success' => true, 'event_id' => $eventId]);
    }
}
