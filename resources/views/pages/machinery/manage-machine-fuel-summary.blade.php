
@php
    
    $is_update_form = true;
    
    $action_url = route("update-fuel-reading" , ['id' => $formData->id] );
    
    $reading_number = old('reading_number', $formData->reading_number ?? '');
    
    $fuel_in_liters = old('fuel_in_liters', $formData->fuel_in_liters ?? '');

    $pageName = "Manage Fuel Reading";

@endphp

@extends('layouts.backend' , ['pageName' => $pageName , 'parentRoute' => "fuel-consumption-reading"])

@section('content')

    <x-reusables.app-header pageName="{{$pageName}}" :createButton="false" module="machinery"  />
    
    <div class="content  mx-0 w-100">
        
        <div class="block block-rounded">

            <div class="block-content block-content-full">

                <form action="{{ $action_url }}" method="post">

                    @csrf
                   
                    <div class="row justify-content-center">
                        <div class="col">
                            <label class="form-label" >Reading Number<span class="text-danger">*</span></label>
                            <input class="form-control"
                                name="reading_number" value="{{ $reading_number }}" type="number" required>
                        </div>
                        <div class="col">
                            <label class="form-label" >Fuel Consumption<span class="text-danger">*</span></label>
                            <input class="form-control"
                                name="fuel_in_liters" value="{{ $fuel_in_liters }}" type="number" required>
                        </div>

                    </div>

                    <x-reusables.form-footer route="fuel-consumption-reading-listing" action="{{'update'}}" module="fuel-consumption-reading"/>

                </form>  
            </div>
        </div>
    </div>
@endsection