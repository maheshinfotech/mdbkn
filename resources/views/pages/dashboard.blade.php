@php
    $pageName = 'dashboard';
    $tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
    $tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];
@endphp
@extends('layouts.backend')
@section('content')
    <x-reusables.app-header pageName="{{ $pageName }}" />
    <div class="content  mx-0 w-100">
        <div class="text-center text-purple p-4">
            <h1 class="mb-0 dashHeading ">Welcome to Maheshwari Dharamshala</h1>
        </div>
    </div>

    <div class="row mx-3 mt-3">
        <div class="col-md-2 offset-md-10">
            <div class="form-group">
                <label for="dateInput">Select Date:</label>
                <input type="date" id="dateInput" name="date" class="form-control">
            </div>
        </div>
    </div>

    <div class="row mx-3 mt-3">
        <div class="col-xl-4 mb-3">
            <!--begin::Statistics Widget 5-->
            <a href="/booking/index" class="card hoverable card-xl-stretch" style="background-color:tan">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon text-white svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor" />
                            <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor" />
                            <rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor" />
                            <rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor" />
                        </svg>
                    </span>
                    <div class="text-white fw-bolder fs-2 mb-2 mt-4">{{ $running_booking_count }}+</div>
                    <div class="fw-bold text-white">Current Bookings</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>
        <div class="col-xl-4 mb-3">
            <!--begin::Statistics Widget 5-->
            <a href="{{ route('Available-rooms')}}" class="card hoverable card-xl-stretch" style="background-color: #a7c2cc">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon text-white svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor" />
                            <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor" />
                            <rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor" />
                            <rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor" />
                        </svg>
                    </span>
                    <div class="text-white fw-bolder fs-2 mb-2 mt-4">{{ $room_available_count }}+</div>
                    <div class="fw-bold text-white">Room Database</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>
        <div class="col-xl-4 mb-3">
            <!--begin::Statistics Widget 5-->
            <a href="{{ route('today-bookings') }}" class="card hoverable card-xl-stretch" style="background-color: rgba(134, 137, 169, 0.9)">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon text-white svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor" />
                            <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor" />
                            <rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor" />
                            <rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor" />
                        </svg>
                    </span>
                    <div class="text-white fw-bolder fs-2 mb-2 mt-4">{{ $today_booking_count }}+</div>
                    <div class="fw-bold text-white">Today Booking</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>
        <div class="col-xl-4 mb-3">
            <!--begin::Statistics Widget 5-->
            <a href="{{ route('booked-rooms')}}" class="card hoverable card-xl-stretch" style="background-color: #7bb8cf">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon text-white svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor" />
                            <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor" />
                            <rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor" />
                            <rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor" />
                        </svg>
                    </span>
                    <div class="text-white fw-bolder fs-2 mb-2 mt-4">{{ $room_booked_count }}+</div>
                    <div class="fw-bold text-white">Room Booked</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>
        <div class="col-xl-4 mb-3">
            <!--begin::Statistics Widget 5-->
            <a href="{{ route('todaycheckout')}}" class="card hoverable card-xl-stretch" style="background-color: rgb(162, 207, 123)">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon text-white svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor" />
                            <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor" />
                            <rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor" />
                            <rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor" />
                        </svg>
                    </span>
                    <div class="text-white fw-bolder fs-2 mb-2 mt-4">{{ $today_checkout_count }}+</div>
                    <div class="fw-bold text-white">Today's Checkout</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>
        <div class="col-xl-4 mb-3">
            <!--begin::Statistics Widget 5-->
            <a href="{{ route('balancedue')}}" class="card hoverable card-xl-stretch" style="background-color: #c97bbc">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon text-white svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor" />
                            <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor" />
                            <rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor" />
                            <rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor" />
                        </svg>
                    </span>
                    <div class="text-white fw-bolder fs-2 mb-2 mt-4">{{$totalbookingcou}}+</div>
                    <div class="fw-bold text-white">Due Balance</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>
    </div>

  <div class="row mx-3 " style="margin-top: 13%" >
    <div class="col-md-6" id="BookedRooms" style="display: none">
        <div class="bg-white">
            <div class=" p-3 bg-light d-flex justify-content-between align-items-center">
                <h3 class="text-purple fw-bold mb-0"> Booked Rooms</h3>
                <div></div>
            </div>
            <div class=" table-responsive">
                <table class="table table-striped align-middle py-3 text-center"  id="bookedRooms_table" >
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Guest Name</th>
                            <th>Patient Name</th>
                            <th>Check-IN TIME</th>
                            <th>Room No</th>
                        </tr>
                    </thead>
                    <tbody id="previous_booking_data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  <div class="col-md-6" id="AvailableRooms" style="display: none">
    <div class="bg-white">
        <div class="p-3 bg-light d-flex justify-content-between align-items-center">
            <h3 class="text-purple fw-bold mb-0">Available Rooms</h3>
            <div></div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped align-middle py-3 text-center" id="available_rooms_table">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Room No</th>
                        <th>Catgory</th>
                    </tr>
                </thead>
                <tbody id="available_rooms_data">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
 $(document).ready(function () {
    $('#dateInput').change(function () {
        var selectedDate = $(this).val();
             $('#bookedRooms_table').DataTable().destroy();
            $('#available_rooms_table').DataTable().destroy();
        $.ajax({
            type: 'POST',
            url: '{{ route("getBookedRoomsCount") }}',
            data: {
                selectedDate: selectedDate,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                console.log(response);

                if (response && response.hasOwnProperty('bookedRoomsCount')) {
                    var totalRooms = 113;
                    var availableRoomsCount = totalRooms - response.bookedRoomsCount;

                    // Create the card dynamically
                    var card = $('<div>', {
                        class: 'card',
                        id: 'bookedRoomsCountCard',
                        style: 'background-color: #7bb8cf; cursor: pointer; z-index: 9999;' // Add z-index style
                    });

                    card.html(`
                        <div class="card-body">
                            <span class="svg-icon text-white svg-icon-3x ms-n1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor" />
                                    <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor" />
                                    <rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor" />
                                    <rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor" />
                                </svg>
                            </span>
                            <div class="text-white fw-bolder fs-2 mb-2 mt-4">
                                Rooms Booked on Selected Date
                            </div>
                            <div class="fw-bold text-white">
                                Booked Rooms Count: ${response.bookedRoomsCount}
                            </div>
                            <div class="fw-bold text-white">
                                Available Rooms Count: ${availableRoomsCount}
                            </div>
                        </div>



                    `);


                    $('.card').hide();

                    card.on('click', function () {
    $.ajax({
        type: 'POST',
        url: '{{ route("getBookedRoomsDetails") }}',
        data: {
            selectedDate: selectedDate,
            _token: '{{ csrf_token() }}'
        },
        success: function (detailsResponse) {
            $("#BookedRooms").css('display', 'block');
            $("#AvailableRooms").css('display', 'block');

            var bookedRooms = detailsResponse.bookedRoomsDetails;
            var availableRooms = detailsResponse.availableRooms;

            console.log(bookedRooms);
            console.log(bookedRooms.length);

            console.log(availableRooms);
            console.log(availableRooms.length);

            var bookedHtml = ``;
            var availableHtml = ``;

            for (let i = 0; i < bookedRooms.length; i++) {
    bookedHtml += `
        <tr>
            <td>${i + 1}</td> <!-- Serial number -->
            <td>${bookedRooms[i].guest_name}</td>
            <td>${bookedRooms[i].patient_name}</td>
            <td>${bookedRooms[i].check_in_times}</td>
            <td>${bookedRooms[i].room.room_number}</td>
        </tr>`;
        }
            var availableRooms = detailsResponse.availableRooms;

            console.log(availableRooms);
             console.log(availableRooms.length);
                  var availableHtml = ``;
         for (let i = 0; i < availableRooms.length; i++) {
                  availableHtml += `
                     <tr>
                        <td>${i + 1}</td>
               <td>${availableRooms[i].room_number}</td>
               <td>${availableRooms[i].category.name}</td>

             </tr>`;
           }

            console.log(bookedHtml);
            console.log(availableHtml);

            $("#previous_booking_data").html(bookedHtml);
            $("#available_rooms_data").html(availableHtml);
            $('#bookedRooms_table').DataTable().destroy();
            $('#available_rooms_table').DataTable().destroy();

            $('#bookedRooms_table').DataTable( {
        dom: 'Bfrt',
        lengthChange: false,
        "pageLength":200,
        buttons: [
            // 'copyHtml5',
            // 'excelHtml5',
            // 'csvHtml5',
            'pdfHtml5'
        ]
    } );

    $('#available_rooms_table').DataTable( {
        dom: 'Bfrt',
        lengthChange: false,
        "pageLength":200,
        buttons: [
            // 'copyHtml5',
            // 'excelHtml5',
            // 'csvHtml5',
            'pdfHtml5'
        ]
    } );
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
     });
    });
           card.appendTo($('body')).addClass('position-absolute top-50 start-50 translate-middle');
                } else {
                    console.error('Invalid response format:', response);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });


});
</script>

@endsection





{{-- <script>
    $(document).ready(function () {
   $('#dateInput').change(function () {
       var selectedDate = $(this).val();

       $.ajax({
           type: 'POST',
           url: '{{ route("getBookedRoomsCount") }}',
           data: {
               selectedDate: selectedDate,
               _token: '{{ csrf_token() }}'
           },
           success: function (response) {
               console.log(response);

               if (response && response.hasOwnProperty('bookedRoomsCount')) {
                   var totalRooms = 113;
                   var availableRoomsCount = totalRooms - response.bookedRoomsCount;

                   // Create the card dynamically
                   var card = $('<div>', {
                       class: 'card',
                       id: 'bookedRoomsCountCard',
                       style: 'background-color: #7bb8cf; cursor: pointer; z-index: 9999;' // Add z-index style
                   });

                   card.html(`
                       <div class="card-body">
                           <span class="svg-icon text-white svg-icon-3x ms-n1">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                   <rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor" />
                                   <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor" />
                                   <rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor" />
                                   <rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor" />
                               </svg>
                           </span>
                           <div class="text-white fw-bolder fs-2 mb-2 mt-4">
                               Rooms Booked on Selected Date
                           </div>
                           <div class="fw-bold text-white">
                               Booked Rooms Count: ${response.bookedRoomsCount}
                           </div>
                           <div class="fw-bold text-white">
                               Available Rooms Count: ${availableRoomsCount}
                           </div>
                       </div>
                   `);
                   $('.card').hide();

                   // Click event handler for the card
                   card.on('click', function () {
                       // AJAX request to get booked rooms details
                       $.ajax({
                           type: 'POST',
                           url: '{{ route("getBookedRoomsDetails") }}',
                           data: {
                               selectedDate: selectedDate,
                               _token: '{{ csrf_token() }}'
                           },
                           success: function (detailsResponse) {
                                   console.log(detailsResponse);
                               if (detailsResponse && detailsResponse.hasOwnProperty('bookedRoomsDetails')) {
                                   displayBookedRoomsTable(detailsResponse.bookedRoomsDetails);
                               } else {
                                   console.error('Invalid response format:', detailsResponse);
                               }
                           },
                           error: function (xhr, status, error) {
                               console.error('AJAX Error:', status, error);
                           }
                       });
                   });

                   card.appendTo($('body')).addClass('position-absolute top-50 start-50 translate-middle');
               } else {
                   console.error('Invalid response format:', response);
               }
           },
           error: function (xhr, status, error) {
               console.error('AJAX Error:', status, error);
           }
       });
   });

   function displayBookedRoomsTable(bookedRoomsDetails) {
       $('#bookedRoomsTable tbody').empty();

       $.each(bookedRoomsDetails, function (index, room) {
           $('#bookedRoomsTable tbody').append(`
               <tr>
                   <td>${room.room_number}</td>
               </tr>
           `);
       });

       // Show the table
       $('#bookedRoomsTable').show();
   }
});




   </script> --}}
