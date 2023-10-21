@php
    $pageName = "Fuel Consumption";
@endphp
@extends('layouts.backend' , ['pageName' => "{{$pageName}}" , 'parentRoute' => "fuel-consumption-reading"])

@section('content')

    <x-reusables.app-header pageName="{{$pageName}}" :createButton="false" module="machinery"  />
    
    <div class="content  mx-0 w-100">
        
        <div class="block block-rounded">

            <div class="block-content block-content-full">

                <form class="row g-3 align-items-center" action="{{route('mass-insert-fuel-reading')}}" enctype="multipart/form-data" method = "POST">
                    @csrf

                    <div class = "col-6">
                        <label class="form-label" for="">Choose Machine<span class="text-danger">*</span></label>
                        <select  class="form-control" name="machine_id" required >
                            @foreach ($machinery as $machine)
                                <option value="{{$machine->id}}" {{$machine->id == (request()->machine_id ?? 0)? 'selected' : '' }} >
                                    {{ucfirst($machine->machine_name)}}
                                </option>
                            @endforeach
                        </select>
                    
                    </div>

                    <div class = "col-6">
                        <label class="form-label" for="">Upload File<span class="text-danger">*</span></label>
                        <input type="file" class="form-control"  name="excel_data" accept=".xlsx, .xls" placeholder="Attach Excel File" required >
                        
                    </div>
                    <div class = "col-12 text-center gap-2 mt-3">
                        <button type="submit" class="btn btn-primary" >Mass Insert</button>
                        <button type="reset" class="btn btn-secondary" >Reset File</button>
                        <a href="{{asset('excel_data/fuel-consumption-reading.xlsx')}}" class="btn btn-secondary"><i class="fa-solid fa-download"></i> Sample Download</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection