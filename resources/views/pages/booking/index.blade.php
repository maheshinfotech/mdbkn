@php
    $pageName = 'dashboard';
    $tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
    $tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];

    $cardData = [
        ['color' => 'tan', 'duration' => '>3 days stay'],
        ['color' => '#a7c2cc', 'duration' => '>5 days stay'],
        ['color' => 'rgba(134, 137, 169, 0.9)', 'duration' => '>7 days stay'],
        ['color' => '#7bb8cf', 'duration' => '>15 days stay'],
        ['color' => 'rgb(162, 207, 123)', 'duration' => '>1 month stay'],
        ['color' => 'rgb(207, 123, 192)', 'duration' => '>2 month stay'],
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
            <div class="col-xl-4 mt-2">
                <a href="" class="card hoverable card-xl-stretch" style="background-color: {{ $data['color'] }}">
                    <div class="card-body">
                        <span class="svg-icon text-white svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor" />
                                <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor" />
                                <rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor" />
                                <rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor" />
                            </svg>
                        </span>
                        <div class="text-white fw-bolder fs-2 mb-2 mt-4">+</div>
                        <div class="fw-bold text-white duration">{{ $data['duration'] }}</div>
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
