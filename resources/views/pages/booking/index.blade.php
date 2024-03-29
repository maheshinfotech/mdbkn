@php
    $pageName = 'dashboard';
    $tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
    $tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];

    $cardData = [
        ['color' => 'tan', 'duration' => '< 3 days stay','counting'=>$counting['lsthreeday']],
        ['color' => '#a7c2cc', 'duration' => '3 days to 7 days stay','counting'=>$counting['threetosevenday']],
        ['color' => 'rgba(134, 137, 169, 0.9)', 'duration' => '7 days to 15 days stay','counting'=>$counting['seventofiftday']],
        ['color' => '#7bb8cf', 'duration' => '16 days to 1 month stay','counting'=>$counting['fifttoonemonth']],
        ['color' => 'rgb(162, 207, 123)', 'duration' => '> 1 month stay','counting'=>$counting['mtonemonth']],

    ];
@endphp

@extends('layouts.backend')

@section('content')
<x-reusables.app-header pageName="{{ $pageName }}" />
@if (Session::has('message'))
    <div class="alert alert-success w-25 text-center mx-auto" role="alert" id="alert1">
        {{ Session::get('message') }}
    </div>
@endif
<div class="d-flex flex-wrap mx-4 mt-3 justify-content-between align-items-center">
    <div class="">
        <a href="/dashboard" class="btn btn-lg btn-purple "> <i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <div class="">
        <h1 class="text-purple text-center mb-0"> Current Bookings ({{count($cardData['counting'])}})</h1>
    </div>
    <div></div>
</div>
{{-- <div class="content px-3 py-0 w-100">
    <div class="container-fluid ">
        <div class="d-flex my-3 justify-content-between align-items-center">
            <div class="">
                <a href="/dashboard" class="btn btn-lg btn-purple "> <i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <div class="card d-print-none">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h3 class="text-purple fw-bold mb-0">Current Bookings</h3>
                <div></div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle py-3 text-center" id="booking_table"
                        style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true"
                        data-ordering="false" data-info="false">
                        <thead>
                            <tr>
                                <th class="text-start">S.No</th>
                                <th class="text-center">Guest Name</th>
                                <th class="text-center">Room Number</th>
                                <th class="text-center">Patient Name</th>
                                <th class="text-center">Check-in DateTime</th>
                                <th class="text-center">Guest Address</th>
                                <th class="text-center">Mobile Number</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @php
                            $counter = 1;
                            @endphp
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $counter }}</td>
                                <td>{{ $booking->guest_name }}</td>
                                <td>{{ $booking->room->room_number }}</td>
                                <td>{{ $booking->patient_name }}</td>
                                <td>{{ date('d-M-y h:i A', strtotime($booking->getRawOriginal('check_in_time'))) }}</td>
                                <td>{{ $booking->guest_address }}</td>
                                <td>{{ $booking->mobile_number }}</td>
                                <td>
                                    @if ($booking->getRawOriginal('check_out_time') == null)
                                    <a href="{{ route('advance.create', ['booking_id' => $booking->id]) }}"
                                        class="btn btn-sm btn-purple open-modal" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" data-bs-title="Advance">
                                        <i class="fa-solid fa-plus"></i>
                                    </a>
                                    <a href="/bookings/edit/{{ $booking->id }}"
                                        class="btn btn-sm btn-purple" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" data-bs-title="Edit"> <i
                                            class="fa-solid fa-pen"></i></a>
                                        <a href="/bookings/checkout/{{ $booking->id }}"
                                            class="btn btn-sm btn-purple" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" data-bs-title="Checkout"> <i
                                                class="fa-solid fa-sign-out"></i></a>
                                    @endif
                                    <a href="/bookings/{{ $booking->id }}" class="btn btn-sm btn-purple"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @php
                            $counter++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row mx-3 mt-3">

        @foreach($cardData as $data)
            <div class="col-xl-4 mt-3">
                <a href="" class="card hoverable card-xl-stretch"
                style="background-color: {{ $data['color'] }}"
                >
                    <div class="card-body text-capitalize">
                        <div class="text-white fw-bolder fs-2 mb-2">+{{count($data['counting'])}}</div>
                        <div class="fw-bold text-white fs-5 duration">
                            {{ $data['duration'] }}
                        </div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>

        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <div id="project-details-container">
        <script>
            $(document).ready(function () {
                $(".card").on("click", function (e) {
                    e.preventDefault();

                    var duration = $(this).find(".duration").text();
                    console.log(duration)

                    $.ajax({
                        url: '/booking/more',
                        method: "GET",
                        data: { duration: duration },
                        success: function (data) {
                            $("#project-details-container").html(data);
                        }
                    });
                });
            });
        </script>
    </div>
@endsection
