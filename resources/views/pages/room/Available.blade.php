    @php
    $pageName = 'bookings';
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
<div class="row mx-3 mt-3">
    <div class="col-xl-4">
        <!--begin::Statistics Widget 5-->
            <a href="{{ route('rooms.initial') }}" class="card hoverable card-xl-stretch project-link" data-project-id="initial"  style="background-color:tan">

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
                <div class="text-white fw-bolder fs-2 mb-2 mt-4">{{ count($initial) }}</div>
                <div class="fw-bold text-white">Initial</div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>
    <div class="col-xl-4">
        <!--begin::Statistics Widget 5-->
        {{-- <a href="{{route('rooms.basic')}}" class="card hoverable card-xl-stretch" style="background-color: #a7c2cc"> --}}
            <a href="{{ route('rooms.basic') }}" class="card hoverable card-xl-stretch project-link" data-project-id="basic" style="background-color: #a7c2cc">

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
                <div class="text-white fw-bolder fs-2 mb-2 mt-4">{{ count( $basic)}}</div>
                <div class="fw-bold text-white">Basic</div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>
    <div class="col-xl-4">
        <!--begin::Statistics Widget 5-->
        {{-- <a href="{{route('rooms.normal')}}"  class="card hoverable card-xl-stretch" style="background-color: rgba(134, 137, 169, 0.9)"> --}}
            <a href="{{ route('rooms.normal') }}" class="card hoverable card-xl-stretch project-link" data-project-id="normal" style="background-color: rgba(134, 137, 169, 0.9)">

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
                <div class="text-white fw-bolder fs-2 mb-2 mt-4">{{ count( $normal)}}</div>
                <div class="fw-bold text-white">Normal</div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>
    <div class="col-xl-4 mt-2">
        <!--begin::Statistics Widget 5-->
        {{-- <a href="{{route('rooms.premium')}}"  class="card hoverable card-xl-stretch" style="background-color: #7bb8cf"> --}}
            <a href="{{ route('rooms.premium') }}" class="card hoverable card-xl-stretch project-link" data-project-id="premium" style="background-color: #7bb8cf">

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
                <div class="text-white fw-bolder fs-2 mb-2 mt-4">{{ count( $premium)}}</div>
                <div class="fw-bold text-white">Premiuim</div>
            </div>
        </a>
        <!--end::Statistics Widget 5-->
    </div>
    <div class="col-xl-4 mt-2">
        <!--begin::Statistics Widget 5-->
        {{-- <a href="{{route('rooms.flats')}}"  class="card hoverable card-xl-stretch" style="background-color: #7bb8cf"> --}}
            <a href="{{ route('rooms.flats') }}" class="card hoverable card-xl-stretch project-link" data-project-id="flats" style="background-color: #7bb8cf">

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
                <div class="text-white fw-bolder fs-2 mb-2 mt-4">{{ count( $flats)}}</div>
                <div class="fw-bold text-white">Flats</div>
            </div>
        </a>
    </div>
    <div class="col-xl-4 mt-2">
        <!--begin::Statistics Widget 5-->
        {{-- <a href="{{route('rooms.other')}}" class="card hoverable card-xl-stretch" style="background-color: #7bb8cf"> --}}
            <a href="{{ route('rooms.other') }}" class="card hoverable card-xl-stretch project-link" data-project-id="other" style="background-color: #7bb8cf">

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
                <div class="text-white fw-bolder fs-2 mb-2 mt-4">{{ count( $other)}}</div>
                <div class="fw-bold text-white">Other</div>
            </div>
        </a>
    </div>

    <div id="project-details-container">
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#booking_table').DataTable({
            lengthChange: false,
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



</script>
<script>
          $(document).ready(function () {
        $(".project-link").on("click", function (e) {
            e.preventDefault();
            var projectId = $(this).data("project-id");
            var route;

            if (projectId === "initial") {
                route = "{{ route('rooms.initial') }}";
            } else if (projectId === "basic") {
                route = "{{ route('rooms.basic') }}";
            } else if (projectId === "normal") {
                route = "{{ route('rooms.normal') }}";
            } else if (projectId === "flats") {
                route = "{{ route('rooms.flats') }}";
            } else if (projectId === "other") {
                route = "{{ route('rooms.other') }}";
            } else if (projectId === "premium") {
                route = "{{ route('rooms.premium') }}";
            }

            $.ajax({
                url: route,
                method: "GET",
                success: function (data) {
                    // console.log(data);   
                    $("#project-details-container").html(data);
                }
            });
        });
    });
</script>

@endsection
