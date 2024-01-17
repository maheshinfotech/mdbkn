<?php

namespace App\Http\Controllers;

use App\Models\Ward;
use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospitals = Hospital::all();

        return view('pages.booking.add_hospital', ['hospitals' => $hospitals]);
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
        $hospital = new Hospital();
        $hospital->name = $request->input('name');
        $hospital->save();

        $hospitalId = $hospital->id;

        $wardArray = $request->input('wards');

        if ($wardArray) {
            foreach ($wardArray as $wardData) {
                foreach ($wardData as $wardName) {
                    $ward = new Ward();
                    $ward->hospital_id = $hospitalId;
                    $ward->ward = $wardName;
                    $ward->save();
                }
            }
        }

        return redirect('/add_hospital')->with('message', 'Data has been successfully stored.');
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // HospitalController.php

public function edit($id)
{
    $hospital = Hospital::with('wards')->find($id);

    return response()->json(['hospital' => $hospital]);
}



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // HospitalController.php

    public function update(Request $request, $id)
    {
         //dd($request->all());
        $hospital = Hospital::findOrFail($id);

        $hospital->name = $request->input('name');

        $hospital->save();

          if($hospital){
        $hospital->wards()->delete();
          }
        $existingWards = $request->input('wards');

        //   dd($hospital);
        // dd($request->all());
        //  dd($existingWards);
        if ($existingWards) {
            # code...

       foreach ($existingWards as $wardData) {
                foreach ($wardData as $wardName) {
                $ward = new Ward();
                $ward->hospital_id = $id;
                $ward->ward = $wardName;
                $ward->save();
            }

        }
    }
         //dd($hospital);
        // if ($existingWards->count() > 0) {
        //     foreach ($existingWards as $existingWard) {
        //         $existingWard->delete();
        //     }
        // }

        return redirect('/add_hospital')->with('message', 'Hospital updated successfully');
    }






    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();

        return response()->json(['message' => 'Hospital deleted successfully']);
    }
    public function getWards(Request $request)
{
    $hospitalId = $request->input('hospital_id');

    $wards = Ward::where('hospital_id', $hospitalId)->get();

    return response()->json(['wards' => $wards]);
}
}
