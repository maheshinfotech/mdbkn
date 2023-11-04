@php
    $pageName = 'bookings';
    $tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
    $tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];
@endphp

@extends('layouts.backend')

@section('content')
<x-reusables.app-header pageName="{{ $pageName }}" />
@if (Session::has('message'))
    <div class="alert alert-success w-25 text-center mx-auto" role="alert" id="alert1">
        {{ Session::get('message') }}
    </div>
@endif
<div class="content px-3 py-0 w-100">
    <div class="container-fluid mt-5">
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
    $("#alert1")
        .fadeTo(2000, 2000)
        .slideUp(500, function() {
            $("#alert1").slideUp(500);
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
