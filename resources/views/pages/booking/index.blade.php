@php
    $pageName = 'dashboard';
    $tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
    $tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];

    $cardData = [
        ['color' => 'tan', 'duration' => '>3 days stay'],
        ['color' => '#a7c2cc', 'duration' => '>5 days stay'],
        ['color' => 'rgba(134, 137, 169, 0.9)', 'duration' => '>7 days stay'],
        ['color' => '#7bb8cf', 'duration' => '>15 days stay'],
        ['color' => 'rgb(162, 207, 123)', 'duration' => '>1 month stay'],
        ['color' => 'rgb(207, 123, 192)', 'duration' => '>2 month stay'],
    ];
@endphp

@extends('layouts.backend')

@section('content')
    <x-reusables.app-header pageName="{{ $pageName }}" />
    <div class="content  mx-0 w-100">
        <div class=" text-center text-purple p-4">
            <h1 class="mb-0">Welcome to Maheshwari Dharamshala</h1>
        </div>
    </div>

    <div class="row mx-3 mt-3">
        @foreach($cardData as $data)
            <div class="col-xl-4 mt-2">
                <a href="" class="card hoverable card-xl-stretch" style="background-color: {{ $data['color'] }}">
                    <div class="card-body">
                        <span class="svg-icon text-white svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor" />
                                <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor" />
                                <rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor" />
                                <rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor" />
                            </svg>
                        </span>
                        <div class="text-white fw-bolder fs-2 mb-2 mt-4">+</div>
                        <div class="fw-bold text-white duration">{{ $data['duration'] }}</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <div id="project-details-container">
        <script>
            $(document).ready(function () {
                $(".card").on("click", function (e) {
                    e.preventDefault();

                    var duration = $(this).find(".duration").text();
                    console.log(duration)

                    $.ajax({
                        url: '/booking/more',
                        method: "GET",
                        data: { duration: duration },
                        success: function (data) {
                            $("#project-details-container").html(data);
                        }
                    });
                });
            });
        </script>
    </div>
@endsection
