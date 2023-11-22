@php
    $pageName = 'bookings';
    $tableHead = ['guestname', 'Mobile No', 'CheckIn/CheckOut Time', 'Paid Rent', 'Room Details' ,'Status'];
@endphp

@extends('layouts.backend')

@section('content')
    <x-reusables.app-header pageName="{{ $pageName }}" />

    {{-- @if (Session::has('message'))
    <div class="alert alert-success w-25 text-center mx-auto" role="alert" id="alert1">
        {{ Session::get('message') }}
    </div>
@endif --}}
    <div class="content px-3 py-0 w-100">
        <div class="container-fluid mt-5">
            <div class="card d-print-none">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h3 class="text-purple fw-bold mb-0">Today's Checkout Detail</h3>
                    <div></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle py-3" id="todaybooking_table"
                            style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true"
                            data-ordering="false" data-info="false">

                            <x-reusables.table-header :tableHead="$tableHead" />

                            <tbody class="text-capitalize">
                                @foreach ($todaycheckout as $item)

                                    <tr>
                                        <td class="text-left">{{$item->guest_name}}</td>
                                        <td class="text-left">{{$item->mobile_number}}</td>
                                        <td class="text-left">{{$item->check_in_time}}/{{$item->check_out_time}}</td>
                                        <td class="text-left">
                                            @if ($item->advance)
                                                @php
                                                    $Amt = 0;
                                                    $totalAmt = 0;
                                                    foreach ($item->advance as  $adv) {
                                                        $Amt += $adv->amount;
                                                    }
                                                    if ($item->advance_refund>0) {
                                                        $totalAmt = $Amt - $item->advance_refund;
                                                    }else{
                                                        $totalAmt = $Amt + $item->paid_rent;
                                                    }
                                                @endphp
                                                {{$totalAmt}}
                                            @endif
                                        </td>
                                        <td class=text-left>{{$item->room->room_number }}
                                            <span class="badge badge-primary bg-primary ">{{$item->room->category->name}}</span>
                                            <span class="d-block">{{$item->base_rent}} /-</span>
                                        </td>
                                        <td class="text-end">

                                            @if ($item->getRawOriginal('check_out_time') == null)
                                            <a href="{{ route('advance.create', ['booking_id' => $booking->id]) }}"
                                                class="btn btn-sm btn-purple open-modal" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" data-bs-title="Advance">
                                                <i class="fa-solid fa-plus"></i>
                                            </a>
                                            <a href="/bookings/edit/{{ $item->id }}"
                                                class="btn btn-sm btn-purple" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" data-bs-title="Edit"> <i
                                                    class="fa-solid fa-pen"></i></a>
                                                <a href="/bookings/checkout/{{ $item->id }}"
                                                    class="btn btn-sm btn-purple" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" data-bs-title="Checkout"> <i
                                                        class="fa-solid fa-sign-out"></i></a>
                                            @endif
                                            <a href="/bookings/{{ $item->id }}" class="btn btn-sm btn-purple"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="View">
                                                <i class="fa-solid fa-eye"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#todaybooking_table').DataTable({
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
    </script>
@endsection
