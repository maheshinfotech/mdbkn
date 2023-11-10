<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\Advance;
use App\Models\Setting;
use App\Models\Booking;
use App\Models\BookingLogs;
use App\Models\Parking;

use Illuminate\Support\Str;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function index()
    {
        // dd(config('app.parking_charge'));
        $bookings = Booking::orderBy('check_out_time', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.booking.view', compact('bookings'));
    }
//     public function index()
// {
//     // Retrieve bookings where check_out_time is null first, and then retrieve the rest.
//     $bookings = Booking::latest('id')
//         ->whereNull('check_out_time')
//         ->union(
//             Booking::latest('id')
//                 ->whereNotNull('check_out_time')
//         )
//         ->get();

//     return view('pages.booking.view', compact('bookings'));
// }

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
        $booking = new Booking;
        $booking->room_id=$request->room;
        $booking->guest_name=$request->guest_name;
        $booking->guest_father_name=$request->guest_father;
        $booking->guest_cast=$request->caste;
        $booking->guest_address=$request->guest_address;
        $booking->patient_name=$request->patient_name;
        $booking->patient_ward_no=$request->ward_no;
        $booking->pbm_room_no=$request->pbm_room_no;

        $booking->patient_bed_no=$request->bedno;
        $booking->advance_payment=$request->advance;
        $booking->gender=$request->gender;
        $booking->hospital_id=$request->hospital_id;

        // $booking->check_in_time= date('Y-m-d').' '.$request->checkin;
        $booking->check_in_time = $request->checkin;
        $booking->age=$request->age;
        $booking->city=$request->city;
        $booking->state=$request->state;
        $booking->docter_name=$request->doctor;
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
        $booking->tehsil            =   $request->tehsil;
        $booking->relation_patient  =   $request->relation;
        $booking->ward_type         =   $request->ward;
        $booking->is_admitted       =   $request->is_admit ? 1 : 0;
        $booking->patient_type      =   $request->patient;
        // rent ==================
        $roomcat = RoomCategory::where('id', $request->category)->first();

        // dd($roomcat,$request->all());
            // if($request->ward=="ct" || $request->ward=="rt"){
            if($request->patient=='cancer'){
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
        // $booking->save();
        // booking record save block end
        // ==================add guest code=============================

        //  if booking data save then this block execute
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

            if(request()->is_parking){

                $count = Parking::where( "vehicle_number" , request()->vehicle_number )->whereNull('parking_end')->count();
                if(!$count){
                    $res =  Parking::create([
                                // 'active_booking'  => $booking->id ?? 0 ,
                                'booking_id'  => $booking->id ?? 0 ,
                                'username'        => $booking->guest_name,
                                'userphone'       => $booking->mobile_number,
                                'vehicle_number'  => request()->vehicle_number,
                                'remark'          => request()->parking_notes ?? '',
                                'parking_start'   => date('Y-m-d H:i:s') ,
                            ]);

                }
            }

            // booking record save block end
            $room=Room::find($request->room);
            $room->is_booked=1;
            $room->booked_date = Carbon::parse($request->checkin)->format('Y-m-d');
            $room->save();

            $advance = new Advance;
            //dd($request->all());
            $advance->booking_id = $booking->id;
            $advance->amount = $booking->advance_payment;
            Log::info($request->checkin);
            $advance->received_date = Carbon::parse($request->checkin)->format('Y-m-d');
            $advance->save();
        }

        //  if booking data save then this block execute

            // =======================================================================

        // return redirect()->back()->with('message', 'Booking added successfully');
        return redirect()->route('index-booking')->with('message', 'Booking added successfully');


    }

    public function checkout(Request $request)
{
    Gate::authorize('update', 'booking');
    $checkoutdet = Booking::find($request->booking_id);
    $checkoutdet->check_out_time = $request->check_out_time;
    $checkoutdet->estimated_total_days = $request->estimatedays;
    $checkoutdet->payable_rent = $request->totalrent;

    // Fetch parking data based on parking_id
    $parking = Parking::find($request->parking_id);
    $parking->parking_end = $request->username;
    $parking->charges = $request->received_amount;
    // dd($parking);

    $parking->save();

    $amount = $request->totalrent - $request->advancepayment;

    if ($amount >= 0) {
        $checkoutdet->paid_rent = $request->paidrent ? $request->paidrent : 0;
    } else {
        $checkoutdet->advance_refund = $request->paidrent ? $request->paidrent : 0;
        $checkoutdet->paid_rent = 0;
    }
    $checkoutdet->save();

    // ==== room isbooked code ====
    if ($checkoutdet->save()) {
        $room = Room::find($checkoutdet->room_id);
        $room->is_booked = 0;
        $room->booked_date = null;
        $room->update();
    }

    return redirect()->route('index-booking')->with('message', 'Checked Out Details Saved Successfully');
}


    public function show($id){

        $booking= Booking::with(['room','bookinglogs','advance'])->find($id);
        // dd($booking);

        return view('pages.booking.show',compact('booking'));
    }

    public function Bookingcheckout($id) {

        $booking = Booking::with(['room','advance'])->find($id);
        $advanceAmt = 0;
        if ($booking && $booking->advance) {
            foreach ($booking->advance as $value) {
                $advanceAmt += $value->amount;
            }
        }
        $parkingData = Parking::where('booking_id', $id)->get();

        return view('pages.booking.checkout',compact('booking','advanceAmt','parkingData'));

    }
    // }

    public function checkoutCal(Request $request) {
        $payble_rent=0;
        $estimateDays=0;
        $bookings = Booking::with(['room'])->find($request->booking_id);
        if($bookings){
                $basetimein = date('H:i',strtotime($bookings->base_check_in_time) - 60*60*2);
                $basetimeout = date('H:i',strtotime($bookings->base_check_out_time) + 60*60*2);
                $start_datetime = date('H:i',strtotime($bookings->getRawOriginal('check_in_time')));
                $checkouttime = date('H:i',strtotime($request->out_time));
                $datetime1 = new DateTime(date('Y-m-d',strtotime($bookings->getRawOriginal('check_in_time'))));
                $datetime2 = new DateTime(date('Y-m-d',strtotime($request->out_time)));
                $days = $datetime1->diff($datetime2);

                // =================base checkout time compare
                if ($datetime1==$checkouttime) {
                    $payble_rent =  $bookings->base_rent;
                    $estimateDays = 1;
                }else{
                        if ($checkouttime >= $basetimeout) {
                            $estimateDays = $days->d +1;
                            $payble_rent = $bookings->base_rent * $estimateDays;
                        }else{
                            $estimateDays = $days->d;
                            $payble_rent = $bookings->base_rent * $estimateDays;
                        }
                }
                // base checkin time compare ==================
                    if ($start_datetime < $basetimein) {
                        $estimateDays = $days->d +1;
                        $payble_rent = $bookings->base_rent * $estimateDays;
                    }
                    // ==========================
                    if ($start_datetime < $basetimein && $checkouttime >= $basetimeout) {
                        $estimateDays = $days->d +2;
                        $payble_rent = $bookings->base_rent * $estimateDays;
                    }

        }
       return response()->json([
        'payble_rent'=>  $payble_rent,
        'estimateDays'=>$estimateDays,
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

    public function showBookings()
    {
        $bookings = Booking::with('room')
            ->whereNull('check_out_time')
            ->get();

        return view('pages.booking.index', compact('bookings'));
    }


    public function parkings() {
        $data['activeBooking'] = Booking::whereNull('check_out_time')->get();
        $data['listingData'] = Parking::whereNull('parking_end')->latest()->get();
        return view('parkings.index', $data);
    }

            public function edit(Request $request ,$id) {
                $editbooking =Booking::with(['room','bookinglogs','advance'])->find($id);
                $room = Room::find($editbooking->room_id)->toArray();
                 // onchange category edit ============

                if ($request->ajax()) {
                    if ($request->cate_id==$room['category_id']) {
                        $rooms=Room::where('category_id',$request->cate_id)->where(function ($query){
                            $query->whereNull('is_booked')->Orwhere('is_booked','!=',1);
                        })->where(function ($query){
                            $query->whereNull('room_status')->Orwhere('room_status','!=',0);
                        })->get()->toArray();
                        array_push($rooms,$room);
                        return response()->json($rooms);
                    }else{
                        $rooms=Room::where('category_id',$request->cate_id)->where(function ($query){
                            $query->whereNull('is_booked')->Orwhere('is_booked','!=',1);
                        })->where(function ($query){
                            $query->whereNull('room_status')->Orwhere('room_status','!=',0);
                        })->get()->toArray();

                        return response()->json($rooms);
                    }

                }
                $category = RoomCategory::all();

                $rooms=Room::where('category_id',$editbooking->room->category_id)->where(function ($query){
                    $query->whereNull('is_booked')->Orwhere('is_booked','!=',1);
                })->where(function ($query){
                    $query->whereNull('room_status')->Orwhere('room_status','!=',0);
                })->select('id','room_number')->get()->toArray();
                array_push($rooms,$room);
                return view('pages.booking.edit', compact('editbooking','category','rooms'));

            }


            public function update(Request $request,$id) {
            //    dd($request->all());
            $bookingedit = Booking::with('bookinglogs')->find($id);
            $bookingedit->room_id=$request->room;
            $bookingedit->guest_name=$request->guest_name;
            $bookingedit->guest_father_name=$request->guest_father;
            $bookingedit->guest_cast=$request->caste;
            $bookingedit->guest_address=$request->guest_address;
            $bookingedit->patient_name=$request->patient_name;
            $bookingedit->patient_ward_no=$request->ward_no;
            $bookingedit->pbm_room_no=$request->pbm_room_no;

            $bookingedit->patient_bed_no=$request->bedno;

            $bookingedit->gender=$request->gender;
            $bookingedit->hospital_id=$request->hospital_id;
            $bookingedit->check_in_time = $request->checkin;
            $bookingedit->age=$request->age;
            $bookingedit->city=$request->city;
            $bookingedit->state=$request->state;
            $bookingedit->docter_name=$request->doctor;
            $bookingedit->mobile_number=$request->mobile;
            // id proof saved ===========
                if ($request->hasFile('idproof')) {
                    $file = $request->file('idproof');
                    $imageName = 'Id_Proof_files/' . Str::random(40) . '.' . strtolower($file->getClientOriginalExtension());
                    $filePath = $file->storeAs('public/', $imageName);
                    $bookingedit->id_number=$imageName;
                }else{
                    $bookingedit->id_number=$bookingedit->id_number;
                }
            // ===============================
            $bookingedit->tehsil            =   $request->tehsil;
            $bookingedit->relation_patient  =   $request->relation;
            $bookingedit->ward_type         =   $request->ward;
            $bookingedit->is_admitted       =   $request->is_admit ? 1 : 0;
            $bookingedit->patient_type      =   $request->patient;
            // rent ==================
            $roomcat = RoomCategory::where('id', $request->category)->first();

            // dd($roomcat,$request->all());
                if($request->patient=="cancer"){
                    $bookingedit->base_rent = $roomcat->patient_rent;
                }else{
                    $bookingedit->base_rent = $roomcat->normal_rent;
                }
            // =======================

            $bookingedit->extra_remark=$request->remark;
            // ===settings table =========
            $setting = Setting::latest()->first();
            if($setting){
                $bookingedit->base_check_in_time = $setting->check_in_time;
                $bookingedit->base_check_out_time = $setting->check_out_time;
                $bookingedit->base_grace_period = $setting->grace_period;
            }
            // ===========
            $bookingedit->update();
            // booking record update block end
            // ==================add guest code=============================
            //  if booking data save then this block execute
            if($bookingedit->update()){

                $log = BookingLogs::where('booking_id',$id)->pluck('id')->toArray();
                if ($request->guestlists) {
                    $log_ids = array_column($request->guestlists,'logs_id');

                    $delete_log_ids= array_diff($log,$log_ids);
                    // dd($delete_log_ids);
                    foreach ($request->guestlists as $guests) {
                        foreach($delete_log_ids as $lid){
                            BookingLogs::where('id',$lid)->delete();
                        }
                        if($guests['guestname']!=''){
                            if (isset($guests['logs_id']) && $guests['logs_id']) {
                                $guest = BookingLogs::find($guests['logs_id']);
                                    $guest->guest_name = $guests['guestname'];
                                    $guest->guest_age = $guests['guestage'];
                                    $guest->guest_relation = $guests['guestrelation'];
                                    $guest->guest_remarks = $guests['guestremarks'];
                            // Create
                            } else {
                                $guest = new BookingLogs();
                                $guest->guest_name = $guests['guestname'];
                                $guest->guest_age = $guests['guestage'];
                                $guest->guest_relation = $guests['guestrelation'];
                                $guest->guest_remarks = $guests['guestremarks'];
                                $guest->booking_id = $id;
                            }
                            $guest->save();
                        }
                    }
                }else{
                  if($log){
                    foreach($log as $loid){
                        BookingLogs::where('id',$loid)->delete();
                    }
                  }
                }
                // ================
                // booking record save block end
                $room=Room::find($request->room);
                $room->is_booked=1;
                $room->booked_date = Carbon::parse($request->checkin)->format('Y-m-d');
                $room->update();
                if ($request->advance) {
                    foreach ($request->advance as $value) {
                        // dd($value);
                        $advance =  Advance::where('booking_id',$bookingedit->id)->first();
                        //dd($request->all());
                        $advance->booking_id = $bookingedit->id;
                        $advance->amount = $value;
                        // Log::info($request->checkin);
                        $advance->received_date = Carbon::parse($request->checkin)->format('Y-m-d');
                        $advance->update();
                    }
                }
                }
                // =======================================================================
            return redirect()->route('index-booking')->with('message', 'Booking Updated successfully');
            }


    public function addParking(){

        request()->validate([
            'active_booking' => 'required',
            'username'       => 'required',
            'userphone'      => 'required',
            'vehicle'        => 'required'

        ]);

        $count = Parking::where( "vehicle_number" , request()->vehicle )->whereNull('parking_end')->count();

        if($count){

            $this->setFlashSession( false , "this Vehicle is already Parked, Kindly Check." );

            return redirect()->back();

        }

        $res =  Parking::create([

                    'booking_id'    => request()->active_booking ?? 0 ,

                    'username'          => request()->username ?? '',

                    'userphone'         => request()->userphone ?? '',

                    'vehicle_number'    => request()->vehicle ?? '',

                    'remark'            => request()->remark ?? '',

                    'parking_start'     => request()->start_date ?? date('Y-m-d H:i:s'),

                ]);

        $this->setFlashSession($res);

        return redirect()->back();

    }

    public function clearParking(Request $request){
    request()->validate([
        'username' => 'required',
        'received_amount' => 'required',
        'parking_id'  => 'required'
    ]);

    $parkingId = $request->input('parking_id');
    $receivedAmount = $request->input('received_amount');
    $endDate = $request->input('username');

    $parking = Parking::find($parkingId);

    if ($parking) {
        $parking->parking_end = $endDate;
        $parking->charges = $receivedAmount;
        $parking->save();

        return redirect()->back();
    } else {

    }
}

    public function parkingFetchCharge(){

        request()->validate([
            'end_date' => 'required' ,
            'parking_id'  => 'required'
        ]);
        $parking = Parking::findOrFail(request()->parking_id);
        $settings = Setting::latest()->first();
        $basetimein = date('H:i',strtotime($settings->check_in_time) - 60*60*2);
        $basetimeout = date('H:i',strtotime($settings->check_out_time) + 60*60*2);
        $stdatetime = date('H:i',strtotime($parking->parking_start));
        $chouttime = date('H:i',strtotime(request()->end_date));
        $start  = Carbon::parse(date('Y-m-d',strtotime($parking->parking_start)));
        $end    = Carbon::parse(date('Y-m-d',strtotime(request()->end_date)));

        $difference_days = $end->diff($start);
            // =================base checkout time compare
            if ($start==$end) {
                $estimateDays = 1;
                $paid = $estimateDays * config('app.parking_charge');
            }else{
                    if ($chouttime >= $basetimeout) {
                        $estimateDays = $difference_days->d +1;
                        $paid = config('app.parking_charge') * $estimateDays;
                    }else{
                        $estimateDays = $difference_days->d;
                        $paid = config('app.parking_charge') * $estimateDays;
                    }
            }
            // base checkin time compare ==================
                if ($stdatetime < $basetimein) {
                    $estimateDays = $difference_days->d +1;
                    $paid = config('app.parking_charge') * $estimateDays;
                }
                // ==========================
                if ($stdatetime < $basetimein && $chouttime >= $basetimeout) {
                    $estimateDays = $difference_days->d +2;
                    $paid = config('app.parking_charge') * $estimateDays;
                }




        return  $this->generateJsonResponse(true, '', [
                                                        'paid_amount' => $paid
                                                    ]
                );

    }


    public function todaycheckout() {
        $todaycheckout = Booking::with(['advance','room'])->whereDate('check_out_time', Carbon::today())->get();
        return view('pages.booking.today_booking_checkout',compact('todaycheckout'));
    }

    public function balancedue() {
        $bookingdue = Booking::with('advance')->whereNull('check_out_time')->get();
        $totalrentcount=[];
        $due=0;
            foreach ($bookingdue as $value) {
            //   $ttt =  $this->getdueRent($value,$totalrentcount);
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
                if ($totamt > $amount) {
                    $due = $totamt - $amount;
                    $value->due = $due;
                    if($due>0){
                        // $totalrent = $value->id;
                        $totalrent = $value;
                        array_push($totalrentcount,$totalrent);
                    }
                }
        }
        return view('pages.booking.balance-due',compact('totalrentcount'));
    }

}


