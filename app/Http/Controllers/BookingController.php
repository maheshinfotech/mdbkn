<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
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
    public function create()

    {
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
$booking->is_parking_provided=$request->parking;
$booking->extra_remark=$request->remark;
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


return redirect()->back()->with('message', 'Booking added successfully');
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
}
