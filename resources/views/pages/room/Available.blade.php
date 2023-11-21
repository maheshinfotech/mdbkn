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
        <div class="d-flex flex-wrap mx-4 my-3 justify-content-between align-items-center">
            <div class="">
                <a href="/dashboard" class="btn btn-lg btn-purple "> <i class="fa fa-arrow-left"></i> Back</a>
            </div>
            <div class="">
                <h1 class="text-purple text-center my-3"> Room Database</h1>
            </div>
            <div></div>
        </div>

<div class="row mx-3">
    @php
    $color=['tan','#a7c2cc','rgba(134, 137, 169, 0.9)','#7bb8cf','rgb(162, 207, 123)','rgb(207, 123, 192)'];
       $i=0;
   @endphp
    @foreach ($category as $item)

    <div class="col-xl-4 mb-3">
        <!--begin::Statistics Widget 5-->
        {{-- @dd($color[$i]) --}}
            <a href="#" class="card hoverable card-xl-stretch project-link  " data-project-id="{{$item->id}}"  style="background-color:{{$color[$i]}}">
            <!--begin::Body-->
            <div class="card-body ">
                <div class="text-white fw-bolder fs-2 mb-2">{{ count($item->room) }}</div>
                <div class="fw-bold text-white">{{$item->room_name}}</div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>
    @php
        $i++
        // dd($i)
    @endphp
      @if ($i==count($color))
         @php

        $i=0;
        @endphp

      @endif
    @endforeach

    <div id="project-details-container">
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
                    $("#project-details-container").html(data);
                }
            });
        });
    });
</script>

@endsection
