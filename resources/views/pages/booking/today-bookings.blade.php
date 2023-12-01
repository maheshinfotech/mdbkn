@php
$pageName = 'bookings';
$tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
$tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];
@endphp

@extends('layouts.backend')

@section('content')

<div class="content px-3 py-0 w-100">
    <div class="my-3 mx-4">
        <a href="/dashboard" class="btn btn-lg btn-purple "> <i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <div class="container-fluid ">
        <div class="card d-print-none">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h3 class="text-purple fw-bold mb-0">Today's Bookings</h3>
                <div></div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle py-3 text-center" id="booking_table"
                        style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true"
                        data-ordering="false" data-info="false">

                        <thead>
                            <tr>
                                <th class="text-center">Guest Name</th>
                                <th class="text-center">Guest Address</th>
                                <th class="text-center">Patient Name</th>
                                <th class="text-center">Check-in Time</th>
                                <th class="text-center">Room Detalis</th>
                                <th class="text-center">Room Catogery</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($today_bookings as $booking)
                                <tr>
                                    <td>{{ $booking->guest_name }}</td>
                                    <td>{{ $booking->guest_address }}</td>
                                    <td>{{ $booking->patient_name }}</td>
                                    <td>{{ $booking->check_in_time }}</td>
                                    <td class=text-left>{{$booking->room->room_number }}
                                        <span class="badge badge-primary bg-primary ">{{$booking->room->category->name}}</span>
                                        <span class="d-block">{{$booking->base_rent}} /-</span>
                                    </td>
                                    <td>{{$booking->room->category->name}}</td>
                                    <td>{{$booking->mobile_number}}</td>
                                    <td class="text-end">

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
                                            <i class="fa-solid fa-eye"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="advanceModal" tabindex="-1" role="dialog" aria-labelledby="advanceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#booking_table').DataTable({
            lengthChange: false,
            buttons: [{
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'pdf',
                    'excel'
                ]
            }],
            language: {
                searchPlaceholder: "Search"
            }
        });

        table.buttons().container()
            .appendTo(' .col-md-6:eq(0)');
    });

    $('.open-modal').on('click', function(e) {
            e.preventDefault();

            var url = $(this).attr('href');

            $('#advanceModal .modal-content').load(url, function() {
                $('#advanceModal').modal('show');
            });
        });
    </script>
@endsection
