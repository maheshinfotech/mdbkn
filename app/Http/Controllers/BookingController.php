<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Model\Booking;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    public function index()
    {
        Gate::authorize('view', 'booking');

        return view('pages.booking.view');
    }

    public function create()
    {
        Gate::authorize('create', 'booking');

        return view('pages.booking.create');
    }

    public function checkout()
    {
        Gate::authorize('update', 'booking');
    }
}
