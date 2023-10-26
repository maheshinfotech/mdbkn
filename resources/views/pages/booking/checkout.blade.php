@php
    $pageName = 'checkout';
    // $tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
    // $tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];
@endphp

@extends('layouts.backend')

@section('content')
    <x-reusables.app-header pageName="{{ $pageName }}" />

    @if (Session::has('message'))
    <div class="alert alert-success w-25 text-center  mx-auto" role="alert" id="alert1"> {{Session::get('message')}}
    </div>
    @endif
    <!-- container starts -->
    <div class="container-fluid my-5">
      <!-- card starts -->
      <div class="card">
        <div class="card-header bg-light">
          <h3 class="text-purple fw-bold">Add Checkout Details</h3>
        </div>
        <!--card body starts -->
        <div class="card-body">
          <!--form starts -->
          <form action="" method="post">

            <!--begin::Input group-->
            <div class="row">
              <!-- col start -->
              <div class="col-md-6 mb-3">
                  <label class=" fw-bold mb-1 ">Guest Name:</label>
                  <input type="text" class="form-control"  name="" id="" value="{{$booking->guest_name}}"/>
              </div>
              <!-- col start -->
              <div class="col-md-6 mb-3">
                <label class=" fw-bold mb-1 ">Guest Mobile No:</label>
                <input type="text" class="form-control"  name="" id="" value="{{$booking->mobile_number}}"/>
              </div>
              <!-- col start -->
              <div class="col-md-6 mb-3">
                <label class=" fw-bold mb-1 ">Room Number:</label>
                <input type="text" class="form-control"  name="" id="" value="{{$booking->room->room_number}}"/>
              </div>
              <!-- col start -->
              <div class="col-md-6 mb-3">
                <label class="fw-bold mb-1 ">Room Category:</label>
                <input type="text" class="form-control"  name="" id="" value="{{$booking->room->category->name}}"/>
              </div>
              <!-- col start -->
              <div class="col-md-4 mb-3">
                  <label class=" fw-bold mb-1">Check-In Date:</label>
                  <input type="datetime-local" class="form-control" name="" id="check_in_timedet" value="{{$booking->getRawOriginal('check_in_time')}}"/>
              </div>
              <!-- col start -->
              <div class="col-md-4 mb-3">
                <label class=" fw-bold mb-1">Check-Out Date:</label>
                <input type="hidden" name="booking_id" id="booking_id_checkout" value="{{$booking->id}}">
                <input type="datetime-local" class="form-control" name="" id="check_out_timedet" />
              </div>
              <!-- col start -->
              <div class="col-md-4 mb-3">
                  <label class="fw-bold mb-1">Total Days:</label>
                  <input type="text" class="form-control" id="estimatedDays" name="" />
              </div>
               <!-- col start -->
               <div class="col-md-4 mb-3">
                <label class="fw-bold mb-1">Advance Payment:</label>
                <input type="text" class="form-control" id="" name="" value="{{$booking->advance_payment}}"/>
              </div>
              <!-- col start -->
              <div class="col-md-4 mb-3">
                <label class="fw-bold mb-1">Total Rent:</label>
                <input type="text" class="form-control" id="paybleRent" name="" />
              </div>
                <!-- col start -->
                <div class="col-md-4 mb-3">
                    <label class="fw-bold mb-1">Paid Rent:</label>
                    <input type="text" class="form-control" id="" name="" />
                </div>
            </div>
            <!--end::Input group-->
          </form>
          <!--form ends -->

          <div class="text-center my-4">
            <button class="btn btn-lg btn-purple" type="submit">Save Details</button>
          </div>
        </div>
        <!--card body ends -->
      </div>
      <!-- card ends -->
    </div>
     <!-- container ends -->
     <script>
        $('#check_out_timedet').on('change',function(){
             //value start
//             var start = Date.parse($("input#check_in_timedet").val()); //get timestamp

//             //value end
//             var end = Date.parse($("input#check_out_timedet").val()); //get timestamp

//             totalHours = NaN;
//             // if (start < end) {
//                 totalHours = Math.floor((end - start) / 1000 / 60 / 60); //milliseconds: /1000 / 60 / 60
//             // }
// console.log(totalHours);
            // $("#total-hours").val(totalHours);
             var out_time = $(this).val();
             var booking_id = $('#booking_id_checkout').val();
            //  console.log(booking_id);
            $.ajax({
            url: "/checkoutcalculation",
            type: "GET",
            data: { out_time ,booking_id},
                    success: function (data) {

        $('#estimatedDays').val(data.estimateDays);
        $('#paybleRent').val(data.payble_rent);


                    }
            })
        })
     </script>
     @endsection

