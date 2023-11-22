@php
    $pageName = 'bookings';
    $tableHead = ['guestname', 'Mobile No', 'Room Details', 'CheckIn Time', 'Advance Rent' , 'Due Rent'];
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
        <div class="container-fluid">
            <div class="d-flex my-3 justify-content-between align-items-center">
                <div class="">
                    <a href="/dashboard" class="btn btn-lg btn-purple "> <i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
            <div class="card d-print-none">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h3 class="text-purple fw-bold mb-0">Balance Due</h3>
                    <div></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle py-3" id="balance_duetable"
                            style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true"
                            data-ordering="false" data-info="false">

                            <x-reusables.table-header :tableHead="$tableHead" />

                            <tbody class="text-capitalize">
                                @foreach ($totalrentcount as $totb)
                                    <tr>
                                        <td class="text-left">{{$totb->guest_name}}</td>
                                        <td class="text-left">{{$totb->mobile_number}}</td>
                                        <td class=text-left>{{$totb->room->room_number }}
                                            <span class="badge badge-primary bg-primary ">{{$totb->room->category->name}}</span>
                                            <span class="d-block">{{$totb->base_rent}} /-</span>
                                        </td>
                                        <td class=text-left>
                                            {{date('d-M-y h:i A',strtotime($totb->getRawOriginal('check_in_time')))}}
                                        </td>
                                        <td class="text-left"> @if ($totb->advance)
                                            @php
                                                $Amt = 0;
                                                $totalAmt = 0;
                                                foreach ($totb->advance as  $adv) {
                                                    $Amt += $adv->amount;
                                                }
                                                if ($totb->advance_refund>0) {
                                                    $totalAmt = $Amt - $totb->advance_refund;
                                                }else{
                                                    $totalAmt = $Amt + $totb->paid_rent;
                                                }
                                            @endphp
                                            {{$totalAmt}}
                                        @endif</td>
                                        <td class="text-left">{{$totb->due}}</td>
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
            var table = $('#balance_duetable').DataTable({
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
