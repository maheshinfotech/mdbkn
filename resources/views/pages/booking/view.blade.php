@php
    $pageName = 'booking';
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
           <!-- container starts -->
    <div class="container-fluid mt-5">
        <!-- card starts -->
        <div class="card">
          <div class="card-header bg-light d-flex justify-content-between align-items-center">
              <h3 class="text-purple fw-bold mb-0">Booking Records</h3>
              <div>
                  <a href="/bookings/create" type="button" class="btn btn-purple">
                      Add Bookings +
                  </a>
              </div>
            </div>
          <!--card body starts -->
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-striped align-middle py-3 text-center" id="booking_table" style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true" data-ordering="false" data-info="false">
                      <thead>
                          <tr>
                              <th class="text-start">Guest Name</th>
                              <th class="text-center">Patient Name</th>
                              <th class="text-center">In/Out Time</th>
                              <th class="text-center">Doctor Name</th>
                              <th class="text-center">Mobile No.</th>
                              <th class="text-center">Paid Rent</th>
                              <th class="text-end">Action</th>
                          </tr>
                      </thead>
                      <tbody class="text-capitalize">
                        @foreach ($bookings as $booking)

                          <tr>
                              <td class="text-start">{{$booking->guest_name}}</td>
                              <td>{{ $booking->patient_name }}</td>
                              <td>{{ $booking->check_in_time }}/{{ $booking->check_out_time }}</td>
                              <td>{{ $booking->docter_name }}</td>
                              <td>{{ $booking->mobile_number }}</td>
                              <td>{{ $booking->payable_rent }}</td>

                              <td class="text-end">
                                @if ($booking->getRawOriginal('check_out_time')==null)
                                <a href="/bookings/checkout/{{ $booking->id }}" class="btn btn-sm btn-purple">Checkout</a>
                                @endif
                                  <a href="/bookings/{{ $booking->id }}" class="btn btn-sm btn-purple">View </a>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
          <!--card body ends -->
        </div>
        <!-- card ends -->
      </div>
       <!-- container ends -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Bootstrap JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- DataTables RowReorder JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
        integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>

    <script>
        $(document).ready(function() {
        var table = $('#booking_table').DataTable( {
            lengthChange: false,
            buttons: [
                {
                    extend: 'collection',
                    text: 'Export',
                    buttons: [
                        'pdf',
                        'excel'
                    ]
                }
            ],
            language: {
            searchPlaceholder: "Search"
        }
        } );

        table.buttons().container()
            .appendTo( ' .col-md-6:eq(0)' );
    } );


        //   message div animation

        $("#alert1")
        .fadeTo(2000, 2000)
        .slideUp(500, function () {
            $("#alert1").slideUp(500);
        });

    //  message  div  animation
    </script>

@endsection
