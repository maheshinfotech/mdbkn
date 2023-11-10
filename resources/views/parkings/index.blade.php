@php
    $pageName = 'bookings';
    $tableHead = ['Username', 'Phone', 'Time', 'Vehicle No.', 'Action'];
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
            <div class="card">

                <div class="card-body">
                    <form class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('add-parking') }}"
                        method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="example-if-email2">Active Booking</label>

                            <select name="active_booking" class="form-select active-booking" id=""
                                placeholder="Email">
                                <option value="0">N/A</option>
                                @foreach ($activeBooking as $booking)
                                    <option value="{{ $booking->id }}" data-username="{{ $booking->guest_name }}"
                                        data-phone="{{ $booking->mobile_number }}">
                                        {{ $booking->room->room_number }} / {{ $booking->guest_name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-12">
                            <label for="example-if-password2">Username</label>
                            <input type="text" class="form-control username" id="example-if-password2" name="username"
                                required placeholder="Username">
                        </div>
                        <div class="col-12">
                            <label for="example-if-password3">Phone.</label>
                            <input type="text" class="form-control phone" id="example-if-password3" name="userphone"
                                required placeholder="Phone">
                        </div>

                        <div class="col-12">
                            <label for="example-if-password4">Vehicle No.</label>
                            <input type="text" class="form-control" id="example-if-password4" name="vehicle" required
                                placeholder="Vehicle No.">
                        </div>

                        <div class="col-12">
                            <label for="example-if-password4">Parking Start Date</label>
                            <input type="datetime-local" class="form-control" id="example-if-password4" required
                                value="<?= date('Y-m-d H:i') ?>" name="start_date">
                        </div>
                        <div class="col-12 align-end">
                            <label for=""></label>
                            <button type="submit" class="btn btn-dark">Add New Parking</button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="card d-print-none">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h3 class="text-purple fw-bold mb-0">Current Parkings</h3>
                    <div></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle py-3" id="booking_table"
                            style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true"
                            data-ordering="false" data-info="false">

                            <x-reusables.table-header :tableHead="$tableHead" />

                            <tbody class="text-capitalize">
                                @foreach ($listingData as $data)
                                    <tr>
                                        <td class="text-left">{{ $data->username }}</td>
                                        <td class="text-left">{{ $data->userphone }}</td>
                                        <td class="text-left">{{ $data->parking_start }}</td>
                                        <td class="text-left">{{ $data->vehicle_number }}</td>
                                        <td class="text-left">
                                            <a class="btn btn-sm btn-purple clear-parking-model" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" data-bs-title="Clear Parking"
                                                data-id="{{ $data->id }}">
                                                <i class="fa-solid fa-sign-out"></i>
                                            </a>
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

      {{-- Model --}}

      <button type="button" class="btn btn-alt-primary push trigger-parking-clear-modal d-none" data-bs-toggle="modal"
            data-bs-target="#modal-block-normal">Launch Modal</button>

      <div class="modal" id="modal-block-normal" tabindex="-1" aria-labelledby="modal-block-normal" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="block block-rounded block-transparent mb-0">
                        <div class="block-header block-header-default">
                              <h3 class="block-title">Clear Parking</h3>
                              <div class="block-options">
                              <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                              </button>
                              </div>
                        </div>
                        <form action="{{ route('clear-parking') }}" method="post">
                              @csrf
                              <div class="block-content fs-sm">

                                    <div class="row">
                                          <div class="col-12 mb-4">
                                                <label for="example-if-password2">End Date</label>
                                                <input type="datetime-local" value="{{ date('Y-m-d h:i') }}"
                                                class="form-control parking-end-date" id="example-if-password2" name="username"
                                                required placeholder="End date">
                                          </div>

                                          <input type="hidden" class="parking_id" name="parking_id">

                                          <div class="col-12 mb-4">

                                                <label for="">Payable Amount</label>

                                                <input type="text" readonly class="form-control payable-amount" value="0"
                                                name="received_amount" />

                                          </div>

                                    </div>
                              </div>
                              <div class="block-content block-content-full text-end bg-body">
                                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                                    data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                              </div>

                        </form>
                  </div>
                  </div>
            </div>
      </div>

    {{-- Model End --}}
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

        $('.active-booking').change(function() {

            let res = $(this).val();

            let activeBooking = $(`.active-booking option:selected`);

            $('.username').val($(activeBooking).data('username'));

            $('.phone').val($(activeBooking).data('phone'));

        });

        $('.clear-parking-model').click(function() {

            $('.trigger-parking-clear-modal').trigger('click');

            $('.parking_id').val($(this).data('id'));

            $('.parking-end-date').trigger('change');

        });

        $('.parking-end-date').change(function(){
            $.ajax({

                  url : "{{route('parking-fetch-charge')}}" ,

                  data : {
                        end_date : $('.parking-end-date').val() ,
                        parking_id : $('.parking_id').val() ,
                  },

                  method : "post",

                  success : function(res){
console.log(res.data.paid_amount);
                        $('.payable-amount').val(res.data.paid_amount);

                  }
            })
        })
    </script>
@endsection
