@extends('layouts.backend')

@section('content')
    {{-- <x-reusables.app-header pageName="{{ $pageName }}" /> --}}



    <div class="container-fluid ">
<div class="row">
    <div class="col-md-6">
        <div class="card d-print-none">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle py-3 text-center" id="moredaysstay_table"
                        style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true"
                        data-ordering="false" data-info="false">
                        <thead>
                            <tr>
                                <th class="text-center">Guest Name</th>
                                <th class="text-center">Room Number</th>
                                {{-- <th class="text-center">Patient Name</th>
                                <th class="text-center">Check-in DateTime</th>
                                <th class="text-center">Guest Address</th>
                                <th class="text-center">Mobile Number</th> --}}
                                <th class="text-center">is_booked</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @foreach($running_booking_count as $booking)
                            {{-- @dd($booking->room->room_number) --}}
                            <tr>
                                <td>{{ $booking->guest_name }}</td>
                                <td>{{ $booking->room_number }}</td>
                                {{-- <td>{{ $booking->patient_name }}</td>
                                <td>{{ date('d-M-y h:i A', strtotime($booking->getRawOriginal('check_in_time'))) }}</td>
                                <td>{{ $booking->guest_address }}</td>
                                <td>{{ $booking->mobile_number }}</td> --}}


                                <td>{{ $booking->is_booked==1?'yes':'no'}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card d-print-none">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle py-3 text-center" id="moredaysstay_table"
                        style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true"
                        data-ordering="false" data-info="false">
                        <thead>
                            <tr>

                                <th class="text-center">Room Number</th>
                                <th class="text-center">is_booked</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @foreach($all_room as $room)
                            <tr>

                                <td>{{ $room->room_number }}</td>
                                <td>{{ $room->is_booked==1?'yes':'no'}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>

@endsection
