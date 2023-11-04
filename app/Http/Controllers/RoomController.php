<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

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
    public function AvailableRooms()
    {
        $category = RoomCategory::all();
        $rooms = Room::with('category')
            ->whereNull('is_booked')
            ->orWhere('is_booked', false)
            ->orderBy('room_number')
            ->get();
            // dd($rooms);

        return view('pages.room.Available', compact('category', 'rooms'));
    }



}
