@php

    $pageName = 'Monthly Reports';

    $tableHead = [ 'Month' , 'Total Days' , 'Working Hours' , 'Fuel Consumed' , 'Consumption Rate' ];

@endphp

@extends('layouts.backend', ['pageName' => $pageName])

@section('content')

    <x-reusables.app-header pageName="{{ $pageName }}"  module="monthly_report" />

    <!-- Page Content -->
    <div class="content  mx-0 w-100">

        {{-- Date Filters --}}
        
        <div class="block block-rounded">

            <div class="block-content block-content-full">
                
                <form class="row  g-3 align-items-center" >

                    <div class="col">
                        
                        <label class="visually-hidden" for="example-if-password">Machines</label>
                        
                        <select name="machine_id" class="form-control" id="">
                            @foreach ($machines as $each)
                                <option  value="{{$each->id}}" {{decrypt($each->id) == $autofill->selected_machine ? 'selected' : ''}}>
                                    {{ucfirst($each->machine_name ?? '')}}
                                </option>
                            @endforeach
                        </select>
                        
                    </div>
                    
                    <div class="col">
                        
                        <label class="visually-hidden" for="example-if-password">Year</label>
                        <input type="number" class="form-control" name="year" min="1999" max="{{date('Y')}}" value = "<?=$autofill->year?>"/>

                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                        <a class="btn btn-secondary" href="{{route('monthly-report')}}">Reset</a>
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

                            @php
                                $fuel_consumption = $machine->fuelConsumption()
                                                    ->selectRaw('date_format(created_at , "%b %Y") as month_selected , date_format(created_at , "%Y-%m") as raw_month , SUM(fuel_in_liters) as total_fuel_comsumption , COUNT(*) as count_days')
                                                    ->whereYear('created_at' , $autofill->year )
                                                    ->groupByRaw("date_format(created_at , '%Y-%m')")->get();

                            @endphp

                            @foreach ($fuel_consumption as $consumption)
                                
                                <tr>

                                    <td class="whitespace-nowrap ">
                                        
                                        {{$consumption->month_selected}}
                                    </td>

                                    <td class="whitespace-nowrap ">
                                        {{$consumption->count_days ?? 0}}
                                    </td>

                                    <td class="whitespace-nowrap ">
                                        @php
                                        
                                            $working_hours =    $machine->workingHours()->app()
                                                                ->selectRaw('SUM(opening_hours) as openings , SUM(closing_hours) as closings')
                                                                ->whereRaw( "date_format(created_at , '%Y-%m') = '$consumption->raw_month'")
                                                                ->groupByRaw("date_format(created_at , '%Y-%m')")->first();
                                        
                                            $spent_hours = ($working_hours->closings ?? 0)  - ($working_hours->openings ?? 0) ; 

                                        @endphp
                                        {{$spent_hours}}
                                    </td>

                                    <td class="whitespace-nowrap ">
                                        {{$consumption->total_fuel_comsumption}}
                                    </td>

                                    <td class="whitespace-nowrap ">
                                        {{ bcdiv($consumption->total_fuel_comsumption / ($spent_hours ? : 1 ) , 1 , 2) }}
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

