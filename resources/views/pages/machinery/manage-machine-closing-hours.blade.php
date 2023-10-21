
@php
    
    $is_update_form = true;
    
    $action_url = route("update-machine-working-hours" , ['id' => $formData->id] );
    
    $opening_hours = old('opening_hours', $formData->opening_hours ?? '');
    
    $closing_hours = old('closing_hours', $formData->closing_hours ?? '');

    $pageName = "Manage Working Hours";

@endphp

@extends('layouts.backend' , ['pageName' => $pageName , 'parentRoute' => "machine-working-hours"])

@section('content')

    <x-reusables.app-header pageName="{{$pageName}}" :createButton="false" module="machinery"  />
    
    <div class="content  mx-0 w-100">
        
        <div class="block block-rounded">

            <div class="block-content block-content-full">

                <form action="{{ $action_url }}" method="post">

                    @csrf
                   
                    <div class="row justify-content-center">
                        <div class="col">
                            <label class="form-label" >Opening Hours<span class="text-danger">*</span></label>
                            <input class="form-control"
                                name="opening_hours" value="{{ $opening_hours }}" type="number" required>
                        </div>
                        <div class="col">
                            <label class="form-label" >Closing Hours<span class="text-danger">*</span></label>
                            <input class="form-control"
                                name="closing_hours" value="{{ $closing_hours }}" type="number" required>
                        </div>

                    </div>

                    <x-reusables.form-footer route="machine-working-hours-listing" action="{{'update'}}" module="machine-working-hours"/>

                </form>  
            </div>
        </div>
    </div>
@endsection