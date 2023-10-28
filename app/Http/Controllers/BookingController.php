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
            // $rooms=Room::where('category_id',$request->id)->where('is_booked','!=',1)->get();
            $rooms=Room::where('category_id',$request->id)->where(function ($query){
                $query->whereNull('is_booked')->Orwhere('is_booked','!=',1);
            })->where(function ($query){
                $query->whereNull('room_status')->Orwhere('room_status','!=',0);
            })->get();
            return response()->json($rooms);
        }
        $category = RoomCategory::all();

        // dd($rooms);
        return view('pages.booking.create', compact('category'));
    }

    public function store(Request $request)
    {
        // Gate::authorize('create', 'booking');
        dd($request->all());

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
        $booking->gender=$request->gender;
        $booking->hospital_id=$request->hospital_id;

        // $booking->check_in_time= date('Y-m-d').' '.$request->checkin;
        $booking->check_in_time = $request->checkin;
        $booking->age=$request->age;
        $booking->city=$request->city;
        $booking->state=$request->state;
        $booking->docter_name=$request->docter;
        $booking->mobile_number=$request->mobile;
        // id proof saved ===========
        if ($request->imageidprf) {
            $bookdet=Booking::find($request->imageidprf);
        if ($request->hasFile('idproof')) {
            $file = $request->file('idproof');
            $imageName = 'Id_Proof_files/' . Str::random(40) . '.' . strtolower($file->getClientOriginalExtension());
            $filePath = $file->storeAs('public/', $imageName);
            $booking->id_number=$imageName;
        }else{
                $booking->id_number=$bookdet->id_number;

        }
        }else{
            if ($request->hasFile('idproof')) {
                $file = $request->file('idproof');
                $imageName = 'Id_Proof_files/' . Str::random(40) . '.' . strtolower($file->getClientOriginalExtension());
                $filePath = $file->storeAs('public/', $imageName);
                $booking->id_number=$imageName;
            }
        }
        // ===============================
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
                    if ($guests['guestname']!='') {
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
            }
            // =======================================================================

            if ($booking->save()){
            // booking record save block end
            $room=Room::find($request->room);
            $room->is_booked=1;
            $room->booked_date = date('Y-m-d');
            $room->save();
            // room booking status
            }
        // return redirect()->back()->with('message', 'Booking added successfully');
        return redirect()->route('index-booking')->with('message', 'Booking added successfully');
        // return view('pages.booking.create');


    }

    public function checkout(Request $request)
    {
        Gate::authorize('update', 'booking');
        // dd($request->all());
        $checkoutdet = Booking::find($request->booking_id);
        $checkoutdet->check_out_time = $request->check_out_time;
        $checkoutdet->estimated_total_days = $request->estimatedays;
        $checkoutdet->payable_rent = $request->totalrent;
        $checkoutdet->paid_rent = $request->paidrent;
        $checkoutdet->save();
        //    ======room isbooked code ================
        if ($checkoutdet->save()) {
            $room=Room::find($checkoutdet->room_id);
            $room->is_booked=0;
            $room->booked_date = null;
            $room->update();
        }


    return redirect()->route('index-booking')->with('message', 'Checked Out Details Saved Successfully');

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
            $basetimein = strtotime($bookings->base_check_in_time) - 60*60*2;
            $basetimeout = strtotime($bookings->base_check_out_time) + 60*60*2;
            $timeinwithgraceperiod = date('H:i', $basetimein);
            $timeoutwithgraceperiod = date('H:i', $basetimeout);
            $start_datetime = $bookings->getRawOriginal('check_in_time');
            $start_datetimeone = date('Y-m-d',strtotime($start_datetime));
            $checkintime = date('H:i',strtotime($start_datetime));
            $end_datetime = date('Y-m-d',strtotime($request->out_time));
            $checkouttime = date('H:i',strtotime($request->out_time));
            $date1 = new DateTime($start_datetime);
            $date2 = new DateTime($request->out_time);
            $startTimeStamp = strtotime($date1->format('d-m-Y'));
            $endTimeStamp = strtotime($date2->format('d-m-Y'));
            $timeDiff = abs($endTimeStamp - $startTimeStamp);
            //  $days = $timeDiff / (60 * 60 * 24);
            $numberDays = $timeDiff/86400;
            $numberDays = intval($numberDays);
            // =================base checkout time compare
            if ($date1->format('d-m-Y')==$date2->format('d-m-Y')) {
                $payble_rent =  $bookings->base_rent;
                $estimateDays = 1;
            }else{
                    if ($checkouttime >= $timeoutwithgraceperiod) {
                        $estimateDays = $numberDays +1;
                        $payble_rent = $bookings->base_rent * $estimateDays;
                    }else{
                        $estimateDays = $numberDays;
                        $payble_rent = $bookings->base_rent * $estimateDays;
                    }
            }
            // base checkin time compare ==================
                if ($checkintime < $timeinwithgraceperiod) {
                    $estimateDays = $numberDays +1;
                    $payble_rent = $bookings->base_rent * $estimateDays;
                }
                // ==========================
                if ($checkintime < $timeinwithgraceperiod && $checkouttime >= $timeoutwithgraceperiod) {
                    $estimateDays = $numberDays +2;
                    $payble_rent = $bookings->base_rent * $estimateDays;
                }

       }
       return response()->json([
        'payble_rent'=>  $payble_rent,
        'estimateDays'=>$estimateDays,
        'basetimein'=>$checkintime
       ]);

    }


    public function getguestpreviousdetails(Request $request) {
        $guestpredetail = Booking::where('mobile_number',$request->numb)->latest()->first();

            return response()->json(
                [
                'guestpredetail'=>$guestpredetail
                ]
            );


     }
}
