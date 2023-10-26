<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\Setting;
use  App\Models\Booking;
use App\Models\BookingLogs;
use Illuminate\Support\Str;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function index()
    {
        // Gate::authorize('view', 'booking');
        $bookings= Booking::latest('id')->get();
        // dd($bookings);

        return view('pages.booking.view',compact('bookings'));
    }
    public function create(Request $request)

    {

        if($request->ajax()){
            $rooms=Room::where('category_id',$request->id)->get();
            return response()->json($rooms);
        }
        $category = RoomCategory::all();
        $rooms =Room::whereNull('is_booked')->orWhere('is_booked','!=',1)->get();
        // dd($rooms);
        return view('pages.booking.create', compact('category','rooms'));
    }

    public function store(Request $request)
    {
        // Gate::authorize('create', 'booking');
// dd($request->all());

// booking record save block start
$booking =new Booking;
$booking->room_id=$request->room;
$booking->guest_name=$request->guest_name;
$booking->guest_father_name=$request->guest_father;
$booking->guest_cast=$request->caste;
$booking->guest_address=$request->guest_address;
$booking->patient_name=$request->patient_name;
$booking->patient_ward_no=$request->ward_no;
$booking->patient_bed_no=$request->bedno;
$booking->advance_payment=$request->advance;
$booking->check_in_time= date('Y-m-d').' '.$request->checkin;
$booking->age=$request->age;
$booking->city=$request->city;
$booking->state=$request->state;
$booking->docter_name=$request->docter;
$booking->mobile_number=$request->mobile;

if ($request->hasFile('idproof')) {
    $file = $request->file('idproof');
    $imageName = 'Id_Proof_files/' . Str::random(40) . '.' . strtolower($file->getClientOriginalExtension());
    $filePath = $file->storeAs('public/', $imageName);
    $booking->id_number=$imageName;
}


$booking->tehsil=$request->tehsil;
$booking->relation_patient=$request->relation;
$booking->ward_type=$request->wardtype;
// rent ==================
$roomcat = RoomCategory::where('id', $request->category)->first();
    if($request->wardtype=="ct" || $request->wardtype=="rt"){
        $booking->base_rent = $roomcat->patient_rent;
    }else{
        $booking->base_rent = $roomcat->normal_rent;
    }
// =======================
$booking->is_parking_provided=$request->parking;
$booking->extra_remark=$request->remark;
// ===settings table =========
$setting = Setting::latest()->first();
if($setting){
    $booking->base_check_in_time = $setting->check_in_time;
    $booking->base_check_out_time = $setting->check_out_time;
    $booking->base_grace_period = $setting->grace_period;
}
// ===========
$booking->save();
// booking record save block end
// ==================add guest code=============================
if($booking->save()){
    if ($request->guestlists) {
        foreach($request->guestlists as $guests){
            $guest = new  BookingLogs;
            $guest->booking_id = $booking->id;
            $guest->guest_name = $guests['guestname'];
            $guest->guest_age = $guests['guestage'];
            $guest->guest_relation = $guests['guestrelation'];
            $guest->guest_remarks = $guests['guestremarks'];
            $guest->save();
        }
    }
}
// =======================================================================


// return redirect()->back()->with('message', 'Booking added successfully');
return redirect()->route('index-booking')->with('message', 'Booking added successfully');
// return view('pages.booking.create');


    }

    public function checkout()
    {
        Gate::authorize('update', 'booking');
    }

    public function show($id){

        $booking= Booking::with('room')->find($id);
        // dd($booking);

        return view('pages.booking.show',compact('booking'));
    }
    public function Bookingcheckout($id) {

        $booking= Booking::with('room')->find($id);
        return view('pages.booking.checkout',compact('booking'));

    }
    public function checkoutCal(Request $request) {
        $payble_rent=0;
        $estimateDays=0;
       $bookings = Booking::with(['room'])->find($request->booking_id);
       if($bookings){
        $basetimein = strtotime($bookings->base_check_in_time) + 60*60*2;
        $basetimeout = strtotime($bookings->base_check_out_time) + 60*60*2;
        $timeinwithgraceperiod = date('H:i', $basetimein);
        $timeoutwithgraceperiod = date('H:i', $basetimeout);
         $start_datetime = $bookings->getRawOriginal('check_in_time');
         $start_datetimeone = date('Y-m-d',strtotime($start_datetime));
         $end_datetime = date('Y-m-d',strtotime($request->out_time));
         $checkouttime = date('H:i',strtotime($request->out_time));
        //  $interval = $start_datetimeone->diff($end_datetime);
         $date1 = new DateTime($start_datetime);
         $date2 = new DateTime($request->out_time);
         $interval = $date1->diff($date2);
        // $datetime_diff_Obj = date_diff(date_create($request->out_time), date_create($start_datetime));
    if (date('Y-m-d',strtotime($start_datetime))==date('Y-m-d',strtotime($request->out_time))) {
        $payble_rent =  $bookings->base_rent;
        $estimateDays = 1;
     }else{
        if ($timeoutwithgraceperiod < $checkouttime) {
            $estimateDays = $interval->days +1;
            $payble_rent = $bookings->base_rent * $estimateDays;
        }
        if($timeoutwithgraceperiod > $checkouttime){
            $estimateDays = $interval->days;
            $payble_rent = $bookings->base_rent * $estimateDays;
        }
     }
    // echo $datetime_diff_Obj->h; // hours
    // echo $datetime_diff_Obj->i ;// minutes
    // echo $datetime_diff_Obj->s; // seconds
       }
       return response()->json([
        'payble_rent'=>  $payble_rent,
        'estimateDays'=>$estimateDays,


       ]);

    }
}
