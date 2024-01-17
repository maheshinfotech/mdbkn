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
    <div class="container-fluid px-0">
        <!-- card starts -->
        <a href="/bookings" class="btn btn-lg btn-purple "> <i class="fa fa-arrow-left"></i> Back</a>

        <div class="card my-3">
          <div class="card-header bg-light">
            <h3 class="text-purple fw-bold mb-0">Booking Details</h3>
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
                      {{-- <span class="text-muted d-block">500 (Per Unit)</span> --}}
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
                      <span class=" fs-5">Guest Caste</span>
                      <span class="text-muted d-block">{{ $booking->guest_cast }}</span>
                  </div>
                  <div class="col-3">
                    <span class=" fs-5">Age</span>
                    <span class="text-muted d-block">{{ $booking->age }}</span>
                </div>
                <div class="col-3">
                    <span class=" fs-5">Mobile No.</span>
                    <span class="text-muted d-block">{{ $booking->mobile_number }}</span>
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
                    <span class=" fs-5">Patient Name</span>
                    <span class="text-muted d-block">{{ $booking->patient_name }}</span>
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
                    <span class=" fs-5">Doctor Name</span>
                    <span class="text-muted d-block">{{ $booking->docter_name }}</span>
                </div>
                <div class="col-3">
                    <span class=" fs-5">Hospital</span>
                    <span class="text-muted d-block">{{ $booking->hospital->name ?? 'No Hospital'}}</span>
                </div>

                  <div class="col-3">
                      <span class=" fs-5">Ward-Type (Ct/Rt)</span>
                      <span class="text-muted d-block">{{ $booking->ward->ward ?? 'No wards' }}</span>
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
                    <span class=" fs-5">Base Rent</span>
                    <span class="text-muted d-block">{{ $booking->base_rent }}</span>
                </div>
                <div class="col-3">
                    <span class=" fs-5">Advance Payment</span>
                    <span class="text-muted d-block">
                      {{-- @dd($booking->advance) --}}
                      @if ($booking->advance)
                          @php
                              $advanceamt = 0;
                              foreach ($booking->advance as $value) {
                                  $advanceamt += $value->amount;
                              }
                          @endphp
                          {{$advanceamt}}
                      @endif
                      {{-- {{ $booking->advance_payment }} --}}
                  </span>
                </div>
                  <div class="col-3">
                      <span class=" fs-5">Payable Rent</span>
                      <span class="text-muted d-block">{{ $booking->payable_rent }}</span>
                  </div>
                  <div class="col-3">
                      <span class=" fs-5">Paid Rent</span>
                      <span class="text-muted d-block">{{ $booking->paid_rent }}</span>
                  </div>
                  {{-- <div class="col-3">
                      <span class=" fs-5">Parking Provided</span>
                      <span class="text-muted d-block">{{ $booking->is_parking_provided?'Yes':'No' }}</span>
                  </div> --}}
                  <div class="col-3">
                    <span class=" fs-5">Refund Amount</span>
                    <span class="text-muted d-block">{{ $booking->advance_refund }}</span>
                </div>


                  <div class="col-12">
                      <span class=" fs-5">Extra Remarks</span>
                      <span class="text-muted d-block">{{ $booking->extra_remark }}</span>
                  </div>
              </div>
              <!--end::Details content-->

                  <div class="row justify-content-center my-5 fw-bold text-capitalize">

                    <div class="col-4">
                          <a target="_blank" href="{{ asset('').'storage/'.$booking->id_number }}">
                              <img src="{{ asset('').'storage/'.$booking->id_number }}" width="400" height="400" class=" mb-3 img-thumbnail" alt="Photo1">
                          </a>
                          <div class="text-center">ID Proof</div>
                      </div>
                      <div class="col-8">
                        <div class="row text-center">

                            <h3 class="text-purple fw-bolder">Other Guest Details</h3>
                            <table class="table table-bordered align-middle py-3 text-center">
                                <thead class="bg-light">
                                    <tr>
                                    <th>Guest Name</th>
                                    <th>Guest Age</th>
                                    <th>Guest Relation</th>
                                    <th>Remarks</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if ($booking->bookinglogs)
                                    @foreach ($booking->bookinglogs as $logs)
                                    <tr>
                                        <td>{{$logs->guest_name}}</td>
                                        <td>{{$logs->guest_age}}</td>
                                        <td>{{$logs->guest_relation}}</td>
                                        <td>{{$logs->guest_remarks}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{-- <div class="col-3">
                                <span class=" fs-5">Guest Name</span>
                                <span class="text-muted d-block">{{ $booking->base_rent }}</span>
                            </div>
                            <div class="col-3">
                                <span class=" fs-5">Guest Age</span>
                                <span class="text-muted d-block">{{ $booking->paid_rent }}</span>
                            </div>
                            <div class="col-3">
                                <span class=" fs-5">Guest Relation</span>
                                <span class="text-muted d-block">{{ $booking->is_parking_provided?'Yes':'No' }}</span>
                            </div>
                            <div class="col-3">
                                <span class=" fs-5">Remarks</span>
                                <span class="text-muted d-block">{{ $booking->advance_payment }}</span>
                            </div> --}}
                        </div>
                    </div>
                  </div>
          </div>
          <!--card body ends -->
        </div>
        <!-- card ends -->
      </div>
       <!-- container ends -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
