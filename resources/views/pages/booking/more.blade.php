
    {{-- <div class="card mx-3 mt-3">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Guest Name</th>
                        <th>Patient Name</th>
                        <th>Check-in Time</th>
                        <th>Room Number</th>
                        <th>Room Category</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookingData as $booking)
                        <tr>
                            <td>{{ $booking->guest_name }}</td>
                            <td>{{ $booking->patient_name }}</td>
                            <td>{{ $booking->check_in_time }}</td>
                            <td>{{ $booking->Room->room_number }}</td>
                            <td>{{ $booking->room->category->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div> --}}
     <div class="content px-3 py-0 w-100 mt-3">
    <div class="container-fluid ">

        <div class="card d-print-none">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle py-3 text-center" id="moredaysstay_table"
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
                            @foreach($bookingData as $booking)
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
    </div>

<script>
      $(document).ready(function() {
        var table = $('#moredaysstay_table').DataTable({
            lengthChange: false,
            "pageLength":100,
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

