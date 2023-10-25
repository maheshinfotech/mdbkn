<?php

namespace App\Http\Controllers;

use App\Models\Room;
use  App\Models\Booking;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Support\Str;
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
