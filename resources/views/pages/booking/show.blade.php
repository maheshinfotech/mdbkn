@php
    $pageName = 'booking';
    $tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
    $tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];
@endphp

@extends('layouts.backend')

@section('content')
    <x-reusables.app-header pageName="{{ $pageName }}" />
    <div class="content  mx-0 w-100">
        <!-- container starts -->
    <div class="container-fluid my-5">
        <!-- card starts -->
        <div class="card">
          <div class="card-header bg-light">
            <h3 class="text-purple fw-bold">Booking Details</h3>
          </div>
          <!--card body starts -->
          <div class="card-body">
              <!--begin::Details content-->
              <div class="row g-5 pt-3 fw-bold text-capitalize justify-content-center">
                  <div class="col-3">
                      <span class=" fs-5">Category </span>
                      <span class="text-muted d-block">{{ $booking->room->category->name }}</span>
                  </div>
                  <div class="col-3">
                      <span class=" fs-5">Room</span>
                      <span class="text-muted d-block">{{ $booking->room->room_number }}</span>
                  </div>
                  <div class="col-3">
                      <span class=" fs-5">Guest Name</span>
                      <span class="text-muted d-block">{{ $booking->guest_name }}</span>
                      <span class="text-muted d-block">500 (Per Unit)</span>
                  </div>
                  <div class="col-3">
                    <span class=" fs-5">Relation (Patient)</span>
                    <span class="text-muted d-block">{{ $booking->relation_patient }}</span>
                </div>
                  <div class="col-3">
                      <span class=" fs-5">Guest Father Name</span>
                      <span class="text-muted d-block">{{ $booking->guest_father_name }}</span>
                  </div>
                  <div class="col-3">
                    <span class=" fs-5">Patient Name</span>
                    <span class="text-muted d-block">{{ $booking->patient_name }}</span>
                </div>
                  <div class="col-3">
                      <span class=" fs-5">Guest Caste</span>
                      <span class="text-muted d-block">{{ $booking->guest_cast }}</span>
                  </div>
                  <div class="col-3">
                    <span class=" fs-5">Age</span>
                    <span class="text-muted d-block">{{ $booking->age }}</span>
                </div>
                  <div class="col-3">
                      <span class=" fs-5">Guest Address</span>
                      <span class="text-muted d-block">{{ $booking->guest_address }}</span>
                  </div>
                  <div class="col-3">
                    <span class=" fs-5">Tehsil</span>
                    <span class="text-muted d-block">{{ $booking->tehsil }}</span>
                </div>
                  <div class="col-3">
                    <span class=" fs-5">City</span>
                    <span class="text-muted d-block">{{ $booking->city }}</span>
                </div>
                <div class="col-3">
                    <span class=" fs-5">State</span>
                    <span class="text-muted d-block">{{ $booking->state }}</span>
                </div>

                  <div class="col-3">
                      <span class=" fs-5">Patient Ward No</span>
                      <span class="text-muted d-block">{{ $booking->patient_ward_no }}</span>
                  </div>
                  <div class="col-3">
                      <span class=" fs-5">Patient Bed No.</span>
                      <span class="text-muted d-block">{{ $booking->patient_bed_no }}</span>
                  </div>
                  <div class="col-3">
                      <span class=" fs-5">Check-In/Out Time</span>
                      <span class="text-muted d-block">{{ $booking->check_in_time}} / {{  $booking->check_out_time }}</span>
                  </div>
                  <div class="col-3">
                      <span class=" fs-5">
                          Estimated Total Days</span>
                      <span class="text-muted d-block">{{ $booking->estimated_total_days }}</span>
                  </div>


                  <div class="col-3">
                      <span class=" fs-5">Mobile No.</span>
                      <span class="text-muted d-block">{{ $booking->mobile_number }}</span>
                  </div>
                  <div class="col-3">
                      <span class=" fs-5">Doctor Name</span>
                      <span class="text-muted d-block">{{ $booking->docter_name }}</span>
                  </div>



                  <div class="col-3">
                      <span class=" fs-5">Ward-Type (Ct/Rt)</span>
                      <span class="text-muted d-block">{{ $booking->ward_type }}</span>
                  </div>
                  <div class="col-3">
                      <span class=" fs-5">Payable Rent</span>
                      <span class="text-muted d-block">{{ $booking->payable_rent }}</span>
                  </div>
                  <div class="col-3">
                      <span class=" fs-5">Base Rent</span>
                      <span class="text-muted d-block">{{ $booking->base_rent }}</span>
                  </div>
                  <div class="col-3">
                      <span class=" fs-5">Paid Rent</span>
                      <span class="text-muted d-block">{{ $booking->paid_rent }}</span>
                  </div>
                  <div class="col-3">
                      <span class=" fs-5">Parking Provided</span>
                      <span class="text-muted d-block">{{ $booking->is_parking_provided?'Yes':'No' }}</span>
                  </div>
                  <div class="col-3">
                      <span class=" fs-5">Advance Payment</span>
                      <span class="text-muted d-block">{{ $booking->advance_payment }}</span>
                  </div>
                  <div class="col-12">
                      <span class=" fs-5">Extra Remarks</span>
                      <span class="text-muted d-block">{{ $booking->extra_remark }}</span>
                  </div>
              </div>
              <!--end::Details content-->
                  <div class="row justify-content-center my-5">
                      <div class="col-6 text-center">
                          <a target="_blank" href="{{ asset('').'storage/'.$booking->id_number }}">
                              <img src="{{ asset('').'storage/'.$booking->id_number }}" width="400" height="400" class=" mb-3 img-thumbnail" alt="Photo1">
                          </a>
                          <div class="">ID Proof</div>
                      </div>
                  </div>
          </div>
          <!--card body ends -->
        </div>
        <!-- card ends -->
      </div>
       <!-- container ends -->

    </div>
@endsection
