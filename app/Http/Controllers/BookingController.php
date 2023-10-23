<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Model\Booking;
use App\Models\RoomCategory;
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
        $category = RoomCategory::all();
        return view('pages.booking.create', compact('category'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create', 'booking');


        return view('pages.booking.create');
    }

    public function checkout()
    {
        Gate::authorize('update', 'booking');
    }
}
