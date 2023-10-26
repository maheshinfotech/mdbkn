@php
    $pageName = 'booking';
    // $tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
    // $tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];
@endphp

@extends('layouts.backend')
@section('content')
    @if (Session::has('message'))
        <div class="alert alert-success w-25 text-center mx-auto" role="alert" id="alert1">
            {{ Session::get('message') }}
        </div>
    @endif

    <!-- container starts -->
    <div class="container-fluid my-5">
        <!-- card starts -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="text-purple fw-bold">Room Records</h3>
                <div>
                    <button type="button" class="btn btn-purple" data-bs-toggle="modal" data-bs-target="#roomModal">
                        Add Rooms +
                    </button>
                </div>
            </div>
            <!--card body starts -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle py-3 text-center" id="room_table"
                        style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true"
                        data-ordering="false" data-info="false">
                        <thead>
                            <tr>
                                <th class="text-start">Floor Number</th>
                                <th class="text-center">Room Number</th>
                                <th class="text-center">Booked Date</th>
                                <th class="text-center">Guest Capacity</th>
                                <th class="text-center">Room Status</th>
                                <th class="text-center">Remarks</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @foreach ($rooms as $room)
                                <tr>
                                    <td class="text-start">{{ $room->floor_number }}</td>
                                    <td>{{ $room->room_number }}</td>
                                    <td>{{ $room->booked_date }}</td>
                                    <td>{{ $room->guest_capacity }}</td>
                                    @if ($room->room_status==1 || is_null($room->room_status))
                                    <td class="text-success fw-bold">Active </span></td>


                                    @else
                                    <td class="text-danger fw-bold">Inactive</span></td>
                                    @endif

                                    <td>{{ $room->extra_remark }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm">
                                            <span class=" fa fa-pen" onclick="room_edit({{ $room->id }})"
                                                data-bs-toggle="modal" data-bs-target="#roomModal"></span>
                                        </a>
                                        <a class="btn btn-sm delete-record" data-id="{{ $room->id }}" data-module="room"
                                            data-name="{{ $room->id }}">
                                            <span class=" fa fa-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- <tr>
                                <td class="text-start">2</td>
                                <td>201</td>
                                <td>12-11-2023</td>
                                <td>4</td>
                                <td class="text-danger fw-bold">Inactive</span></td>
                                <td>this is demo description</td>
                                <td class="text-end">
                                    <a class="btn btn-sm">
                                        <span class=" fa fa-pen"></span>
                                    </a>
                                    <a class="btn btn-sm">
                                        <span class=" fa fa-trash"></span>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-start">2</td>
                                <td>201</td>
                                <td>12-11-2023</td>
                                <td>4</td>
                                <td class="text-success fw-bold">Active</span></td>
                                <td>this is demo description</td>
                                <td class="text-end">
                                    <a class="btn btn-sm">
                                        <span class=" fa fa-pen"></span>
                                    </a>
                                    <a class="btn btn-sm">
                                        <span class=" fa fa-trash"></span>
                                    </a>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <!--card body ends -->
        </div>
        <!-- card ends -->
        <!-- Modal -->
        <div class="modal fade" id="roomModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header border border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3 class="text-purple text-center mb-4 mt-0" id="room_form_heading">Add Room Details</h3>
                        <form action="/room" method="post" id="room_form">
                            @csrf
                            <input type="hidden" id="room_method" name="_method">
                            <div class="row">
                                <!-- col start -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label class=" fw-bold mb-1 ">Floor Number:</label>
                                    <input type="text" class="form-control" name="floor" id="floor_number" required />
                                </div>
                                <!-- col start -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label class=" fw-bold mb-1 ">Room Number:</label>
                                    <input type="text" class="form-control" name="room_no" id="room_number" required />
                                </div>
                                <!-- col start -->
                                <!-- col start -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label class=" fw-bold mb-1 ">Room Category:</label>
                                    {{-- <label class=" fw-bold mb-1 ">Room Status:</label> --}}
                                    <select id="category" class="form-select" name="category" required>
                                        <option disabled selected>Category...</option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label class=" fw-bold mb-1 ">Extra Remarks:</label>
                                    <input type="text" class="form-control" name="remarks" id="remarks" required />
                                </div>

                                <!-- col start -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label class=" fw-bold mb-1 ">Guest Capacity:</label>
                                    <input type="text" class="form-control" name="capacity" id="capacity" required />
                                </div>
                                <!-- col start -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label class=" fw-bold mb-1 ">Room Status:</label>
                                    <select id="status" class="form-select" name="status" required>
                                        <option disabled selected>Status...</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="mt-3 mb-5 text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-purple" id="room_from_button">Save</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
    <!-- container ends -->

<script>
    //   message div animation

$("#alert1")
    .fadeTo(2000, 2000)
    .slideUp(500, function () {
        $("#alert1").slideUp(500);
    });

//  message  div  animation
</script>

@endsection
