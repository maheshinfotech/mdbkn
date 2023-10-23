<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Model\Booking;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    public function index()
    {
        Gate::authorize('booking', 'view');

        return view('pages.booking.view');
    }

    public function create()
    {
        Gate::authorize('booking', 'create');

        return view('pages.booking.create');
    }

    public function checkout()
    {
        Gate::authorize('booking', 'update');
    }
}
