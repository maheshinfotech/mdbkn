
    {{-- <h1>Unbooked Rooms</h1>

    <table>


    </table> --}}
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
<div class="content px-3 py-0 w-100">
    <div class="container-fluid mt-5">
        <div class="card d-print-none">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h3 class="text-purple fw-bold mb-0">Booked Rooms</h3>
                <div></div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle py-3 text-center" id="booking_table"
                        style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true"
                        data-ordering="false" data-info="false">
                        <thead>
                            <tr>
                                <th class="text-center">Category</th>
                                <th class="text-center">Floor Number</th>
                                <th class="text-center">Room Number</th>
                                <th class="text-center">normal rent</th>
                                <th class="text-center">patient rent</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @foreach ($room_booked as $room)
                            <tr>
                                <td>{{ $room->category->name }}</td>
                                <td>{{ $room->floor_number }}</td>
                                <td>{{ $room->room_number }}</td>
                                <td>{{$room->category->normal_rent}}</td>
                                <td> {{$room->category->patient_rent}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="advanceModal" tabindex="-1" role="dialog" aria-labelledby="advanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
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
@endsection
