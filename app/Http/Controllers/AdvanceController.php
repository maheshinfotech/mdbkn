<?php

namespace App\Http\Controllers;

use App\Models\Advance;
use Illuminate\Http\Request;
use App\Advance as AppAdvance;
use Illuminate\Support\Facades\Gate;

use  App\Models\Booking;

use Illuminate\Routing\Controller;


class AdvanceController extends Controller
{
    public function create($booking_id)
{
    Gate::authorize('create', 'booking');

    $advances = Advance::where('booking_id', $booking_id)->get();
    $booking = Booking::with('room')->find($booking_id);

    return view('advance.create', [
        'booking_id' => $booking_id,
        'advances' => $advances,
        'room_number' => $booking->room->room_number,
        'guest_name' => $booking->guest_name,
    ]);
}



    public function store(Request $request)
    {
    Gate::authorize('create', 'booking');

        $validatedData = $request->validate([
            'booking_id' => 'required',
            'amount' => 'required|numeric',
            'received_date' => 'required|date',
        ]);

        $advance = new Advance();
        $advance->booking_id = $validatedData['booking_id'];
        $advance->amount = $validatedData['amount'];
        $advance->received_date = $validatedData['received_date'];

        $advance->save();


        return redirect('/bookings')->with('message', 'Your Advance received successfully');
    }
}
