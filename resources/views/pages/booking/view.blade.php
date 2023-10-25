@php
    $pageName = 'booking';
    $tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
    $tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];
@endphp

@extends('layouts.backend')

@section('content')
    <x-reusables.app-header pageName="{{ $pageName }}" />
    <div class="content px-3 py-0 w-100">
           <!-- container starts -->
    <div class="container-fluid my-5">
        <!-- card starts -->
        <div class="card">
          <div class="card-header d-flex justify-content-between">
              <h3 class="text-purple fw-bold">Booking Records</h3>
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
                                  <a href="/bookings/{{ $booking->id }}" class="btn btn-sm btn-purple">View </a>
                              </td>
                          </tr>
                          @endforeach

                          {{-- <tr>
                              <td class="text-start">guest Name</td>
                              <td>Patient Name</td>
                              <td>11:00/22:00</td>
                              <td>name</td>
                              <td>9874563214</td>
                              <td>500</td>
                              <td class="text-end">
                                  <a class="btn btn-sm btn-purple">View </a>
                              </td>
                          </tr>
                          <tr>
                              <td class="text-start">guest Name</td>
                              <td>Patient Name</td>
                              <td>11:00/22:00</td>
                              <td>name</td>
                              <td>9874563214</td>
                              <td>500</td>
                              <td class="text-end">
                                  <a class="btn btn-sm btn-purple">View </a>
                              </td>
                          </tr> --}}
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
    </script>

@endsection
