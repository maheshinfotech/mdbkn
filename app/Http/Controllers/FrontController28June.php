<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Machinery;
use App\Models\Machine;
use App\Models\FuelConsumptionReading;
use App\Models\MachineWorkingHour;
use Carbon\Carbon;

class FrontController extends Controller
{
    public function apiUser(){
        
        request()->validate([
            'email'     => 'required|exists:users' ,
            'password'  => 'required',
        ]);

        $credentials = request()->only('email', 'password');
        
        $credentials['is_active'] = 1;

        $credentials['accessibility'] = function($q){
                                            $q->whereIn('accessibility' , [2, 3]);
                                        };
 
        if (Auth::attempt($credentials)) {

            $auth = User::where( "email" , request()->email )->firstOrFail();

            DB::table("personal_access_tokens")->where('tokenable_id', '=', $auth->id)->delete();

            $token = auth("sanctum")->user()->createToken(request()->device_id ?? 'auth-token');

            $auth->id = encrypt($auth->id);

            $auth->is_manager = $auth->role_id == config('app.manager_role')  ?  1  :  0;

            $auth->makeHidden('role_id');

            return $this->generateJsonResponse( true , '' , [
                'token' => $token->plainTextToken,
                'user'  => $auth
            ]);

        }

        return $this->generateJsonResponse(false,config('app.loginFailed'));

    }

    public function getMachinery(){
        
        $query = null ; 
        if(auth('sanctum')->user()->role_id == '1'){

            $query = new Machine;

        }else{

            $query = auth('sanctum')->user()->machinery() ;

        }

        $machinery =    $query->active()->get()->map(function($machine){
            
                            $machine->closing_hour = MachineWorkingHour::where('machine_id' , $machine->id)->latest()->first()->closing_hours;

                            $machine->id = encrypt($machine->id);
                            
                            $machine->group->makeHidden('id');
                            
                            $machine->makeHidden('group_id');
                            
                            return $machine;

                        });
        
        return $this->generateJsonResponse( true , config('app.servedata') ,  $machinery );
    }

    public function getEmployees(){
            
            if(!auth('sanctum')->user()->role_id == config('app.manager_role') ){

                return $this->generateJsonResponse(false , config('app.unauthorized'));

            }

            $employees =    User::where("role_id" , config('app.employee_role') )->active()->get()->map(function($emp){
                                
                                $emp->id = encrypt($emp->id);

                                $emp->makeHidden('role_id');
                                
                                return $emp;
                                
                            });

            return $this->generateJsonResponse(true , config('app.servedata') , $employees);
            
    }

    public function checkMachineUpdatePermission($type = '1'){
        return in_array( auth('sanctum')->user()->machine_updation_permission , [ $type , '3' ]);
    }

    public function setFuelConsumption(){

        if( !$this->checkMachineUpdatePermission('1') ){

            return $this->generateResponse(false , config('app.unauthorized') );

        }

        request()->validate([
            'machine_id' => 'required' ,
            'reading_number' => 'required|integer' , 
            'fuel_in_liters' => 'required|integer' ,
        ]);

        $res  = FuelConsumptionReading::create([
            
                    'user_id' => request()->user_id ? decrypt(request()->user_id) : auth('sanctum')->user()->id , 

                    'machine_id' => decrypt(request()->machine_id) , 

                    'reading_number' => request()->reading_number , 
                    
                    'fuel_in_liters' => request()->fuel_in_liters ,

                ]);

        return $this->generateJsonResponse( $res );
    }

    public function setMachineWorkingHours(){

        if( !$this->checkMachineUpdatePermission('2') ){
            return $this->generateResponse(false , config('app.unauthorized') );
        }

        $machine_id = decrypt( request()->machine_id );

        $last_updated_record = MachineWorkingHour::where('machine_id' , $machine_id)->latest()->first();

        if( $last_updated_record && ( $last_updated_record->rawFormat == date('Y-m-d') && $last_updated_record->while_creating == '0') ){
            return $this->generateResponse(false , 'Closing Hours for this machine is already Updated.' );
        }

        request()->validate([
            'machine_id'    => 'required' ,
            'closing_hours' => 'required|integer|min:'.($last_updated_record->closing_hours ?? 0) ,
        ]);

        $res  = MachineWorkingHour::create([
            
                    'user_id' => request()->user_id ? decrypt( request()->user_id ) : auth('sanctum')->user()->id , 

                    'machine_id' =>  $machine_id, 

                    'opening_hours' => $last_updated_record->closing_hours ?? 0, 
                    
                    'closing_hours' => request()->closing_hours ,

                ]);

        return $this->generateJsonResponse( $res );

    }

    public function latestMachineWorkingHours(){
        
        request()->validate([
            'machine_id' => 'required' ,
        ]);

        $data = MachineWorkingHour::where('machine_id' , decrypt(request()->machine_id))
                            ->latest()->first();

        if($data)                            
            $data->makeHidden(['id' , 'machine_id' , 'user_id']);
        
        return $this->generateJsonResponse(true , '' , $data );

    }

    public function dashboard(){

        $res = auth('sanctum')->user();
        $res->id = encrypt($res->id);
        $res->permission = config('app.machine_permission');

        return $this->generateResponse(true , config('app.servedata') , $res);
    }

    public function massInsertFuelConsumption(){

        if( !$this->checkMachineUpdatePermission('1') ){
            return $this->generateResponse(false , config('app.unauthorized') );
        }

        request()->validate([
            'records' => 'required|array',
            'records.*.machine_id' => 'required' ,
            'records.*.reading_number' => 'required|integer' , 
            'records.*.fuel_in_liters' => 'required|integer' ,
            'records.*.record_time' => 'required|date_format:Y-m-d' ,
        ]);

        $mass_array = [];

        foreach (request()->records as $key => $record) {
            
            array_push($mass_array , [           
                                        'user_id'       => isset($record['user_id']) ? decrypt($record['user_id']) : auth('sanctum')->user()->id , 
                                        'machine_id'    => decrypt( $record['machine_id'] ) , 
                                        'reading_number'=> $record['reading_number'] , 
                                        'fuel_in_liters'=> $record['fuel_in_liters'] ,
                                        'created_at'    => $record['record_time'] ,
                                    ]);

        }

        $res  = FuelConsumptionReading::insert($mass_array);

        return $this->generateJsonResponse( $res );
    }
 
    public function massInsertWorkingHours(){

        if( !$this->checkMachineUpdatePermission('2') ){
            return $this->generateResponse(false , config('app.unauthorized') );
        }

        request()->validate([
            'records' => 'required|array',
            'records.*.machine_id' => 'required' ,
            'records.*.closing_hours' => 'required|integer' , 
            'records.*.record_date' => 'required|date_format:Y-m-d' ,
        ]);

        $records = request()->records;

        usort( $records , function($a , $b){
            $t1 = strtotime($a['record_date']);
            $t2 = strtotime($b['record_date']);
            return $t1 - $t2;
        });
        
        // try{
            
            DB::beginTransaction();

                foreach($records as $record){

                    $machine_id = decrypt($record['machine_id']);

                    $date_exists = MachineWorkingHour::where('machine_id' , $machine_id)->whereDate('created_at' , $record['record_date'])->count();

                    $last_updated_hour = MachineWorkingHour::where('machine_id' , $machine_id)->latest()->first()->closing_hours ?? 0;

                    if($date_exists){
                            
                            DB::table('rejected_closing_hours')->insert([
                                'user_id' => isset($record->user_id) ? decrypt($record->user_id) : auth('sanctum')->user()->id, 
                                'rejected_data' => json_encode($record) , 
                                'reason' => 'duplicate_date',
                                'created_at' => Carbon::now(),
                            ]);

                    }elseif( $record['closing_hours'] < $last_updated_hour ){
                            
                            DB::table('rejected_closing_hours')->insert([
                                'user_id' => isset($record->user_id) ? decrypt($record->user_id) : auth('sanctum')->user()->id, 
                                'rejected_data' => json_encode($record) , 
                                'reason' => 'invalid_closing_hour',
                                'created_at' => Carbon::now(),
                            ]);

                    }else{
                        
                        MachineWorkingHour::create([            
                            'user_id'       => isset($record['user_id']) ? decrypt( $record['user_id'] ) : auth('sanctum')->user()->id , 
                            'machine_id'    => $machine_id , 
                            'opening_hours' => $last_updated_hour ,                                
                            'closing_hours' => $record['closing_hours'] ,
                            'created_date'  => $record['record_date']
                        ]);
                    }

                }

            DB::commit();

            return $this->generateResponse(true);

        // }catch(\Exception $e){

        //     return $this->generateResponse(false , '' , $e);

        // }

    }

}