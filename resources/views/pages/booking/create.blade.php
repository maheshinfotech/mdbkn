@php
    $pageName = 'booking';
    // $tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
    // $tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];
@endphp
@extends('layouts.backend')
@section('content')
    <x-reusables.app-header pageName="{{ $pageName }}" />
    @if (Session::has('message'))
        <div class="alert alert-success w-25 text-center  mx-auto" role="alert" id="alert1"> {{ Session::get('message') }}
        </div>
    @endif
    <div class="content  mx-0 w-100">
        <div class="container-fluid px-0">
            <!-- card starts -->
            <div class="card">
                <div class="card-header bg-light">
                    <h3 class="text-purple fw-bold mb-0">Add Bookings</h3>
                </div>
                <!--card body starts -->
                <div class="card-body">
                    <!--form starts -->
                    <form action="/bookings" method="post" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Input group -->
                        <div class="row my-4 justify-content-center ">

                            <div class="col-lg-3 col-12 text-center">
                                <label class=" fs-7 fw-bold mb-1 mr-4">
                                    <input type="radio" class="toggle-user-type patient"  name="patient" value="non-cancer">
                                    Non Cancer Patient
                                </label>
                                <label class=" fs-7 fw-bold mb-1 mr-4">
                                    <input type="radio" class="toggle-user-type patient" name="patient" value="cancer">
                                    Cancer Patient
                                </label>
                            </div>
                            <div class="col-1 text-center" >
                                <div class="vr" style="opacity:0.5"></div>
                            </div>
                            
                            <div class="col-lg-3 col-12 text-center">
                                <label class=" fs-7 fw-bold mb-1 mr-4">
                                    <input type="radio" class="toggle-user-type is_admit" name="is_admit" value="1">
                                    Admitted
                                </label>
                                <label class=" fs-7 fw-bold mb-1 mr-4">
                                    <input type="radio" class="toggle-user-type is_admit" name="is_admit" value="0">
                                    Non-Admitted
                                </label>
                            </div>
                            <div class="col-1 text-center" >
                                <div class="vr" style="opacity:0.5"></div>
                            </div>
                            <div class="col-lg-3 col-12 text-center">
                                <label class=" fs-7 fw-bold mb-1  mr-4 cancer-purpose ">
                                    <input type="radio" name="ward" value="ct" class="ward">
                                    CT
                                </label>
                                <label class=" fs-7 fw-bold mb-1  mr-4 cancer-purpose">
                                    <input type="radio" name="ward" value="rt" class="ward">
                                    RT
                                </label>
                                <label class=" fs-7 fw-bold mb-1 mr-4">
                                    <input type="radio"  name="ward" value="report" class="ward">
                                    Tests
                                </label>
                                <label class=" fs-7 fw-bold mb-1 mr-4">
                                    <input type="radio"  name="ward" value="other" class="ward">
                                    Other
                                </label>
                            </div>

                        </div>
                        <div class="row mb-4 justify-content-center align-items-center">
                            <!-- col 1 starts  -->
                            <div class="col-lg-6 col-12">
                                <label class=" fs-7 fw-bold mb-1 ">Choose Category:</label>
                                <select id="category" class="form-select" name="category" required
                                    onchange="select_category()">
                                    <option value="" disabled selected>Category...</option>
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <!-- col 1 ends-->
                            <!-- col 2 starts  -->
                            <div class="col-lg-6 col-12">
                                <label class=" fs-7 fw-bold mb-1 ">Choose Room:</label>
                                <select id="room" class="form-select" name="room" required>
                                    <option value="" disabled selected>Rooms...</option>
                        <!--card body starts -->
                        <div class="card-body">
                            <!--form starts -->
                            <form action="/bookings" method="post" enctype="multipart/form-data">
                                @csrf
                                <!--begin::Input group -->
                                <div class="row mb-4 justify-content-center align-items-center">
                                    <!-- col 1 starts  -->
                                    <div class="col-lg-6 col-12">
                                        <label class=" fs-7 fw-bold mb-1 ">Choose Category:</label>
                                        <select id="category" class="form-select" name="category" required onchange="select_category()">
                                                <option value="" disabled selected>Category...</option>
                                            @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- col 1 ends-->
                                    <!-- col 2 starts  -->
                                    <div class="col-lg-6 col-12">
                                        <label class=" fs-7 fw-bold mb-1 ">Choose Room:</label>
                                        <select id="room"  class="form-select" name="room" required>
                                            <option value="" disabled selected>Rooms...</option>

                                </select>
                            </div>
                            <!-- col 2 ends-->
                        </div>
                        <!--end::Input group-->
                        <hr>

                                <!--begin::Input group-->
                                <div class="row">
                                     <!-- col start -->
                                     <div class="col-md-2 mb-3">
                                        <label class=" fw-bold mb-1">Mobile No:</label>
                                        <input type="tel" class="form-control" name="mobile" id="mobile"  pattern="[6-9]{1}[0-9]{9}" maxLength="10"  onkeyup="this.value = this.value.replace(/[^0-9-]/g, '');" required />
                                    </div>
                                    <!-- col start -->
                                    <div class="col-md-2 mb-3">
                                        <label class=" fw-bold mb-1 ">Guest Name:</label>
                                        <input type="text" class="form-control" name="guest_name" id="name"  required/>
                                    </div>
                                    <!-- col start -->
                                    <div class="col-md-2 mb-3">
                                        <label class="fw-bold mb-1">Relation (Patient):</label>
                                        <input type="text" class="form-control" id="relation" name="relation" />
                                    </div>
                                    <!-- col start -->
                                    <div class="col-md-2 mb-3">
                                        <label class="fw-bold mb-1 ">Guest Father Name:</label>
                                        <input type="text" class="form-control" name="guest_father" id="guest_father" />
                                    </div>
                                    <!-- col start -->
                                    <div class="col-md-2 mb-3">
                                        <label class="d-flex align-items-center fw-bold mb-1"> Guest Caste:</label>
                                        <input type="text" class="form-control" name="caste" id="caste" />
                                    </div>
                                     <!-- col start -->
                                     <div class="col-md-2 mb-3">
                                        <label class="d-flex align-items-center fw-bold mb-1"> Guest Gender:</label>
                                        <select class="form-select" name="gender" id="gender">
                                            <option value="" selected>Choose..</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row">
                                     <!-- col start -->
                                     <div class="col-md-2 mb-3">
                                        <label class=" fw-bold mb-1 ">Age:</label>
                                        <input type="number" class="form-control" name="age" id="age" />
                                    </div>
                                    <!-- col start -->
                                    <div class="col-md-3 mb-3">
                                        <label class="d-flex align-items-center fw-bold mb-1"> Guest Address:</label>
                                        <input type="text" class="form-control" id="guest_address"
                                            name="guest_address" />
                                    </div>
                                     <!-- col start -->
                                     <div class="col-md-2 mb-3">
                                        <label class=" fw-bold mb-1">State:</label>
                                        <select class="form-select" name="state" id="state">

                                        </select>
                                        {{-- <input type="text" class="form-control" name="state" id="state" required /> --}}
                                    </div>
                                     <!-- col start -->
                                     <div class="col-md-2 mb-3">
                                        <label class=" fw-bold mb-1 ">City:</label>
                                        {{-- <input type="text" class="form-control" name="city" id="city" /> --}}
                                        <select class="form-select" name="city" id="city">

                                        </select>
                                    </div>
                                     <!-- col start -->
                                     <div class="col-md-3 mb-3">
                                        <label class="fw-bold mb-1">Tehsil:</label>
                                        <input type="text" class="form-control" id="tehsil" name="tehsil" />
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row justify-content-center">


                                           <!-- col start -->
                                        <input type="hidden" name="imageidprf" id="imageidprf" value="">
                                    <div class="col-md-2 mb-3">
                                        <label class="fw-bold mb-1">(Guest)ID-Proof:</label>
                                        <input type="file" class="form-control" id="idproof" name="idproof" />
                                        <a target="_blank" href="" id="showpreviousid">
                                            <img src="" id="id_numberphoto" style="height:50px;width:80px; display:none">
                                        </a>
                                    </div>
                                       <!-- col start -->
                                       <div class="col-md-2 mb-3">
                                        <label class="fw-bold mb-1">Parking Provided:</label>
                                        <select id="" class="form-select" name="parking" id="parking">
                                            <option value="1">Yes</option>
                                            <option value="2" selected>No</option>
                                        </select>
                                    </div>
                                    <!-- col start -->

                                    <div class="col-md-2 mb-3">
                                        <label class="fw-bold mb-1">Advance Payment:</label>
                                        <input type="number" class="form-control" id="advance" name="advance" value="1000"/>
                                    </div>
                                    <!-- col start -->
                                    <div class="col-md-2 mb-3">
                                        <label class="fw-bold mb-1 ">Hospital (Department):</label>
                                        <select class="form-select" name="hospital_id" id="">
                                            <option value="">choose..</option>
                                           @foreach (\DB::table('hospitals')->get() as $hosname)
                                               <option value="{{$hosname->id}}">{{$hosname->name}}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                     <!-- col start -->
                                     <div class="col-md-2 mb-3">
                                        <label class=" fw-bold mb-1 ">Patient Name:</label>
                                        <input type="text" class="form-control" name="patient_name" id="patient_name" required />
                                    </div>
                                    <!-- col start -->
                                    <div class="col-md-2 mb-3">
                                        <label class=" fw-bold mb-1 ">Patient Ward No:</label>
                                        <input type="text" class="form-control" name="wardno" id="wardno" required />
                                    </div>
                                     <!-- col start -->
                                     <div class="col-md-2 mb-3">
                                        <label class=" fw-bold mb-1 ">Patient Bed No:</label>
                                        <input type="text" class="form-control" name="bedno" id="bedno" required />
                                    </div>
                                    <!-- col start -->
                                    <div class="col-md-2 mb-3">
                                        <label class="fw-bold mb-1">Ward-Type (Ct/Rt):</label>
                                        <select id="wardtype" class="form-select" name="wardtype" required>
                                            <option value="" selected>Choose...</option>
                                            <option value="ct">Ct</option>
                                            <option value="rt">Rt</option>
                                            <option value="cancer">Cancer</option>
                                            <option value="report">Report</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <!-- col start -->
                                    <div class="col-md-2 mb-3">
                                        <label class="fw-bold mb-1 ">Doctor Name:</label>
                                        <input type="text" class="form-control" name="doctor" id="doctor" />
                                    </div>
                                    @php
                                         $curr_date  =  date('Y-m-d H:i');
                                    @endphp
                                    <!-- col start -->
                                    <div class="col-md-3 mb-3">
                                        <label class="fw-bold mb-1 ">Check-In Time:</label>
                                        <input type="datetime-local" class="form-control" value="{{$curr_date}}" name="checkin" id="checkin" required />
                                    </div>
                                    <!-- col start -->
                                    <div class="col-md-3 mb-3">
                                        <label class="fw-bold mb-1">Extra Remark:</label>
                                        <textarea name="remark" id="" class="form-control" rows="1"></textarea>
                                    </div>
                                </div>
                                <!--end::Input group-->


                            <!--begin repeater-->
                            <div class="repeater mt-4">
                                <!--heading start-->
                                <div class="card-header d-flex justify-content-between align-items-center p-2">
                                    <h3 class="text-purple fw-bold mb-0">Add Guest</h3>
                                    <div>
                                        <input class="btn btn-purple px-4" data-repeater-create type="button"
                                            value="Add" />
                                    </div>
                                </div>
                                <!--heading end-->
                                <!--begin repeater list-->
                                <div data-repeater-list="guestlists">
                                    <!--begin repeater item-->
                                    <div data-repeater-item>
                                        <!--begin::Input group-->
                                        <div class="row mt-3 justify-content-center align-items-center">
                                            <!-- col start -->
                                            <div class="col-md-2 mb-3">
                                                <label class=" fw-bold mb-1 ">Guest Name:</label>
                                                <input type="text" class="form-control" name="guestname"
                                                    id="" />
                                            </div>
                                            <!-- col start -->
                                            <div class="col-md-2 mb-3">
                                                <label class=" fw-bold mb-1 ">Guest Age:</label>
                                                <input type="number" class="form-control" name="guestage"
                                                    id="" />
                                            </div>
                                            <!-- col start -->
                                            <div class="col-md-2 mb-3">
                                                <label class=" fw-bold mb-1 ">Guest Relation:</label>
                                                <input type="text" class="form-control" name="guestrelation"
                                                    id="" />
                                            </div>
                                            <!-- col start -->
                                            <div class="col-md-2 mb-3">
                                                <label class="fw-bold mb-1 ">Guest Remarks:</label>
                                                <input type="text" class="form-control" name="guestremarks"
                                                    id="" />
                                            </div>
                                            <!-- col start -->
                                            <div class="col-md-1 mb-3">
                                                <label class=" fw-bold mb-1">Action:</label>
                                                <input class="btn btn-sm btn-danger form-control" data-repeater-delete
                                                    type="button" value="Delete" />
                                            </div>
                                        </div>
                                        <!--end Input group-->
                                    </div>
                                    <!--end repeater item-->
                                </div>
                                <!--end repeater list-->
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="fw-bold mb-1">Extra Remark:</label>
                                <textarea name="remark" id="" class="form-control" rows="1"></textarea>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin repeater-->
                        <div class="repeater mt-4">
                            <!--heading start-->
                            <div class="card-header d-flex justify-content-between align-items-center p-2">
                                <h3 class="text-purple fw-bold mb-0">Add Guest</h3>
                                <div>
                                    <input class="btn btn-purple px-4" data-repeater-create type="button"
                                        value="Add" />
                                </div>
                            </div>
                            <!--heading end-->
                            <!--begin repeater list-->
                            <div data-repeater-list="guestlists">
                                <!--begin repeater item-->
                                <div data-repeater-item>
                                    <!--begin::Input group-->
                                    <div class="row mt-3 justify-content-center align-items-center">
                                        <!-- col start -->
                                        <div class="col-md-2 mb-3">
                                            <label class=" fw-bold mb-1 ">Guest Name:</label>
                                            <input type="text" class="form-control" name="guestname"
                                                id="" />
                                        </div>
                                        <!-- col start -->
                                        <div class="col-md-2 mb-3">
                                            <label class=" fw-bold mb-1 ">Guest Age:</label>
                                            <input type="number" class="form-control" name="guestage" id="" />
                                        </div>
                                        <!-- col start -->
                                        <div class="col-md-2 mb-3">
                                            <label class=" fw-bold mb-1 ">Guest Relation:</label>
                                            <input type="text" class="form-control" name="guestrelation"
                                                id="" />
                                        </div>
                                        <!-- col start -->
                                        <div class="col-md-2 mb-3">
                                            <label class="fw-bold mb-1 ">Guest Remarks:</label>
                                            <input type="text" class="form-control" name="guestremarks"
                                                id="" />
                                        </div>
                                        <!-- col start -->
                                        <div class="col-md-1 mb-3">
                                            <label class=" fw-bold mb-1">Action:</label>
                                            <input class="btn btn-sm btn-danger form-control" data-repeater-delete
                                                type="button" value="Delete" />
                                        </div>
                                    </div>
                                    <!--end Input group-->
                                </div>
                                <!--end repeater item-->
                            </div>
                            <!--end repeater list-->
                        </div>
                        <!--end repeater-->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-purple btn-lg">Create Booking</button>
                        </div>
                </div>
                <!--card body ends -->
                </form>
                <!--form ends -->
            </div>
            <!-- card ends -->
        </div>
        <!-- container ends -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
        integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function select_category() {
            var id = $('#category').val();
            $.ajax({
                url: '/bookings/create',
                data: {
                    id: id
                },
                type: 'get',
                success: function(response) {
                    var html = `<option value="" selected>Rooms...</option>`;
                    // console.log(response);
                    $('#room').html('');

                    for (let i = 0; i < response.length; i++) {
                        html += `<option value="${response[i].id}"> ${response[i].room_number}</option>`;
                    }
                    $('#room').html(html);

                }
            });
        }

        $('.repeater').repeater({

        });

        $("#alert1")
            .fadeTo(2000, 2000)
            .slideUp(500, function() {
                $("#alert1").slideUp(500);
            });

        // =============== get prefilled details on mobile no. =================
        $('#mobile').on('keyup', function() {
            var numb = $('#mobile').val();
            var sizeofno = $('#mobile').val().length;
            // console.log(sizeofno);
            if (sizeofno == 10) {
                $.ajax({
                    url: '/getguestpreviousdetails',
                    data: {
                        numb: numb
                    },
                    type: 'get',
                    success: function(data) {
                        // console.log(data.guestpredetail);
                        var resp = data.guestpredetail;
                        if (resp) {
                            $('#name').val(resp.guest_name);
                            $('#guest_father').val(resp.guest_father_name);
                            $('#caste').val(resp.guest_cast);
                            $('#age').val(resp.age);
                            $('#guest_address').val(resp.guest_address);
                            $('#tehsil').val(resp.tehsil);
                            $('#city').val(resp.city);
                            $('#state').val(resp.state);
                            if (resp.id_number) {
                                document.getElementById("id_numberphoto").style.display = 'block';
                                var img = '/storage/' + resp.id_number;
                                $("#id_numberphoto").attr('src', img);
                            } else {
                                document.getElementById("id_numberphoto").style.display = 'none';
                            }
                            $('#showpreviousid').attr('href', img);
                            $("#imageidprf").val(resp.id);

                        } else {
                            $('#name').val('');
                            $('#guest_father').val('');
                            $('#caste').val('');
                            $('#age').val('');
                            $('#guest_address').val('');
                            $('#tehsil').val('');
                            $('#city').val('');
                            $('#state').val('');
                            document.getElementById("id_numberphoto").style.display = 'none';
                            $("#id_numberphoto").attr('src', '');
                            $('#showpreviousid').attr('href', '');
                            $("#imageidprf").val('');
                        }

                        // idproof
                    }
                })
            }

        })
        // ==============================

        // =====================state city dropdown api=========================
        var auth_token;
function dropdown_state() {
    $.ajax({
        type: "GET",
        url: "https://www.universal-tutorial.com/api/getaccesstoken",
        success: function (data) {
            auth_token = data.auth_token;
            get_state(data.auth_token);
        },
        headers: {
            Accept: "application/json",
            "api-token":
                "D-FpCSCxWG7D2BjTHw7fu6AG4NJLVdTsPy-quvPKpXt-hfNo8xwOvacZauakrYwsGvY",
            "user-email": "monikabothra1996@gmail.com",
        },
    });
    $("#state").change(function () {
        get_city(false);
    });
}

dropdown_state();
function get_state(auth_token) {
    var country_name = "India";
    $.ajax({
        type: "GET",
        url: "https://www.universal-tutorial.com/api/states/" + country_name,
        success: function (data) {
            $("#state").empty();
           var html = `<option value="">choose..</option>`;
            data.forEach((element) => {
                html += '<option value="' +
                        element.state_name +
                        '">' +
                        element.state_name +
                        "</option>";

            });
            $("#state").append(html);
        },
        headers: {
            Authorization: "Bearer " + auth_token,
            Accept: "application/json",
        },
    });
}

function get_city(city) {
    var state_name = $("#state").val();
    // console.log(state_name);
    $.ajax({
        type: "GET",
        url: "https://www.universal-tutorial.com/api/cities/" + state_name,
        success: function (data) {
            // $("#city").val('');
            $("#city").empty();
            var unique = [...new Set(data.map((item) => item.city_name))];
            if (city) {
                // console.log("get_city fun",city);
                unique.forEach((element) => {
                    $("#city")
                        .append(
                            '<option value="' +
                                element +
                                '">' +
                                element +
                                "</option>"
                        )
                        .val(city);
                });
            } else {
                unique.forEach((element) => {
                    $("#city").append(
                        '<option value="' +
                            element +
                            '">' +
                            element +
                            "</option>"
                    );
                });
            }
        },
        headers: {
            Authorization: "Bearer " + auth_token,
            Accept: "application/json",
        },
    });
}
// ===================================
    </script>
@endsection
