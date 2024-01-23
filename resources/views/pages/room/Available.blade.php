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
        <div class="d-flex flex-wrap mx-4 my-3 justify-content-between align-items-center ">
            <div class="">
                <a href="/dashboard" class="btn btn-lg btn-purple "> <i class="fa fa-arrow-left"></i> Back </a>
            </div>
            @php
                $current_date=Carbon\Carbon::now();
                if($current_date->format('m')>3){
                $start_year=Carbon\Carbon::now()->format('Y-04-01');
                $end_year=Carbon\Carbon::now()->addYear()->format('Y-03-31');
                //   dd($start_year,$end_year);
                }else{
                $start_year=Carbon\Carbon::now()->subYear()->format('Y-04-01');
                $end_year=Carbon\Carbon::now()->format('Y-03-31');
                }
            @endphp
            <div class="">
                <h1 class="text-purple text-center mb-0"> Room Database ({{date('F Y',strtotime($start_year))." - ".date('F Y',strtotime($end_year))}})</h1>
            </div>
            <div><h4 class="text-purple text-center mb-1">Available Rooms ({{ $available_room_count }}/{{ $total_room_count}})</h4>

                    {{-- <select class="form-select w-75" id="ddlYears">
                        <option disabled>Select Year...</option>
                    </select> --}}

            </div>

        </div>


        <div class="row mx-3">
            @php
                $color=['tan','#a7c2cc','rgba(134, 137, 169, 0.9)','#7bb8cf','rgb(162, 207, 123)','rgb(207, 123, 192)'];
                $i=0;
            @endphp

            @foreach ($category as $item)
                @if ($item->name !== 'Other') <!-- Skip rendering for the "Other" category -->
                    <div class="col-xl-4 mb-3">
                        <!--begin::Statistics Widget 5-->
                        {{-- @dd($color[$i]) --}}
                        <a href="#" class="card hoverable card-xl-stretch project-link" data-project-id="{{$item->id}}" style="background-color:{{$color[$i]}}">
                            <!--begin::Body-->
                            <div class="card-body ">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-white fw-bolder fs-2 mb-2">{{$item->room }}/{{ $item->total_room }}
                                        <div class="fw-bold text-white fs-5">{{$item->room_name}}</div>
                                    </div>
                                    <div class="fw-bold text-white fs-4"> {{ $item->total_booking_amount }}  &#8377;</div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                    @php
                        $i++
                    @endphp

                    @if ($i == count($color))
                        @php
                            $i = 0;
                        @endphp
                    @endif
                @endif
            @endforeach

            <div id="project-details-container"></div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#booking_table').DataTable({
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

            $.ajax({
                url: '/room/'+projectId,
                method: "GET",
                success: function (data) {
                    console.log(data);
                    $("#project-details-container").html(data);
                }
            });
        });
    });
</script>
<script>
    let dateDropdown = document.getElementById('ddlYears');
    let currentYear = new Date().getFullYear();
    let c1 = new Date().getFullYear() + 1;
    let earliestYear = 2020;

    while (+currentYear >= +earliestYear ) {
        let dateOption = document.createElement('option');
        dateOption.value = earliestYear;
        dateOption.text = `${earliestYear} - ${(earliestYear+1) - 2000}`;


        dateDropdown.add(dateOption);
        dateDropdown.setAttribute('selected', earliestYear == currentYear);
// console.log(earliestYear);
// console.log(currentYear);
        earliestYear += 1;
    }
  </script>
@endsection
