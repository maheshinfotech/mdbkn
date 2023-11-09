<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = RoomCategory::all();
        $rooms = Room::orderBy('room_number')->get();
        return view('pages.room.index', compact('category', 'rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $room = new Room;
        $room->floor_number = $request->floor;
        $room->room_number = $request->room_no;
        $room->category_id = $request->category;
        $room->extra_remark = $request->remarks;
        $room->guest_capacity = $request->capacity;
        $room->room_status = $request->status;
        $room->save();
        return redirect()->back()->with('message', 'Room added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::with('category')->find($id);
        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // dd($request->all());
        $room = Room::find($id);
        $room->floor_number = $request->floor;
        $room->room_number = $request->room_no;
        $room->category_id = $request->category;
        $room->extra_remark = $request->remarks;
        $room->guest_capacity = $request->capacity;
        $room->room_status = $request->status;
        $room->save();
        return redirect()->back()->with('message', 'Room updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::find($id);

        return $this->generateResponse($room->delete());
    }
    public function AvailableRooms(request $request)
    {
        $initial = Room::with(['category'])
            ->where('category_id', 1)
            ->where(function($query) {
                $query->where('is_booked', null)
                    ->orWhere('is_booked', 0);
            })
            ->get();

        $basic = Room::with(['category'])
            ->where('category_id', 2)
            ->where(function($query) {
                $query->where('is_booked', null)
                    ->orWhere('is_booked', 0);
            })
            ->get();

        $normal = Room::with(['category'])
            ->where('category_id', 3)
            ->where(function($query) {
                $query->where('is_booked', null)
                    ->orWhere('is_booked', 0);
            })
            ->get();

        $premium = Room::with(['category'])
            ->where('category_id', 4)
            ->where(function($query) {
                $query->where('is_booked', null)
                    ->orWhere('is_booked', 0);
            })
            ->get();

        $flats = Room::with(['category'])
            ->where('category_id', 5)
            ->where(function($query) {
                $query->where('is_booked', null)
                    ->orWhere('is_booked', 0);
            })
            ->get();

        $other = Room::with(['category'])
            ->where('category_id', 6)
            ->where(function($query) {
                $query->where('is_booked', null)
                    ->orWhere('is_booked', 0);
            })
            ->get();

        return view('pages.room.Available', compact('initial', 'basic', 'normal', 'premium', 'flats', 'other'));
    }


    public function bookedRooms() {
        $room_booked = Room::where('is_booked',1)->get();
        return view('pages.room.room-booked', compact('room_booked'));
    }



public function showInitialRooms()
{
    $rooms = Room::where('category_id', 1)
        ->where(function ($query) {
            $query->where('is_booked', null)
                  ->orWhere('is_booked', 0);
        })
        ->get();

    return view('pages.room.initial', compact('rooms'));
}



public function showBasicRooms()
{
    $rooms = Room::where('category_id', 2)->where(function ($query) {
        $query->where('is_booked', null)
              ->orWhere('is_booked', 0);
    })
    ->get();
    return view('pages.room.initial', compact('rooms'));
}

public function showNormalRooms()
{
    $rooms = Room::where('category_id', 3)->where(function ($query) {
        $query->where('is_booked', null)
              ->orWhere('is_booked', 0);
    })
    ->get();
    return view('pages.room.initial', compact('rooms'));
}

public function showPremiumRooms()
{
    $rooms = Room::where('category_id', 4)->where(function ($query) {
        $query->where('is_booked', null)
              ->orWhere('is_booked', 0);
    })
    ->get();
    return view('pages.room.initial', compact('rooms'));
}
public function showflatsRooms()
{
    $rooms = Room::where('category_id', 5)->where(function ($query) {
        $query->where('is_booked', null)
              ->orWhere('is_booked', 0);
    })
    ->get();
    return view('pages.room.initial', compact('rooms'));
}
public function showotherRooms()
{
    $rooms = Room::where('category_id', 6)->where(function ($query) {
        $query->where('is_booked', null)
              ->orWhere('is_booked', 0);
    })
    ->get();
    return view('pages.room.initial', compact('rooms'));
}
}

