<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\Group;
use App\Models\User;

use App\Imports\ImportClosingHours;
use App\Imports\ImportFuelReading;

use Carbon\Carbon;

use App\Models\FuelConsumptionReading;
use App\Models\MachineWorkingHour;

use Maatwebsite\Excel\Facades\Excel;

use SimpleSoftwareIO\QrCode\Facades\QrCode;


class MachineryController extends Controller
{

    public function index(){

        Gate::authorize('view', 'machinery');

        $data = Machine::order()->get()->map(function($machine){

                    $machine->id = encrypt($machine->id);

                    return $machine;

                });

        return view('pages.machinery.view-machinery' , [
            'listingData' => $data
        ]);

    }

    public function showForm( $machinery_placeholder = null){

        if($machinery_placeholder){

            $machine = Machine::with(['workingHours' => function($q){
                                            $q->app();
                                    }])
                        ->findOrFail(decrypt($machinery_placeholder));

            $machine->id = encrypt($machine->id);

            Gate::authorize('view' , 'machinery');

        }else{

            Gate::authorize('create' , 'machinery');

        }

        return view('pages.machinery.manage-machinery' , [ 'formData' => $machine ??  null , 'groups' => Group::active()->orderBy('group_name')->get()]);

    }

    public function manage($id = null){

        if($id){

            Gate::authorize('update' , 'machinery');

        }else{

            Gate::authorize('create' , 'machinery');

        }

        $id = $id ? decrypt($id) : null ;

        request()->validate([

            'machine_name' =>  'required|string|unique:machinery,machine_name'.($id ? ",$id" : '')  ,

            'group_id' => 'required|exists:groups,id',

            'last_closing_hours' => $id ? 'nullable' : 'required|integer',

        ]);

        $obj = $id ? Machine::findOrFail($id) : new Machine();

        $obj->machine_name          = request()->machine_name ;

        $obj->machine_description   = request()->machine_description ?? null;

        $obj->group_id              = request()->group_id;

        $res = $obj->save();

        $affected_obj = $id ? Machine::findOrFail($id) : Machine::latest()->first();

        if(request()->last_closing_hours && !$affected_obj->workingHours()->app()->count()){

            $affected_obj->workingHours()->delete();

            MachineWorkingHour::create([
                'opening_hours' => 0 ,
                'closing_hours' => request()->last_closing_hours ?? 0 ,
                'machine_id'    => $affected_obj->id ,
                'user_id'       => auth()->user()->id ,
                'while_creating'=> 1
            ]);

        }

        $qrcode_generator =  QrCode::generate(json_encode([
                                'label' => request()->machine_name ,
                                'id'    => encrypt($affected_obj->id) ,
                            ]));

        $affected_obj->qrcode = $qrcode_generator;

        $res = $affected_obj->save();

        $this->setFlashSession($res);

        return redirect()->route('index-machinery');
    }

    public function toggleStatus($machine_placeholder){

        if(Gate::allows('update' , 'machinery')){

            $machine = Machine::findOrFail(decrypt($machine_placeholder));

            $machine->is_active = !$machine->is_active ;

            $this->setFlashSession($machine->save());

        }

        return redirect()->route('index-machinery');

    }

    public function delete($id){

        Gate::authorize('delete' , 'machinery');

        $machine = Machine::findOrFail(decrypt($id));

        if($machine->users()->exists())

            return $this->generateResponse(false , 'Opps! So Many Users are Associated with this Machinery so can\'t Delete this.');

        if($machine->fuelConsumption()->exists())

            return $this->generateResponse(false , 'Opps! fuel Consumptions records are Associated with this Machinery so can\'t Delete this.');

        if($machine->workingHours()->app()->exists())

            return $this->generateResponse(false , 'Opps! Working Hours are Associated with this Machinery so can\'t Delete this.');

        return $this->generateResponse($machine->delete());

    }

    public function fuelConsumptionReading(){

        Gate::authorize('view' , 'fuel-consumption-reading');

        $query =  FuelConsumptionReading::whereHas('machinery');

        if(request()->user_id)
            $query = $query->where('user_id' , request()->user_id);

        if(request()->machine_id)
            $query = $query->where('machine_id' , request()->machine_id);

        if(request()->start_date)
            $query = $query->whereDate('created_at' , '>='  ,  request()->start_date);

        if(request()->end_date)
            $query = $query->whereDate('created_at' , '<='  ,  request()->end_date);

        if(!request()->start_date && !request()->end_date){

            $start_date = date("Y-m-d", strtotime("-7 days"));

            $end_date   = date('Y-m-d');

            $query = $query->whereDate('created_at' , '>='  ,  $start_date)->whereDate('created_at' , '<='  ,  $end_date);

        }

        return view('pages.machinery.fuel-consumption-reading' , [

            'listingData' => $query->get(),

            'users'       => User::orderBy('name')->get(),

            'machinery'   => Machine::orderBy('machine_name')->get(),

            'dates'       => [

                'start_date' => request()->start_date ?? $start_date ,

                'end_date'   => request()->end_date ?? $end_date ,

            ]

        ]);
    }

    public function machineWorkingHours(){

        Gate::authorize('view' , 'machine-working-hours');

        $query =  MachineWorkingHour::app()->whereHas('machinery');

        if(request()->user_id)
            $query = $query->where('user_id' , request()->user_id);

        if(request()->machine_id)
            $query = $query->where('machine_id' , request()->machine_id);

        if(request()->start_date)
            $query = $query->whereDate('created_at' , '>='  ,  request()->start_date);

        if(request()->end_date)
            $query = $query->whereDate('created_at' , '<='  ,  request()->end_date);

        if(!request()->start_date && !request()->end_date){

            $start_date = date("Y-m-d", strtotime("-7 days"));

            $end_date   = date('Y-m-d');

            $query = $query->whereDate('created_at' , '>='  ,  $start_date)->whereDate('created_at' , '<='  ,  $end_date);

        }

        return view('pages.machinery.machine-working-hours' , [

            'users'       => User::orderBy('name')->get(),

            'machinery'   => Machine::orderBy('machine_name')->get(),

            'listingData' => $query->get(),

            'dates'       => [
                'start_date' => request()->start_date ?? $start_date ,
                'end_date'   => request()->end_date ?? $end_date ,
            ]

        ]);
    }

    /**Updation Work */
    public function showMachineWorkingHour($id){

        Gate::authorize('update' , 'machine-working-hours');

        $id = decrypt($id);

        $data = MachineWorkingHour::findOrFail($id);

        $data->id = encrypt($data->id);

        // return view('pages.machinery.manage-machine-working-hour' , [
        //     'formData' => $data ,
        // ]);
        return view('pages.machinery.manage-machine-closing-hours' , [
            'formData' => $data ,
        ]);
    }

    public function updateMachineWorkingHour($id){

        Gate::authorize('update' , 'machine-working-hours');

            $id = decrypt($id);

            $data = [];

            $working_hour = MachineWorkingHour::findOrFail($id);

            $data['updated_record_id'] = $id ;
            $data['previous_data'] = json_encode($working_hour);

            $working_hour->opening_hours = request()->opening_hours;
            $working_hour->closing_hours = request()->closing_hours;

            $working_hour->save();

            $data['new_data'] = json_encode(MachineWorkingHour::findOrFail($id));
            $data['user_id']     = auth()->user()->id;
            $data['created_at']  = Carbon::now();

            $res = DB::table('update_working_hours_log')->insert($data);

            $this->setFlashSession($res);

            return redirect()->route('machine-working-hours-listing');
    }

    public function showFuelReading($id){

        Gate::authorize('update' , 'fuel-consumption-reading');

        $id = decrypt($id);

        $data = FuelConsumptionReading::findOrFail($id);

        $data->id = encrypt($data->id);

        return view('pages.machinery.manage-machine-fuel-summary' , [
            'formData' => $data ,
        ]);
    }

    public function updateFuelReading($id){

            Gate::authorize('view' , 'fuel-consumption-reading');

            $id = decrypt($id);
            $data = [];

            $fuel_reading = FuelConsumptionReading::findOrFail($id);

            $data['updated_record_id'] = $id ;
            $data['previous_data'] = json_encode($fuel_reading);

            $fuel_reading->reading_number = request()->reading_number;
            $fuel_reading->fuel_in_liters = request()->fuel_in_liters;

            $fuel_reading->save();

            $data['user_id']     = auth()->user()->id;
            $data['created_at']  = Carbon::now();
            $data['new_data']    = json_encode(FuelConsumptionReading::findOrFail($id));

            $res = DB::table('update_fuel_consumption_log')->insert($data);

            $this->setFlashSession($res);

            return redirect()->route('fuel-consumption-reading-listing');

    }

    /**End of Updation Work */

    public function machineFuelSummary(){

        Gate::authorize('view' , 'machine-fuel-summary');

        $data = [];

        $data['groups']     =   Group::active()->orderBy('group_name')->get()->where(function($group){

                                    $group->id = encrypt($group->id);

                                    return $group;

                                });

        $summarized_group   =  request()->group_id ? Group::findorFail(decrypt(request()->group_id)) : Group::orderBy('group_name')->first() ;

        $data['group']      =  $summarized_group ;

        $query              = new FuelConsumptionReading ;

        if(request()->start_date){

            $query = $query->whereDate('created_at' , '>=' , request()->start_date);

        }

        if(request()->end_date){

            $query = $query->whereDate('created_at' , '<=' , request()->end_date);

        }

        if(!request()->start_date && !request()->end_date){

            $start_date = date("Y-m-d", strtotime("-7 days"));

            $end_date   = date('Y-m-d');

            $query = $query->whereDate('created_at' , '>='  ,  $start_date)->whereDate('created_at' , '<='  ,  $end_date);

        }

        $data['listingData'] =  $query->whereHas('machinery' , function($q) use($summarized_group){

                                        $q->where('group_id' , $summarized_group->id ) ;

                                })->groupByRaw('date(created_at)')

                                ->orderByDesc('created_at')->get();

        $data['dates']  =   [
                                'start_date' => request()->start_date ?? $start_date ,
                                'end_date'   => request()->end_date ?? $end_date ,
                                'filtered_group' => $summarized_group->id
                            ];

        return view('pages.machinery.machine-fuel-summary' , $data);

    }

    public function groupFuelSummary(){

        Gate::authorize('view' , 'group-fuel-summary');

        $data = [];

        $data['groups']      = Group::active()->get();

        $query               =  new FuelConsumptionReading;

        if(request()->start_date){

            $query = $query->whereDate('created_at' , '>=' , request()->start_date);

        }

        if(request()->end_date){

            $query = $query->whereDate('created_at' , '<=' , request()->end_date);

        }

        if(!request()->start_date && !request()->end_date){

            $start_date = date("Y-m-d", strtotime("-7 days"));

            $end_date   = date('Y-m-d');

            $query = $query->whereDate('created_at' , '>='  ,  $start_date)->whereDate('created_at' , '<='  ,  $end_date);

        }

        $data['listingData'] = $query->groupByRaw('date(created_at)')->orderByDesc('created_at')->get();

        $data['dates']  =   [
                                'start_date' => request()->start_date ?? $start_date ,
                                'end_date'   => request()->end_date ?? $end_date ,
                            ];

        return view('pages.machinery.group-fuel-summary' , $data);

    }

    public function monthlyReport(){

        Gate::authorize('view' , 'monthly-report');

        $machines = Machine::orderBy('machine_name')->get()->map(function($result){

                        $result->id = encrypt($result->id);

                        return $result ;
                    });

        $year    =  request()->year ?? date('Y') ;

        $requested_machine_id = request()->machine_id ? decrypt( request()->machine_id) : Machine::active()->orderBy('machine_name')->firstOrFail()->id;

        $machine =  Machine::with([
                        'workingHours' => function($q) use($year){
                                $q->app()->selectRaw("count(*) as days , SUM(opening_hours) as open_sum , SUM(closing_hours) as close_sum")
                                ->whereYear('created_at' , $year )
                                ->groupByRaw("date_format(created_at , '%Y-%m')")->get();
                        }
                    ])
                    ->where("id" , $requested_machine_id )
                    ->firstOrFail();

        $autofill = (object)[
            'selected_machine' => $requested_machine_id ,
            'year' => $year
        ];

        return view('pages.machinery.monthly-report' , compact('machine' , 'machines' , 'autofill') );
    }

    public function massInsertMachineHours(){

        Gate::authorize('create' , 'machine-working-hours');

        try{

            $res = Excel::import(new ImportClosingHours, request()->file('excel_data'));

            $this->setFlashSession($res);

            return redirect()->route('machine-working-hours-listing');

        }catch(\Exception $e){

            $this->setFlashSession(false);

            return redirect()->route('create-machine-hours');

        }catch(\Error $e){

            $this->setFlashSession(false , "Kindly Follow the Format of Excel Sheet to Insert Data.");

            return redirect()->route('create-machine-hours');

        }

    }

    public function massInsertFuelConsumption(){

        Gate::authorize('create' , 'fuel-consumption-reading');

        try{

            $res = Excel::import(new ImportFuelReading, request()->file('excel_data'));

            $this->setFlashSession($res);

            return redirect()->route('fuel-consumption-reading-listing');

        }catch(\Exception $e){

            $this->setFlashSession(false);

            return redirect()->route('create-fuel-reading');

        }catch(\Error $e){

            $this->setFlashSession(false , "Kindly Follow the Format of Excel Sheet to Insert Data.");

            return redirect()->route('create-fuel-reading');

        }

    }

    public function createFuelReading(){

        Gate::authorize('create' , 'fuel-consumption-reading');

        return view('pages.machinery.create-fuel-reading' , [
            'machinery'   => Machine::orderBy('machine_name')->get(),
        ]);
    }

    public function createMachineHours(){

        Gate::authorize('create' , 'machine-working-hours');

        return view('pages.machinery.create-machine-hours' , [
            'machinery'   => Machine::orderBy('machine_name')->get(),
        ]);
    }
}
