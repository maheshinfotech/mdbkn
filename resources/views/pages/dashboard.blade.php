@php
    $pageName = 'dashboard';
    $tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
    $tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];
@endphp

@extends('layouts.backend')

@section('content')
    <x-reusables.app-header pageName="{{ $pageName }}" />
    <div class="content  mx-0 w-100">
        <div class=" text-center text-purple p-4">
                <h1 class="mb-0 dashHeading ">Welcome to Maheshwari Dharamshala</h1>
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
        {{-- <div class="col-xl-4 mb-3">
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
        </div> --}}
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
            <a href="{{ route('balancedue')}}" class="card hoverable card-xl-stretch" style="background-color: rgb(207, 123, 192)">
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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
