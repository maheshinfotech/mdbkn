<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Advance;
use App\Models\Booking;
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
        $roomname = RoomCategory::find($id)->name;
        $rooms = Room::where('category_id', $id)
        ->where(function ($query) {
            $query->where('is_booked', null)
                  ->orWhere('is_booked', 0);
        })
        ->get();

        return view('pages.room.initial', compact('rooms','roomname'));
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

        $category = RoomCategory::all();

        $start_year= Carbon::now()->startOfYear();
        $end_year=Carbon::now()->endOfYear();

        foreach ($category as $value) {
            if ($value->name=="Initial") {
                $value->room_name = "Initial";
                $value->total_room =   Room::where('category_id',$value->id)->get()->count();
                $value->room = Room::with('category')->where('category_id',$value->id)->where(function($query) {
                    $query->where('is_booked', null)
                        ->orWhere('is_booked', 0);
                })->get()->count();

                // #######################################################
                //++++++++++++  Room Category Amount Calculate Start Here
                // #########################################################

                $room_ids=Room::where('category_id',$value->id)->get()->map(function($query){
                    return $query->id;
                })->toArray();
                $room_booking=Booking::whereIn('room_id',$room_ids)->whereBetween('check_in_time', [$start_year,$end_year])->get();
                $category_room_amounts=[];
               foreach($room_booking as $booking) {
               $advance =Advance::where('booking_id',$booking->id)->get()->map(function($query){
                return $query->amount;
               })->toArray();
              $total_advance= array_sum($advance);
              $booking_net_amount= 0;
              if ($booking->advance_refund>0){
                $booking_net_amount= $total_advance-$booking->advance_refund ;
              }else{
                $booking_net_amount= $total_advance+$booking->paid_rent;
              }
              array_push($category_room_amounts,$booking_net_amount);

               }
              $value->total_booking_amount=array_sum($category_room_amounts);
             // #######################################################
              //++++++++++++  Room Category Amount Calculate End Here
            // #########################################################



            }if ($value->name=="Basic") {
                $value->room_name = "Basic";
                $value->total_room =   Room::where('category_id',$value->id)->get()->count();
                $room_ids=Room::where('category_id',$value->id)->get()->map(function($query){
                    return $query->id;
                })->toArray();

                $value->room = Room::with('category')->where('category_id',$value->id)->where(function($query) {
                    $query->where('is_booked', null)
                        ->orWhere('is_booked', 0);
                })->get()->count();
                $room_ids=Room::where('category_id',$value->id)->get()->map(function($query){
                    return $query->id;
                })->toArray();
                // #######################################################
                //++++++++++++  Room Category Amount Calculate Start Here
                // #########################################################
                $room_booking=Booking::whereIn('room_id',$room_ids)->whereBetween('check_in_time', [$start_year,$end_year])->get();
                $category_room_amounts=[];
               foreach($room_booking as $booking) {
               $advance =Advance::where('booking_id',$booking->id)->get()->map(function($query){
                return $query->amount;
               })->toArray();
              $total_advance= array_sum($advance);
              $booking_net_amount= 0;
              if ($booking->advance_refund>0){
                $booking_net_amount= $total_advance-$booking->advance_refund ;
              }else{
                $booking_net_amount= $total_advance+$booking->paid_rent;
              }
              array_push($category_room_amounts,$booking_net_amount);

               }
              $value->total_booking_amount=array_sum($category_room_amounts);
             // #######################################################
              //++++++++++++  Room Category Amount Calculate End Here
            // #########################################################


            }
            if ($value->name=="Normal") {
                $value->room_name = "Normal";
                $value->total_room =   Room::where('category_id',$value->id)->get()->count();
                $value->room = Room::with('category')->where('category_id',$value->id)->where(function($query) {
                    $query->where('is_booked', null)
                        ->orWhere('is_booked', 0);
                })->get()->count();
                $room_ids=Room::where('category_id',$value->id)->get()->map(function($query){
                    return $query->id;
                })->toArray();

               // #######################################################
                //++++++++++++  Room Category Amount Calculate Start Here
                // #########################################################
                $room_booking=Booking::whereIn('room_id',$room_ids)->whereBetween('check_in_time', [$start_year,$end_year])->get();
                $category_room_amounts=[];
               foreach($room_booking as $booking) {
               $advance =Advance::where('booking_id',$booking->id)->get()->map(function($query){
                return $query->amount;
               })->toArray();
              $total_advance= array_sum($advance);
              $booking_net_amount= 0;
              if ($booking->advance_refund>0){
                $booking_net_amount= $total_advance-$booking->advance_refund ;
              }else{
                $booking_net_amount= $total_advance+$booking->paid_rent;
              }
              array_push($category_room_amounts,$booking_net_amount);

               }
              $value->total_booking_amount=array_sum($category_room_amounts);
             // #######################################################
              //++++++++++++  Room Category Amount Calculate End Here
            // #########################################################


            } if ($value->name=="Premium") {
                $value->room_name = "Premium";
                $value->total_room =   Room::where('category_id',$value->id)->get()->count();
                $value->room = Room::with('category')->where('category_id',$value->id)->where(function($query) {
                    $query->where('is_booked', null)
                        ->orWhere('is_booked', 0);
                })->get()->count();
                $room_ids=Room::where('category_id',$value->id)->get()->map(function($query){
                    return $query->id;
                })->toArray();

                 // #######################################################
                //++++++++++++  Room Category Amount Calculate Start Here
                // #########################################################
                $room_booking=Booking::whereIn('room_id',$room_ids)->whereBetween('check_in_time', [$start_year,$end_year])->get();
                $category_room_amounts=[];
               foreach($room_booking as $booking) {
               $advance =Advance::where('booking_id',$booking->id)->get()->map(function($query){
                return $query->amount;
               })->toArray();
              $total_advance= array_sum($advance);
              $booking_net_amount= 0;
              if ($booking->advance_refund>0){
                $booking_net_amount= $total_advance-$booking->advance_refund ;
              }else{
                $booking_net_amount= $total_advance+$booking->paid_rent;
              }
              array_push($category_room_amounts,$booking_net_amount);

               }
              $value->total_booking_amount=array_sum($category_room_amounts);
             // #######################################################
              //++++++++++++  Room Category Amount Calculate End Here
            // #########################################################
            }
            if ($value->name=="Flats") {
                $value->room_name = "Flats";
                $value->total_room =   Room::where('category_id',$value->id)->get()->count();

                $value->room = Room::with('category')->where('category_id',$value->id)->where(function($query) {
                    $query->where('is_booked', null)
                        ->orWhere('is_booked', 0);
                })->get()->count();

                $room_ids=Room::where('category_id',$value->id)->get()->map(function($query){
                    return $query->id;
                })->toArray();
                 // #######################################################
                //++++++++++++  Room Category Amount Calculate Start Here
                // #########################################################
                $room_booking=Booking::whereIn('room_id',$room_ids)->whereBetween('check_in_time', [$start_year,$end_year])->get();
                $category_room_amounts=[];

               foreach($room_booking as $booking) {
               $advance =Advance::where('booking_id',$booking->id)->get()->map(function($query){
                return $query->amount;
               })->toArray();
              $total_advance= array_sum($advance);
              $booking_net_amount= 0;
              if ($booking->advance_refund>0){
                $booking_net_amount= $total_advance-$booking->advance_refund ;
              }else{
                $booking_net_amount= $total_advance+$booking->paid_rent;
              }
              array_push($category_room_amounts,$booking_net_amount);

               }
              $value->total_booking_amount=array_sum($category_room_amounts);
             // #######################################################
              //++++++++++++  Room Category Amount Calculate End Here
            // #########################################################
            }
            if ($value->name=="Other") {
                $value->room_name = "Other";
                $value->total_room =   Room::where('category_id',$value->id)->get()->count();

                $value->room = Room::with('category')->where('category_id',$value->id)->where(function($query) {
                    $query->where('is_booked', null)
                        ->orWhere('is_booked', 0);
                })->get()->count();

                $room_ids=Room::where('category_id',$value->id)->get()->map(function($query){
                    return $query->id;
                })->toArray();

                 // #######################################################
                //++++++++++++  Room Category Amount Calculate Start Here
                // #########################################################

                $room_booking=Booking::whereIn('room_id',$room_ids)->whereBetween('check_in_time', [$start_year,$end_year])->get();


                $category_room_amounts=[];

                // dd($start_year,$end_year);

               foreach($room_booking as $booking) {

               $advance =Advance::where('booking_id',$booking->id)->get()->map(function($query){
                return $query->amount;
               })->toArray();
              $total_advance= array_sum($advance);
              $booking_net_amount= 0;
              if ($booking->advance_refund>0){
                $booking_net_amount= $total_advance-$booking->advance_refund ;
              }else{
                $booking_net_amount= $total_advance+$booking->paid_rent;
              }
              array_push($category_room_amounts,$booking_net_amount);

               }
              $value->total_booking_amount=array_sum($category_room_amounts);
             // #######################################################
              //++++++++++++  Room Category Amount Calculate End Here
            // #########################################################
            }

        }

       $total_room_count= Room::get()->count();
       $available_room_count=Room::with('category')->where(function($query) {
        $query->where('is_booked', null)
            ->orWhere('is_booked', 0);
    })->get()->count();
    //    dd($total_room_count,$booked_room_count);
// dd($category);
        return view('pages.room.Available', compact('category','total_room_count','available_room_count'));
    }

    public function bookedRooms() {
        $room_booked = Room::where('is_booked',1)->get();
        return view('pages.room.room-booked', compact('room_booked'));
    }
}

