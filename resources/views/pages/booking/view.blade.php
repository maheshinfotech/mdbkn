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
        <div class="container-fluid my-5">
            <!-- card starts -->
            <div class="card card-flush border border-0 mb-3">
                <div class="card-header d-flex justify-content-center align-items-center border border-0" style="background-color: aliceblue ">
                    <h3 class="text-purple fw-bold mb-0"></h3>
                    <div class="d-flex justify-content-right align-items-center">
                        <div class="">
                            <ul class="nav nav-pills" id="booking-tbl" role="tablist">
                                <li class="nav-item " role="presentation">
                                  <button class=" nav-link active" data-bs-toggle="pill" data-bs-target="#booking_records" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Booking Records</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class=" nav-link"  data-bs-toggle="pill" data-bs-target="#canteen_records" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Canteen Records</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class=" nav-link"  data-bs-toggle="pill" data-bs-target="#parking_records" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Parkings</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- card end -->
            <div class="tab-content" id="booking-tblContent">
                <div class="tab-pane fade show active" id="booking_records" role="tabpanel" tabindex="0">
                     <!-- card starts -->
                    <div class="card d-print-none">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h3 class="text-purple fw-bold mb-0">Booking Records</h3>

                            <div class="d-flex justify-content-right align-items-center">
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
                                <div class="mt-3">
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
                                            <th class="text-start">Guest Name </th>
                                            <th class="text-center">Patient Name</th>
                                            <th class ="text-center">Room Details </th>
                                            <th class="text-center">Check-In Time</th>
                                            <th class="text-center">Check-Out Time</th>
                                            <th class="text-center">Doctor Name</th>
                                            <th class="text-center">Mobile No.</th>
                                            <th class="text-center">Total Paid Amt</th>
                                            <th class="text-center">Created At</th>
                                            <th class="text-center">Updated At</th>
                                            <th class="text-center">Slip_NO</th>

                                            {{-- <th class ="text-center">Normal Rent <br>Patient Rent</th> --}}
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-capitalize">
                                        {{-- @dd($bookings) --}}
                                        @foreach ($bookings as $booking)
                                            <tr id="filterDate">
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

                                                    @if ($booking->advance)
                                                        @php
                                                            $Amt = 0;
                                                            $totalAmt = 0;
                                                            foreach ($booking->advance as $adv) {
                                                                $Amt += is_numeric($adv->amount);
                                                            }
                                                            if ($booking->advance_refund > 0) {
                                                                $totalAmt = $Amt - is_numeric($booking->advance_refund);
                                                            } else {
                                                                $totalAmt = $Amt + is_numeric($booking->paid_rent);
                                                            }
                                                        @endphp
                                                        {{ $totalAmt }}
                                                    @endif
                                                </td>
                                                <td>{{ date('d-M-y h:i A', strtotime($booking->created_at)) }}</td>
                                                <td>{{ date('d-M-y h:i A', strtotime($booking->updated_at)) }}</td>
                                                <td>{{ $booking->slip_no }}</td>


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
                    <!-- card end -->
                </div>
                <div class="tab-pane fade" id="canteen_records" role="tabpanel" tabindex="0">
                     <!-- card starts -->
                    <div class="card">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h3 class="text-purple fw-bold mb-0">Canteen Records</h3>
                        </div>
                        <!--card body starts -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped align-middle py-3 text-center" id="canteen_table" style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true" data-ordering="false" data-info="true">
                                    <thead class="align-middle">
                                        <tr>
                                            <th class="text-start">Name </th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Rooms </th>
                                            <th class="text-center">Start Date</th>
                                            <th class="text-center">End Date</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">SlipNO</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-capitalize">
                                        @php
                                            $totalAmount = 0;
                                        @endphp
                                        @foreach ($canteens as $canteen)
                                            @php
                                                $totalAmount += $canteen->amount;
                                            @endphp
                                            <tr>
                                                <td>{{ $canteen->name }}</td>
                                                <td>{{ $canteen->room->category->name }}</td>
                                                <td>{{ $canteen->room->room_number }}</td>
                                                <td>{{ \Illuminate\Support\Carbon::parse($canteen->startdate)->format('d-M-y') }}</td>
                                                <td>{{ \Illuminate\Support\Carbon::parse($canteen->enddate)->format('d-M-y') }}</td>
                                                <td>{{ $canteen->amount }}</td>
                                                <td>{{$canteen->slipno}}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-purple edit-canteen" data-id="{{ $canteen->id }}" data-bs-toggle="modal" data-bs-target="#editCanteenModal">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" style="text-align: right;">Total:</td>
                                            <td>{{ $totalAmount }}</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                        <!--card body ends -->
                    </div>
                    <!-- card end -->
                </div>
                <div class="tab-pane fade" id="parking_records" role="tabpanel" tabindex="0">
                    <!-- card starts -->
                   <div class="card">
                       <div class="card-header bg-light d-flex justify-content-between align-items-center">
                           <h3 class="text-purple fw-bold mb-0">Parking Records</h3>
                           <div class="d-flex justify-content-right align-items-center">
                                <div class="mt-3">
                                    <a href="" type="button" class="btn btn-purple" data-bs-toggle="modal" data-bs-target="#addparking">
                                        Add Parkings +
                                    </a>
                                </div>
                            </div>
                       </div>
                       <!--card body starts -->
                       <div class="card-body">
                           <div class="table-responsive">
                            <table class="table table-striped align-middle py-3 text-center" id="parking_table" style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true" data-ordering="false" data-info="true">
                                <thead class="align-middle">
                                    <tr>
                                        <th class="text-start">Date </th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-capitalize">
                                    <?php $totalAmount = 0; ?>
                                    @foreach($parkings as $parking)
                                    <tr>
                                        <td class="text-start">
                                            @if($parking->date)
                                            {{ $parking->date}}
                                            @else
                                            Not set
                                            @endif
                                        </td>
                                        <td class="text-center">{{ number_format($parking->amount, 2) }}</td>
                                        <?php $totalAmount += $parking->amount; ?>
                                        <td class="text-end">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-purple " data-bs-toggle="modal" data-bs-target="#addparking" data-id="{{ $parking->id }}">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="text-start"></td>
                                        <td class="text-center"><strong>Total Amount:</strong> {{ number_format($totalAmount, 2) }}</td>
                                        <td class="text-end"></td>
                                    </tr>
                                </tbody>
                            </table>


                           </div>
                       </div>
                       <!--card body ends -->
                   </div>
                   <!-- card end -->
               </div>
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
{{-- html model code --}}
<div class="modal fade" id="editCanteenModal" tabindex="-1" role="dialog" aria-labelledby="editCanteenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCanteenModalLabel">Edit Canteen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editCanteenForm" action="" >

                <div class="modal-body">
                    <input type="hidden" name="canteen_id" id="editCanteenId">
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" id="editName" name="name">
                    </div>
                    <div class="col-lg-4 col-12 mb-4">
                        <label class=" fs-7 fw-bold mb-1 ">Choose Category<span class="text-danger">*</span></label>
                        <select id="categoryes" class="form-select" name="category"
                            onchange="select_canteencategory()" >
                            <option value="" disabled selected>Category...</option>
                            @foreach ($category as $cat)
                                <option value="{{ $cat->id }}" {{old('category','')==$cat->id ? 'selected' : ''}}>{{ $cat->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-lg-4 col-12 mb-4">
                        <label class=" fs-7 fw-bold mb-1 ">Choose Room<span class="text-danger">*</span></label>
                        <select id="rooms" class="form-select rooms" name="room_id" >
                            <option value="" disabled selected>Rooms...</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editStartDate">Start Date</label>
                        <input type="date" class="form-control" id="editStartDate" name="startdate">
                    </div>
                    <div class="form-group">
                        <label for="editEndDate">End Date</label>
                        <input type="date" class="form-control" id="editEndDate" name="enddate">
                    </div>
                    <div class="form-group">
                        <label for="editAmount">Amount</label>
                        <input type="text" class="form-control" id="editAmount" name="amount">
                    </div>
                    <div class="form-group">
                        <label for="editAmount">SlipNO</label>
                        <input type="text" class="form-control" id="slipno" name="slipno">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- add parking modal --}}
<div class="modal fade" id="addparking" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3 class="text-purple text-center mb-4 mt-0" id="adparking">Add Parkings</h3>
                <form action="{{ route('parkings.store') }}" method="post">
                    @csrf
                    <input type="hidden" method="get" id="parkingedit">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="fw-bold mb-1">Date:</label>
                            <input type="date" class="form-control" name="date" id="date" required />
                        </div>
                        <div class="col-12 mb-3">
                            <label class="fw-bold mb-1">Amount:</label>
                            <input type="number" class="form-control" name="amount" id="amount" required />
                        </div>
                    </div>
                    <div class="mt-3 mb-5 text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-purple">Save</button>
                    </div>
                </form>


        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       var bookingTable;
        function initializeDataTable() {
            bookingTable = $('#booking_table').DataTable({
                lengthChange: false,
                searching: true,
                pageLength: 100,
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
            bookingTable.buttons().container().appendTo('.col-md-6:eq(0)');
        }

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

        function updateBookings() {
            var selectedDate = $('#filterDate').val();
            var selectedType = $('.filterTypeClass').val();
            $.ajax({
                url: '{{ route("datebooking.filter") }}',
                type: 'GET',
                data: {
                    filterDate: selectedDate,
                    filterType: selectedType
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    if (bookingTable) {
                        bookingTable.destroy();
                    }

                    var table = $('#booking_table');
                    table.find('tbody').empty();

                    var totalPayableRent = 0;

                    $.each(res.bookings, function(index, booking) {
                        var createdDate = new Date(booking.created_at);
                        var updatedDate = new Date(booking.updated_at);
                        var createdFormattedDateTime = createdDate.toLocaleString('en-IN', { day: 'numeric', month: 'short', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true });
                        var updatedFormattedDateTime = updatedDate.toLocaleString('en-IN', { day: 'numeric', month: 'short', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true });
                        if (booking.payable_rent !== null) {
                            totalPayableRent += parseFloat(booking.payable_rent);
                        }
                        var row = '<tr>' +
                            '<td>' + booking.guest_name + '</td>' +
                            '<td>' + booking.patient_name + '</td>' +
                            '<td>' +
                                booking.room.room_number +
                                '<span class="badge badge-primary bg-primary">' + booking.room.category.name + '</span>' +
                                '<span class="d-block">' + booking.base_rent + ' /-</span>' +
                            '</td>' +
                            '<td>' + booking.check_in_times + '</td>' +
                            '<td>' + booking.check_out_times + '</td>' +
                            '<td>' + booking.docter_name + '</td>' +
                            '<td>' + booking.mobile_number + '</td>' +
                            '<td>' + (booking.payable_rent !== null ? booking.payable_rent : 'N/A') + '</td>' +
                            '<td>' + createdFormattedDateTime + '</td>' +
                            '<td>' + updatedFormattedDateTime + '</td>' +
                            '<td>' + booking.slip_no + '</td>' +
                            '<td class="text-end ">';

                        if (booking.check_out_time !== null && booking.check_out_time !== '--') {
                            row += '<a href="{{ url("/bookings/") }}/' + booking.id + '" class="btn btn-sm btn-purple" data-bs-toggle="tooltip me-2" data-bs-placement="bottom" data-bs-title="Ajax View" ><i class="fa-solid fa-eye"></i></a>';
                        } else {
                            row += '<a href="{{ url("/bookings/edit/") }}/' + booking.id + '" class="btn btn-sm btn-purple me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Edit"><i class="fa-solid fa-pen"></i></a>' +
                                '<a href="{{ url("/bookings/checkout/") }}/' + booking.id + '" class="btn btn-sm btn-purple me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Checkout"><i class="fa-solid fa-sign-out"></i></a>' +
                                '<a href="{{ url("/bookings/") }}/' + booking.id + '" class="btn btn-sm btn-purple me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View"><i class="fa-solid fa-eye"></i></a>';
                        }

                        row += `</td>
                        </tr>`;
                        table.find('tbody').append(row);


                    });
                    row=`
                    <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total Amount:</td>
                            <td>${totalPayableRent.toFixed(2)}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>`;

                            table.find('tbody').append(row);

                // console.log('Total Payable Rent:', totalPayableRent.toFixed(2));

                    initializeDataTable();
                },
                error: function(error) {
                    console.error('Error loading bookings:', error);
                }
            });
        }

        $(document).ready(function() {
            initializeDataTable();
            $('#filterDate, .filterTypeClass').change(function() {
                updateBookings();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
                var canteenTable;
                canteenTable = $('#parking_table').DataTable({
                    lengthChange: false,
                    searching: true,
                    pageLength: 100,
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
                // canteenTable.buttons().container().appendTo('.col-md-6:eq(0)');
             });
    </script>

    <script>
         $(document).ready(function() {
            var canteenTable;
            canteenTable = $('#canteen_table').DataTable({
                lengthChange: false,
                searching: true,
                pageLength: 100,
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
            // canteenTable.buttons().container().appendTo('.col-md-6:eq(0)');
         });
         function select_canteencategory() {
            var id = $('#categoryes').val();

            $.ajax({
                url: '/bookings/create',
                data: {
                    id: id
                },
                type: 'get',
                success: function(response) {
                    var html = `<option value="" selected>Rooms...</option>`;
                    console.log(response);
                    $('.rooms').html('');

                    for (let i = 0; i < response.length; i++) {
                        html += `<option value="${response[i].id}"> ${response[i].room_number}</option>`;
                    }
                    $('.rooms').html(html);

                }
            });
        }



        $('.edit-canteen').click(function(e) {
    e.preventDefault();

    var canteenId = $(this).data('id');
    $.ajax({
        url: '/canteens/' + canteenId,
        type: 'GET',
        success: function(response) {
            // Populate canteen fields
            $('#editCanteenId').val(response.id);
            $('#editName').val(response.name);
            $('#slipno').val(response.slipno);
            $('#categoryes').val(response.room.category_id);
            $('#editStartDate').val(response.startdate);
            $('#editEndDate').val(response.enddate);
            $('#editAmount').val(response.amount);

            $('#rooms').empty();

            if (Array.isArray(response.room)) {
                response.room.forEach(function(room) {
                    $('#rooms').append($('<option>', {
                        value: room.id,
                        text: room.room_number
                    }));
                });
            } else {
                $('#rooms').append($('<option>', {
                    value: response.room.id,
                    text: response.room.room_number
                }));
            }

            $('#rooms').val(response.room.id);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});


$('#editCanteenForm').submit(function(e) {
    e.preventDefault();

    var formData = $(this).serialize();
    var canteenId = $('#editCanteenId').val();

    $.ajax({
        url: '/canteens/' + canteenId,
        type: 'PUT',
        data: formData,
        success: function(response) {
            $('#editCanteenModal').modal('hide');
            alert(response.message);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});



    </script>

<script>
    $(document).ready(function() {
        $('.edit-parking').click(function() {
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                url: '/parkings/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#date').val(data.date);
                    $('#amount').val(data.amount);
                    $("#adparking").val('Edit Parking')
                    $('#parkingedit').attr('action', '/parkings/' + id);
                    $('#addparking').modal('show');
                },
                error: function(error) {
                    console.log(error);
                    alert('Could not fetch the data');
                }
            });
        });
    });
    </script>

@endsection
