<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Gate;

class GroupController extends Controller
{
    public function index(){

        Gate::authorize('view' , 'group');

        $data = Group::order()->get()->map(function($group){
            
            $group->id = encrypt($group->id);
            
            return $group;
        });

        return view('pages.group.view-group' , [
            'listingData' => $data 
        ]);

    }

    public function showForm( $group_placeholder = null){

        if($group_placeholder){
            
            Gate::authorize('view' , 'group');

            $group = Group::findOrFail(decrypt($group_placeholder));

            $group->id = encrypt($group->id);

        }else{

            Gate::authorize('create' , 'group');

        }

        return view('pages.group.manage-group' , [ 'formData' => $group ??  [] ]);
        
    }

    public function manage($id = null){
        
        if($id){

            Gate::authorize('update' , 'group');

        }else{

            Gate::authorize('create' , 'group');
            
        }

        $id = $id ? decrypt($id) : null ;

        request()->validate([
            'group_name' =>  'required|string|unique:groups,group_name'.($id ? ",$id" : '')  , 
        ]);

        $obj = $id ? Group::findOrFail($id) : new Group();

        $obj->group_name = request()->group_name ; 

        $obj->group_description = request()->group_description ?? null; 
        
        $this->setFlashSession($obj->save());

        return redirect()->route('index-group');
    }

    public function toggleStatus($group_placeholder){

        if(Gate::allows('update' , 'group')){
            
            $group = Group::findOrFail(decrypt($group_placeholder));

            $group->is_active = !$group->is_active ; 

            $this->setFlashSession($group->save());

        }

        return redirect()->route('index-group');

    }

    public function delete($id){
        
        Gate::authorize('delete' , 'group');
            
        $group = Group::findOrFail(decrypt($id));
        
        if($group->machinery()->exists())

            return $this->generateResponse(false , 'Opps! So Many Machinery are Associated with this Group so can\'t Delete this.');

        return $this->generateResponse($group->delete());

    }
}
