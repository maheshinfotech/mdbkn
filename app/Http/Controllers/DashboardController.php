<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Room;
use App\Models\User;
use App\Models\Booking;
use App\Models\RoomCategory;
use App\Models\RoleMenuPermission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        Gate::authorize('view', 'dashboard');


        //  available count is here start
        $room_category=RoomCategory::where('name','other')->first();
        $room_available_count= Room::where('category_id','!=',$room_category->id)->where(function ($query){
            $query->whereNull('is_booked')->Orwhere('is_booked','!=',1);
        })->where(function ($query){
            $query->whereNull('room_status')->Orwhere('room_status','!=',0);
        })->get()->count();
        //  available count is here end


        //  today booking count is here
        $today_booking_count=Booking::whereBetween('check_in_time',
        [Carbon::now()->format('Y-m-d') .' 00:00:00',Carbon::now()->format('Y-m-d').' 23:59:00']
        )->get()->count();
        // today booking count is here

        // running booking count is here
        $running_booking_count=Booking::whereNull('check_out_time')->get()->count();
        // running booking count is here


        // dd($running_booking_count);
        // dd($room_available);
        return view('pages.dashboard',compact('room_available_count',
    'today_booking_count','running_booking_count'
    ));
    }
}
