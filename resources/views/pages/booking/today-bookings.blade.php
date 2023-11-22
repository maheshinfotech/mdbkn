@php
$pageName = 'bookings';
$tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
$tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];
@endphp

@extends('layouts.backend')

@section('content')

<div class="content px-3 py-0 w-100">
    <div class="container-fluid mt-5">
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
                                <th class="text-center">Room Number</th>
                                <th class="text-center">Room Catogery</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($today_bookings as $booking)
                                <tr>
                                    <td>{{ $booking->guest_name }}</td>
                                    <td>{{ $booking->guest_address }}</td>
                                    <td>{{ $booking->patient_name }}</td>
                                    <td>{{ $booking->check_in_time }}</td>
                                    <td>{{$booking->room->room_number}}</td>
                                    <td>{{$booking->room->category->name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
    </script>
@endsection
