@php

    $pageName = 'Fuel Summary';

    $tableHead = [ 'Date' , ...$group->machinery->pluck('machine_name') , 'Total Consumption'];

@endphp

@extends('layouts.backend', ['pageName' => $pageName])

@section('content')

    <x-reusables.app-header pageName="{{ $pageName }}" :createButton="false" module="machine-fuel-summary" />

    <!-- Page Content -->
    <div class="content  mx-0 w-100">
        <!-- Info -->

        <!-- END Info -->

        <div class="block block-rounded">

            <div class="block-content block-content-full">
                
                <form class="row  g-3 align-items-center" >
                    <div class="col">
                        <label class="visually-hidden" for="example-if-password">Groups</label>
                        <select  class="form-control" name="group_id"  >
                            
                            @foreach ($groups as $each)
                                <option 
                                    {{ $dates['filtered_group']  == decrypt($each->id) ? "selected" : '' }} 
                                    value="{{$each->id}}">
                                    {{ucfirst($each->group_name)}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <label class="visually-hidden" for="example-if-password">Start Date</label>
                        <input type="date" class="form-control" value= "{{ $dates['start_date'] ?? ''}}" name="start_date" />
                    </div>

                    <div class="col">
                        <label class="visually-hidden" for="example-if-password">End Date</label>
                        <input type="date" class="form-control" value= "{{ $dates['end_date'] ?? ''}}" name="end_date" />
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                        <a class="btn btn-secondary" href="{{route('machine-fuel-summary')}}">Reset</a>
                    </div>
                </form>

            </div>

        </div>

        <!-- Dynamic Table Full -->
        <div class="block block-rounded">

            <div class="block-content block-content-full">
                <div class="table-responsive">
                    
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full fs-sm">
                        
                        <x-reusables.table-header :tableHead="$tableHead"/>
                        
                        <tbody>

                            @foreach ($listingData as $data)
                                @php
                                    $total_consumption = 0 ;   
                                @endphp
                                
                                <tr>

                                    <td class="whitespace-nowrap ">

                                        {{ $data->created_at }}

                                    </td>
                                    
                                    @forelse ( $group->machinery as $machine)
                                        @php
                                            $fuel_in_liters = $machine->fuelConsumption()
                                                                ->whereDate( 'created_at' , date('Y-m-d', strtotime($data->raw_format)) )
                                                                ->sum('fuel_in_liters');

                                            $total_consumption += $fuel_in_liters;
                                        @endphp

                                        <td>{{$fuel_in_liters}}</td>

                                    @empty

                                        <td colspan="{{$group->machinery->count()}}">Nothing to Show</td>

                                    @endforelse

                                    <td>
                                        {{$total_consumption}}
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
