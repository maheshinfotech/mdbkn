
@php
    
    $is_update_form = $formData ? true : false;
    
    $action_url = $is_update_form ? route("update-group" , ['group_placeholder' => $formData->id  ])  : route("create-group");
    
    $group_name = old('group_name', $formData->group_name ?? '');

    $group_description = old('group_description', $formData->group_description ?? '');
    
    $is_active = old('is_active', $formData->is_active ?? '');
    
    $pageName = "Manage Group";

@endphp

@extends('layouts.backend' , ['pageName' => $pageName , 'parentRoute' => "groups" ])

{{-- @section('js')
    @vite(['resources/js/pages/datatables.js'])
@endsection --}}

@section('content')
    <x-reusables.app-header pageName="{{$pageName}}" :createButton="false" module="group"  />
    <div class="content  mx-0 w-100">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form action="{{ $action_url }}" method="post">
                    @csrf
                    @if ($is_update_form)
                        @method('PUT')
                    @endif

                    <div class="row justify-content-center">
                        <div class="col-6">
                            <label class="form-label" >Group Name<span class="text-danger">*</span></label>
                            <input class="form-control"
                                placeholder-m="Group Name" name="group_name" value="{{ $group_name }}" type="text" required>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-4">
                        <div class="col-6">
                            <label class="form-label" >Group Description</label>
                            <textarea class="form-control"
                                placeholder-m="Group Description" name="group_description"  type="text" >{{ $group_description }}</textarea>
                              
                        </div>
                    </div>
                    
                    <x-reusables.form-footer route="index-group" action="{{$is_update_form ? 'update' : 'create'}}" module="group"/>
                    
                </form>

            </div>
        </div>
    </div>
@endsection
