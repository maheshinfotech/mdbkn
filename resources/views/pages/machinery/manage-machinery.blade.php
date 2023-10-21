
@php
    
    $is_update_form = $formData ? true : false;
    
    $action_url = $is_update_form ? route("update-machinery" , ['machinery_placeholder' => $formData->id  ])  : route("create-machinery");
    
    $machinery_name = old('machine_name', $formData->machine_name ?? '');
    
    $machinery_description = old('machine_description', $formData->machine_description ?? '');

    $group_id = old('group_id', $formData->group_id ?? 0);
    
    $is_active = old('is_active', $formData->is_active ?? '');
    
    $pageName = "Manage Machine";

@endphp

@extends('layouts.backend' , ['pageName' => "Manage Machine" , 'parentRoute' => "machinery"])

{{-- {{dd($formData ?  $formData->workingHours()->count() : "")}} --}}

{{-- {{dd($formData ?  "HElo JAya".$formData->workingHours->count() : "")}} --}}

@section('content')

    <x-reusables.app-header pageName="{{$pageName}}" :createButton="false" module="machinery"  />
    
    <div class="content  mx-0 w-100">
        
        <div class="block block-rounded">

            <div class="block-content block-content-full">

                <form action="{{ $action_url }}" method="post">
                    @csrf
                    @if ($is_update_form)
                        @method('PUT')
                    @endif

                    <div class="row justify-content-center">
                        <div class="col">
                            <label class="form-label" >Machine Name<span class="text-danger">*</span></label>
                            <input class="form-control"
                                placeholder-m="Machinery Name" name="machine_name" value="{{ $machinery_name }}" type="text" required>
                        </div>
                        <div class="col">
                            <label class="form-label" >Select Group<span class="text-danger">*</span></label>
                            <select class="form-control" name="group_id" id="" required>
                                @foreach ($groups as $group)
                                    
                                <option value="{{$group->id}}" {{$group->id == $group_id ? "selected" : ""}}>
                                    {{ucfirst($group->group_name)}}
                                </option>

                                @endforeach
                            </select>
                        </div>
                        
                        @if (!$formData || !$formData->workingHours->count())
                            <div class="col">
                                <label class="form-label" >Last Closing Hours<span class="text-danger">*</span></label>
                                <input class="form-control" name="last_closing_hours" type="number" required>
                            </div>
                        @endif
                    </div>
                    
                    <div class="row justify-content-center mt-4">
                        <div class="col-12">
                            <label class="form-label" >Machine Description</label>
                            <textarea class="form-control"
                                placeholder-m="Machinery Description" name="machine_description"  type="text" >{{ $machinery_description }}</textarea>
                        </div>
                    </div>
                    
                    <x-reusables.form-footer route="index-machinery" action="{{$is_update_form ? 'update' : 'create'}}" module="machinery"/>

                </form>

            </div>
        </div>
    </div>
@endsection
