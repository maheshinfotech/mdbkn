@php
    $pageName = 'bookings';
    $tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
    $tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];
@endphp

@extends('layouts.backend')

@section('content')
    {{-- <a href="booking/index">Go to Booking List</a>
<table class="table"> --}}
    <x-reusables.app-header pageName="{{ $pageName }}" />
    @if (Session::has('message'))
        <div class="alert alert-success w-25 text-center mx-auto" role="alert" id="alert1">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="content px-3 py-0 w-100">
        <!-- container starts -->
        <div class="container-fluid mt-5">
            <!-- card starts -->
            <div class="card d-print-none">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h3 class="text-purple fw-bold mb-0">Booking Records</h3>



                    <div class="d-flex justify-content-right">
                        <div class="mb-3 me-3">
                            <label for="filterDate" class="form-label">Filter by Date:</label>
                            <input type="date" name="filterDate" id="filterDate" class="form-control">

                        </div>
                        <div class="mb-3 me-3">
                            <label for="filterType" class="form-label filtertype">Filter by Type:</label>
                            <select name="filterType" id="filterType" class="form-select filterTypeClass">
                                <!-- Add your class name here -->
                                <option value="" selected> select--</option>
                                <option value="0">Check In</option>
                                <option value="1">Check Out</option>
                            </select>
                        </div>
                        <div class="mt-3 mt-4">
                            <a href="/bookings/create" type="button" class="btn btn-purple">
                                Add Bookings +
                            </a>
                        </div>
                    </div>
                </div>
                <!--card body starts -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle py-3 text-center" id="booking_table"
                            style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true"
                            data-ordering="false" data-info="true">
                            <thead class="align-middle">
                                <tr>
                                    <th class="text-start">Guest Name</th>
                                    <th class="text-center">Patient Name</th>
                                    <th class ="text-center">Room Details </th>
                                    <th class="text-center">Check-In Time</th>
                                    <th class="text-center">Check-Out Time</th>
                                    <th class="text-center">Doctor Name</th>
                                    <th class="text-center">Mobile No.</th>
                                    <th class="text-center">Total Paid Amt</th>

                                    {{-- <th class ="text-center">Normal Rent <br>Patient Rent</th> --}}
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-capitalize">
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td class="text-start">{{ $booking->guest_name }}</td>
                                        <td>{{ $booking->patient_name }}</td>
                                        <td>{{ $booking->room->room_number }}
                                            <span
                                                class="badge badge-primary bg-primary ">{{ $booking->room->category->name }}</span>
                                            <span class="d-block">{{ $booking->base_rent }} /-</span>
                                        </td>
                                        <td>{{ date('d-M-y h:i A', strtotime($booking->getRawOriginal('check_in_time'))) }}
                                        </td>

                                        <td>
                                            @if ($booking->getRawOriginal('check_out_time'))
                                                {{ date('d-M-y h:i A', strtotime($booking->getRawOriginal('check_out_time'))) }}
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>{{ $booking->docter_name }}</td>
                                        <td>{{ $booking->mobile_number }}</td>
                                        <td>
                                            {{-- {{ $booking->paid_rent + $booking->advance_payment }} --}}
                                            @if ($booking->advance)
                                                @php
                                                    $Amt = 0;
                                                    $totalAmt = 0;
                                                    foreach ($booking->advance as $adv) {
                                                        $Amt += $adv->amount;
                                                    }
                                                    if ($booking->advance_refund > 0) {
                                                        $totalAmt = $Amt - $booking->advance_refund;
                                                    } else {
                                                        $totalAmt = $Amt + $booking->paid_rent;
                                                    }
                                                @endphp
                                                {{ $totalAmt }}
                                            @endif
                                        </td>


                                        <td class="text-end">

                                            @if ($booking->getRawOriginal('check_out_time') == null)
                                                <a href="{{ route('advance.create', ['booking_id' => $booking->id]) }}"
                                                    class="btn btn-sm btn-purple open-modal" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" data-bs-title="Advance">
                                                    <i class="fa-solid fa-plus"></i>
                                                </a>
                                                <a href="/bookings/edit/{{ $booking->id }}" class="btn btn-sm btn-purple"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-title="Edit"> <i class="fa-solid fa-pen"></i></a>
                                                <a href="/bookings/checkout/{{ $booking->id }}"
                                                    class="btn btn-sm btn-purple" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" data-bs-title="Checkout"> <i
                                                        class="fa-solid fa-sign-out"></i></a>


                                                <a href="/bookings/{{ $booking->id }}" class="btn btn-sm btn-purple"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-title="View">
                                                    <i class="fa-solid fa-eye"></i> </a>
                                            @else
                                                <a href="/bookings/{{ $booking->id }}" class="btn btn-sm btn-purple"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-title="View">
                                                    <i class="fa-solid fa-eye"></i> </a>
                                                <a href="{{ route('billing.show', ['booking_id' => $booking->id]) }}"
                                                    class="btn btn-sm btn-purple btn-billing" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" data-bs-title="Billing">
                                                    <i class="fa-solid fa-file-invoice"></i>
                                                </a>
                                            @endif

                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--card body ends -->
            </div>

        </div>
        <!-- container ends -->
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
                "pageLength": 100,
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


        //   message div animation

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


        $(document).ready(function() {
            // Handle click on "Billing" button
            $('.btn-billing').on('click', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');

                // Make an AJAX request to get the billing show page content
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        // Insert the content into the modal
                        $('#advanceModal .modal-content').html(response);

                        // Show the modal
                        $('#advanceModal').modal('show');
                    },
                    error: function(error) {
                        console.error('Error loading billing show page:', error);
                    }
                });
            });
        });
    </script>
@endsection
