<?php

namespace App\Http\Controllers;

use DateTime;
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
        // $room_category=RoomCategory::where('name','other')->first();
        // $room_available_count= Room::where('category_id','!=',$room_category->id)->where(function ($query){
        //     $query->whereNull('is_booked')->Orwhere('is_booked','!=',1);
        // })->where(function ($query){
        //     $query->whereNull('room_status')->Orwhere('room_status','!=',0);
        // })->get()->count();
        $room_available_count = Room::where(function ($query){
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

        $room_booked_count= Room::where('is_booked','=',1)->get()->count();

        $today_checkout_count=Booking::whereBetween('check_out_time',[Carbon::now()->format('Y-m-d') .' 00:00:00',Carbon::now()->format('Y-m-d').' 23:59:00']
        )->get()->count();
        $bookingdue = Booking::with('advance')->whereNull('check_out_time')->get();

        $totalrentcount=[];
        $due=0;
            foreach ($bookingdue as $value) {
                $fdate = date('Y-m-d',(strtotime($value->getRawOriginal('check_in_time'))));

                $tdate = Carbon::today();
                $datetime1 = new DateTime($fdate);
                $datetime2 = new DateTime($tdate);
                $interval = $datetime1->diff($datetime2);
                $days = $interval->format('%a');//now do whatever you like with $days
                // dd($days);
                $amount=0;
                foreach ($value->advance as $val) {
                    $amount += $val->amount;
                }
                $rent = $value->base_rent;
                $totamt = $days * $rent ;
                if ($totamt > $amount && $interval->format("%r%a")>0) {
                    $due = $totamt - $amount;
                    if($due>0){
                        $totalrent = $value->id;
                        array_push($totalrentcount,$totalrent);
                    }
                }



        }
// dd($totalrentcount);
        $totalbookingcou = Booking::whereIn('id',$totalrentcount)->get()->count();

        return view('pages.dashboard',compact('room_available_count',
            'today_booking_count','running_booking_count','room_booked_count','today_checkout_count','totalbookingcou'
        ));
    }




    public function booking_check(){
        // $running_booking_count=Booking::with(['room'=>function($query){
        //     $query->orderBy('room_number');
        // }])->whereNull('check_out_time')->get();
  $running_booking_count=Booking::join('rooms','bookings.room_id','=','rooms.id')->orderBy('rooms.room_number')->get();
//   dd($running_booking_count);
        // sql query
    //    select * from `rooms` order by case when (is_booked is null or is_booked =0) then 1 else 0 end, `room_number` asc;
        $all_room=Room::orderByRaw('case when (is_booked is null OR is_booked = 0) then 1 else 0 end')->orderBy('room_number')->get();
        // dd($all_room);



        // dd($running_booking_count);
        return view('pages.booking.booking_check',compact('running_booking_count','all_room'));
    }
}
