@php
$pageName = 'bookings';
$tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
$tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];
@endphp

@extends('layouts.backend')

@section('content')
{{-- <a href="booking/index">Go to Booking List</a>
<table class="table"> --}}
<x-reusables.app-header pageName="{{ $pageName }}" />
@if (Session::has('message'))
    <div class="alert alert-success w-25 text-center mx-auto" role="alert" id="alert1">
        {{ Session::get('message') }}
    </div>
@endif
 <div class="container-fluid my-5">
      <!-- card starts -->
      <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="text-purple fw-bold">Hospital Details</h3>
            <div>
                <button type="button" class="btn btn-purple" data-bs-toggle="modal" data-bs-target="#addHospital"  onclick="setDefaultValuesAndShowModal()">
                    Add Hospital +
                </button>
            </div>
          </div>
        <!--card body starts -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle py-3 text-center" id="hospital_table" style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true" data-ordering="false" data-info="false">
                    <thead>
                        <tr>
                            <th class="text-start">Hospital Name</th>
                            <th class="text-center">Ward Number</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-capitalize">
                        @foreach ($hospitals as $hospital)

                        <tr>
                            <td class="text-start">{{ $hospital->name }}</td>
                            <td>
                                @foreach ($hospital->wards as $ward)
                                @if ($loop->last)
                                {{$ward->ward}}
                                @else
                                {{$ward->ward}}     ,
                                @endif


                                @endforeach


                            </td>
                            <td class="">
                                <a class="btn btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#addHospital" data-operation="edit" data-hospital-id="{{ $hospital->id }}">
                                    <span class=" fa fa-pen"></span>
                                </a>

                                <a class="btn btn-sm delete-btn" data-hospital-id="{{ $hospital->id }}">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!--card body ends -->
      </div>
      <!-- card ends -->
        <!-- Modal -->
        <!-- ... (your existing code) ... -->

<!-- Modal -->
    <div class="modal fade" id="addHospital" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header border border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3 class="text-purple text-center mb-4 mt-0" id="itemh">Add Hospital</h3>
                    <form id="addHospitalForm" action="{{ route('hospital.store') }}" method="post">
                        @csrf
                        <input id="personal_method" type="hidden" name="_method" value="">

                        <div class="row">
                            <!-- col start -->
                            <div class="col-12 mb-3">
                                <label class="fw-bold mb-1">Hospital Name:</label>
                                <input type="text" class="form-control" name="name" id="hospitaldata" value="" required />
                            </div>
                            <!--begin repeater-->
                            <div id="wardhospital">
                            <div class="repeater">
                                <!--begin repeater list-->
                                <div data-repeater-list="wards" id="">
                                    <!--begin repeater item-->
                                    <div data-repeater-item>
                                        <!--begin::Input group-->
                                        <div class="row justify-content-center align-items-center">
                                            <!-- col start -->
                                            <div class="col-md-9 mb-3">
                                                <label class="fw-bold mb-1">Ward:</label>
                                                <input type="text" class="form-control wardNumber" name="wards" required />
                                            </div>
                                            <!-- col start -->
                                            <div class="col-md-3 mb-3">
                                                <label class="fw-bold mb-1 text-white">Action:</label>
                                                <input class="btn btn-sm btn-danger form-control" data-repeater-delete type="button" value="Delete"/>
                                            </div>
                                        </div>
                                        <!--end Input group-->
                                    </div>
                                    <!--end repeater item-->
                                </div>
                                <!--end repeater list-->
                                <input class="btn btn-purple px-4" data-repeater-create type="button" value="Add"/>
                            </div>
                        </div>
                            <!--end repeater-->
                        </div>
                        <div class="mt-3 mb-5 text-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-purple" value="Save" id="save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
         $("#alert1")
            .fadeTo(2000, 2000)
            .slideUp(500, function() {
                $("#alert1").slideUp(500);
            });
        $(document).ready(function() {
        var table = $('#hospital_table').DataTable( {
            lengthChange: false,
            buttons: [
                {
                    extend: 'collection',
                    text: 'Export',
                    buttons: [
                        'pdf',
                        'excel'
                    ]
                }
            ],
            language: {
            searchPlaceholder: "Search"
        }
        } );

        table.buttons().container()
            .appendTo( ' .col-md-6:eq(0)' );
    } );
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js" integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
       $('.repeater').repeater({
        });


      //  $(document).ready(function () {
        $('.delete-btn').on('click', function () {
            var row = $(this).closest('tr');

            var hospitalId = $(this).data('hospital-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/hospital/delete/' + hospitalId,
                        success: function (data) {
                            console.log(data);
                            Swal.fire({
                                title: 'Deleted!',
                                text: data.message,
                                icon: 'success',
                                timer: 2000
                            });

                            row.remove();
                        },
                        error: function (error) {
                            console.log('Error:', error);
                        }
                    });
                }
            });
        });


    //$(document).ready(function () {
        $(document).on('click', '.edit-btn', function () {
    var hospitalId = $(this).data('hospital-id');

    $.ajax({
        type: 'GET',
        url: '/hospital/edit/' + hospitalId,
        success: function (data) {
            console.log(data);

            $("#personal_method").val("PUT");
            $('#addHospitalForm').attr('action', '/hospital/update/' + data.hospital.id);
            $('#itemh').text('Edit Hospital');
            $('#save').text('Update');
            $('#hospitaldata').val(data.hospital.name);

            $('#wardhospital').empty();
            var wardInput=  `<div class="repeater"><div data-repeater-list="wards" id="">`;

            data.hospital.wards.forEach(function (ward) {
                 wardInput += '<div data-repeater-item>\
                    <div class="row justify-content-center align-items-center">\
                        <div class="col-md-9 mb-3">\
                            <label class="fw-bold mb-1">Ward:</label>\
                            <input type="text" class="form-control wardNumber" name="wards" value="' + ward.ward + '" required />\
                        </div>\
                        <div class="col-md-3 mb-3">\
                            <label class="fw-bold mb-1 text-white">Action:</label>\
                            <input class="btn btn-sm btn-danger form-control" data-repeater-delete type="button" value="Delete"/>\
                        </div>\
                    </div>\
                </div>';
            });
            wardInput +=`</div>
            <input class="btn btn-purple px-4" data-repeater-create type="button" value="Add"/></div>
            `;
            $('#wardhospital').append(wardInput);
            $('.repeater').repeater({
        });

        },
        error: function (error) {
            console.log('Error:', error);
        }
    });
});

function setDefaultValuesAndShowModal() {
        $("#personal_method").val("");
        $('#addHospitalForm').attr('action', '{{ route("hospital.store") }}');
        $('#itemh').text('Add Hospital');
        $('#save').text('Save');

        $('#hospitaldata').val("");
        $('.repeater .row').not(':first').remove();

        $('#addHospital').modal('show');
    }
    </script>


    @endsection

