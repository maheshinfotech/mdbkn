@php
    $pageName = 'Fuel Consumption';

    $tableHead = ['Full Name' , 'Machine Name' , 'Reading Number' , 'Fuel in Liters' , 'Entry Date' , 'Action' ];

@endphp

@extends('layouts.backend', ['pageName' => $pageName])

@section('content')

    <x-reusables.app-header pageName="{{ $pageName }}" :createButton="true" module="fuel-consumption-reading" modulePlaceholder="Fuel Consumption" />

    <!-- Page Content -->
    <div class="content  mx-0 w-100">
        <!-- Info -->

        <!-- END Info -->

        <div class="block block-rounded">

            <div class="block-content block-content-full">

                <form class="row  g-3 align-items-center mb-3"  >
                
                    <div class="col">
                        <label class="visually-hidden" for="example-if-password">User</label>
                        <select  class="form-control" name="user_id"  >
                            <option disabled selected>Select User</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}" {{$user->id == (request()->user_id ?? 0)? 'selected' : '' }} >
                                    {{ucfirst($user->name)}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="visually-hidden" for="example-if-email">Machinery</label>
                        <select  class="form-control" name="machine_id"  >
                            <option disabled selected>Select Machine</option>
                            @foreach ($machinery as $machine)
                                <option value="{{$machine->id}}" {{$machine->id == (request()->machine_id ?? 0)? 'selected' : '' }} >
                                    {{ucfirst($machine->machine_name)}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="visually-hidden" for="example-if-email">Start Date</label>
                        <input type="date" class="form-control w-100"  name="start_date" value= "{{ $dates['start_date'] ?? ''}}" >
                    </div>
                    <div class="col">
                        <label class="visually-hidden" for="example-if-email">End Date</label>
                        <input type="date" class="form-control w-100"  name="end_date" value= "{{ $dates['end_date'] ?? ''}}">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                        <a class="btn btn-secondary" href="{{route('fuel-consumption-reading-listing')}}">Reset</a>
                    </div>
                </form>
               
            </div>

        </div>

        <!-- Dynamic Table Full -->
        <div class="block block-rounded">

            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                    
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full fs-sm">
                        
                        <x-reusables.table-header :tableHead="$tableHead"/>
                        
                        <tbody>
                            
                                @foreach ($listingData as $data)
                                    
                                    <tr>

                                        <td class="whitespace-nowrap ">
                                            {{ $data->user->name ?? ''}}
                                        </td>

                                        <td class="whitespace-nowrap ">
                                            {{ $data->machinery->machine_name ?? '' }}
                                        </td>

                                        <td class="whitespace-nowrap ">
                                            {{ $data->reading_number }}
                                        </td>

                                        <td class="whitespace-nowrap ">
                                            {{ $data->fuel_in_liters }}
                                        </td>

                                        <td class="whitespace-nowrap ">
                                            {{ $data->created_date_time }}
                                        </td>

                                        <td class="whitespace-nowrap">
                                            <x-reusables.action-buttons :id="encrypt($data->id)" module="fuel-consumption-reading"
                                                :name="$data->reading_number" />
                                        </td>

                                    </tr>
                                    
                                @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
