@php
    $pageName = 'booking';
    // $tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
    // $tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];
@endphp

@extends('layouts.backend')

@section('content')
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
                <h3 class="text-purple fw-bold">Room Category</h3>
                <div>
                    <button type="button" class="btn btn-purple" data-bs-toggle="modal" data-bs-target="#categoryModal">
                        Add Category +
                    </button>
                </div>
            </div>
            <!--card body starts -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle py-3 text-center" id="category_table"
                        style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true"
                        data-ordering="false" data-info="false">
                        <thead>
                            <tr>
                                {{-- <th class="text-start">Room Number</th> --}}
                                <th class="text-center">Category Name</th>
                                <th class="text-center">Facility</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Normal Rent</th>
                                <th class="text-center">Patient Rent</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @foreach ($categories as $category)
                                <tr>
                                    {{-- <td class="text-start"> number</td> --}}
                                    <td> {{ $category->name }}</td>
                                    <td>{{ $category->facility }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->normal_rent }}</td>
                                    <td>{{ $category->patient_rent }}</td>
                                    {{-- <td class="text-end">
                                        <x-reusables.action-buttons :id="$category->id" module="category" :name="$category->name" />
                                    </td> --}}
                                    <td class="text-end">
                                        <a class="btn btn-sm" onclick="edit_category({{ $category->id }})"
                                            data-bs-toggle="modal" data-bs-target="#categoryModal">
                                            <span class=" fa fa-pen"></span>
                                        </a>
                                        <a class="btn btn-sm delete-record" data-id="{{ $category->id }}"
                                            data-module="category" data-name="{{ $category->name }}">
                                            <span class=" fa fa-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- <tr>
                                <td class="text-start"> number</td>
                                <td> Name</td>
                                <td>facility</td>
                                <td>this is demo description</td>
                                <td>1000</td>
                                <td>500</td>
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
                                <td class="text-start"> number</td>
                                <td> Name</td>
                                <td>facility</td>
                                <td>this is demo description</td>
                                <td>1000</td>
                                <td>500</td>
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
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header border border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3 class="text-purple text-center mb-3 mt-0" id="category_form_heading">Add Room Category</h3>
                        <form action="/category" method="post" id="category_form">
                            <input type="hidden" name="_method" value="" id="category_method">
                            @csrf
                            <div class="row">
                                <!-- col start -->
                                <div class="col-12 mb-3">
                                    <label class=" fw-bold mb-1 ">Name:</label>
                                    <input type="text" class="form-control" name="name" id="name" required />
                                </div>
                                <!-- col start -->
                                <div class="col-12 mb-3">
                                    <label class=" fw-bold mb-1 ">Facility:</label>
                                    <input type="text" class="form-control" name="facility" id="facility" required />
                                </div>
                                <!-- col start -->
                                <div class="col-12 mb-3">
                                    <label class=" fw-bold mb-1 ">Description:</label>
                                    <input type="text" class="form-control" name="description" id="description"
                                        required />
                                </div>
                                <!-- col start -->
                                <div class="col-12 mb-3">
                                    <label class=" fw-bold mb-1 ">Normal Rent:</label>
                                    <input type="text" class="form-control" name="normalrent" id="normalrent" required />
                                </div>
                                <!-- col start -->
                                <div class="col-12 mb-3">
                                    <label class=" fw-bold mb-1 ">Patient Rent:</label>
                                    <input type="text" class="form-control" name="patientrent" id="patientrent"
                                        required />
                                </div>
                            </div>
                    </div>
                    <div class="mt-3 mb-5 text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-purple" id="category_form_button">Save</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>




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
