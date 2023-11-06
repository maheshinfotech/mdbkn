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
        <a href="/bookings" class="btn btn-lg btn-purple "> <i class="fa fa-arrow-left"></i> Back</a>

            <div class="card my-3">
                <div class="card-header bg-light">
                    <h3 class="text-purple fw-bold mb-0">Edit Booking Details</h3>
                </div>
                <!--card body starts -->
                <div class="card-body">
                    <!--form starts -->
                    <form action="/bookings/update/{{$editbooking->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Input group -->
                        <div class="row my-4 justify-content-center ">

                            <div class="col-lg-3 col-12 text-center">
                                <label class=" fs-7 fw-bold mb-1 me-4">
                                    <input type="radio" class="toggle-user-type patient"
                                    @if ($editbooking->patient_type=="non-cancer")
                                    checked
                                    @endif
                                    name="patient"
                                        value="non-cancer">
                                    Non Cancer Patient
                                </label>
                                <label class=" fs-7 fw-bold mb-1">
                                    <input type="radio" class="toggle-user-type patient" name="patient"
                                    @if ($editbooking->patient_type=="cancer")
                                    checked
                                    @endif      value="cancer">
                                    Cancer Patient
                                </label>
                            </div>

                            <div class="col-1 text-center">
                                <div class="vr" style="opacity:0.5"></div>
                            </div>

                            <div class="col-lg-3 col-12 text-center">
                                <label class=" fs-7 fw-bold mb-1 me-4">
                                    <input type="radio" class="toggle-user-type is_admit"  name="is_admit"
                                    @if ($editbooking->is_admitted=="1")
                                    checked
                                    @endif  value="1">
                                    Admitted
                                </label>
                                <label class=" fs-7 fw-bold mb-1">
                                    <input type="radio" class="toggle-user-type is_admit"
                                    @if ($editbooking->is_admitted=="0")
                                    checked
                                    @endif
                                     name="is_admit"
                                        value="0">
                                    Non-Admitted
                                </label>
                            </div>
                            <div class="col-1 text-center">
                                <div class="vr" style="opacity:0.5"></div>
                            </div>
                            <div class="col-lg-3 col-12 text-center">
                                <label class=" fs-7 fw-bold mb-1  me-3 cancer-purpose ">
                                    <input type="radio" name="ward"  value="ct" class="ward"  @if ($editbooking->ward_type=="ct")
                                    checked
                                    @endif>
                                    CT
                                </label>
                                <label class=" fs-7 fw-bold mb-1  me-3 cancer-purpose">
                                    <input type="radio" name="ward"  value="rt" class="ward"
                                    @if ($editbooking->ward_type=="rt")
                                    checked
                                    @endif>
                                    RT
                                </label>
                                <label class=" fs-7 fw-bold mb-1 me-3">
                                    <input type="radio" name="ward"  value="report" class="ward"
                                    @if ($editbooking->ward_type=="report")
                                    checked
                                    @endif>
                                    Tests
                                </label>
                                <label class=" fs-7 fw-bold mb-1">
                                    <input type="radio" name="ward"  value="other" class="ward"
                                    @if ($editbooking->ward_type=="other")
                                    checked
                                    @endif>
                                    Other
                                </label>
                            </div>

                        </div>

                        <hr>

                        <div class="row mb-4 align-items-center">

                            <!-- col 0 starts  -->

                            <div class="col-lg-3 col-12">
                                <label class="fs-7 fw-bold mb-1">Check-in Time<span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" name="checkin" value="{{$editbooking->getRawOriginal('check_in_time') ?? now()->format('Y-m-d\TH:i') }}" required />
                            </div>

                            <!-- col 0 ends  -->

                            <!-- col 1 starts  -->
                            <div class="col-lg-3 col-12">
                                <label class=" fs-7 fw-bold mb-1 ">Choose Category<span class="text-danger">*</span></label>
                                <select id="categoryedit" class="form-select" name="category" required
                                    onchange="select_categoryEdit({{$editbooking->id}})">
                                    <option value="" disabled selected>Category...</option>
                                    @foreach ($category as $cat)
                                        <option @if ($editbooking->room->category_id==$cat->id)
                                       selected  @endif value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <!-- col 1 ends-->

                            <!-- col 2 starts  -->
                            <div class="col-lg-3 col-12">
                                <label class=" fs-7 fw-bold mb-1 ">Choose Room<span class="text-danger">*</span></label>
                                <input type="hidden" name="edit_roomno" value="{{$editbooking->room_id}}">

                                <select id="roomedit" class="form-select" name="room" required>
                                    @foreach ($rooms as $room)
                                    <option @if ($editbooking->room_id==$room['id'])
                                    selected
                                    @endif value="{{$room['id'] }}"  >{{$room['room_number']}}</option>
                                    @endforeach
                                 </select>
                            </div>
                            <!-- col 2 ends-->

                            {{-- <div class="col-md-3 ">
                                <label class="fw-bold mb-1">Advance Payment:</label>
                                <input type="number" class="form-control" id="advance" name="advance" value="1000" />
                            </div> --}}
                              <!-- col start -->
                              <div class="col-md-3">
                                <label class=" fw-bold mb-1">Mobile No<span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="mobile" id="mobile" value="{{$editbooking->mobile_number}}"
                                    pattern="[6-9]{1}[0-9]{9}" maxLength="10"
                                    onkeyup="this.value = this.value.replace(/[^0-9-]/g, '');" required />
                            </div>
                        </div>

                        <div class="row mb-4">

                            <!-- col start -->
                            <div class="col-md-3 ">
                                <label class=" fw-bold mb-1 ">Guest Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="guest_name" id="name" value="{{$editbooking->guest_name}}" required />
                            </div>

                            <!-- col start -->
                            <div class="col-md-3 ">
                                <label class="fw-bold mb-1 ">Guest Father Name:</label>
                                <input type="text" class="form-control" name="guest_father" id="guest_father" value="{{$editbooking->guest_father_name}}"/>
                            </div>
                            <!-- col start -->
                            <div class="col-md-3 ">
                                <label class="d-flex align-items-center fw-bold mb-1"> Guest
                                    Gender:</label>
                                <select class="form-select" name="gender" id="gender">
                                    <option value="" selected>Choose..</option>
                                    <option @if($editbooking->gender=="male") selected @endif value="male">Male</option>
                                    <option @if($editbooking->gender=="female") selected @endif value="female">Female</option>
                                    <option @if($editbooking->gender=="other") selected @endif value="other">Other</option>
                                </select>
                            </div>
                            <!-- col start -->
                            <div class="col-md-3 ">
                                <label class="d-flex align-items-center fw-bold mb-1"> Guest Caste<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="caste" value="{{$editbooking->guest_cast}}" id="caste" />
                            </div>

                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-4">
                            <!-- col start -->
                            <div class="col-md-2">
                                <label class=" fw-bold mb-1 ">Age:</label>
                                <input type="number" class="form-control" name="age" value="{{$editbooking->age}}" id="age" />
                            </div>

                            <!-- col start -->
                            <div class="col-md-2">
                                <label class=" fw-bold mb-1">State<span class="text-danger">*</span></label>
                               <input type="hidden" name="editstate" value="{{$editbooking->state}}" id="editstate">
                                <select class="form-select" name="state" required id="state" >

                                </select>
                                {{-- <input type="text" class="form-control" name="state" id="state" required /> --}}
                            </div>
                            <!-- col start -->
                            <div class="col-md-2">
                                <label class=" fw-bold mb-1 ">City:</label>
                               <input type="hidden" name="editcity" value="{{$editbooking->city}}" id="editcity">
                                <select class="form-select" name="city" id="city">

                                </select>
                            </div>
                            <!-- col start -->
                            <div class="col-md-2">
                                <label class="fw-bold mb-1">Tehsil:</label>
                                <input type="text" class="form-control" id="tehsil" name="tehsil" value="{{$editbooking->tehsil}}" />
                            </div>
                            <!-- col start -->
                            <div class="col-md-2">
                                <label class="d-flex align-items-center fw-bold mb-1"> Guest Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="guest_address" name="guest_address" value="{{$editbooking->guest_address}}"/>
                            </div>
                              <!-- col start -->
                              <div class="col-md-2 ">
                                <label class="fw-bold mb-1">Relation (Patient)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="relation" name="relation" value="{{$editbooking->relation_patient}}" required/>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-4">
                            <div class="col-md-12 ">
                                <label class="fw-bold mb-1">(Guest)ID-Proof<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="idproof" name="idproof"
                                @if ($editbooking->id_number)
                                @else
                                required
                                @endif
                                 />
                                <a target="_blank" href="" id="showpreviousid">
                                    <img src="" id="id_numberphoto" style="height:50px;width:80px; display:none">
                                </a>
                            </div>
                        </div>

                        <div class="row mb-4">

                           @if ($editbooking->id_number)
                           <img src="{{ asset('').'storage/'.$editbooking->id_number }}" alt="" style="width: 80px;height:40px;">

                           @endif

                        </div>

                        <div class="row mb-4">

                            <!-- col start -->
                            <div class="col-md-2 ">
                                <label class=" fw-bold mb-1 ">Patient Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="patient_name" required id="patient_name"
                             value="{{$editbooking->patient_name}}"   required />
                            </div>
                            <!-- col start -->
                            <div class="col-md-2 ">
                                <label class="fw-bold mb-1 ">Hospital (Department)<span class="text-danger">*</span></label>
                                <select class="form-select" name="hospital_id" id="hospitalname" required>
                                    <option value="">choose..</option>
                                    @foreach (\DB::table('hospitals')->get() as $hosname)
                                        <option @if($editbooking->hospital_id == $hosname->id) selected @endif value="{{ $hosname->id }}">{{ $hosname->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- col start -->
                            <div class="col-md-2 ">
                                <label class=" fw-bold mb-1 ">Patient Ward No:</label>
                                <input type="text" class="form-control" name="ward_no" value="{{$editbooking->patient_ward_no}}" id="wardno"  />
                            </div>
                            <!-- col start -->
                            <div class="col-md-2 pbmroomno" style="display:none">
                                <label class=" fw-bold mb-1 ">Patient Room No:</label>
                                <input type="text" class="form-control" name="pbm_room_no" id="pbm_room_no"  value="{{$editbooking->pbm_room_no}}"/>
                            </div>
                            <!-- col start -->
                            <div class="col-md-2 ">
                                <label class=" fw-bold mb-1 ">Patient Bed No:</label>
                                <input type="text" class="form-control" name="bedno" id="bedno"  value="{{$editbooking->patient_bed_no}}"/>
                            </div>

                            <!-- col start -->
                            <div class="col-md-2 mb-3">

                                <label class="fw-bold mb-1 ">Doctor Name:</label>
                                <input type="text" class="form-control" name="doctor" id="doctor" value="{{$editbooking->docter_name}}"/>
                            </div>

                        </div>
                        <div class="row mb-4">
                            <!-- col start -->
                            <div class="col-md-12 ">

                                <label class="fw-bold ">Extra Remark:</label>

                                <textarea name="remark" id="" class="form-control h-auto" rows="4">{{$editbooking->extra_remark}}</textarea>

                            </div>
                        </div>
                        <h3 class="text-center text-purple fw-bold">Advance Payment Details:</h3>
                        @foreach ($editbooking->advance as $adva)
                        <div class="row mb-4 justify-content-center">
                            <div class="col-md-4">
                                <label class="fw-bold ">Amount:</label>
                                <input type="number" class="form-control" id="advance" name="advance[]" value="{{$adva->amount}}" />
                            </div>
                            <div class="col-md-4">
                                <label class="fw-bold ">Recieved Date:</label>
                                <input type="date" class="form-control" id="" name="recieved_date[]" value="{{$adva->received_date}}" />
                            </div>
                        </div>
                        @endforeach

                        <!--end::Input group-->

                        <!--begin repeater-->
                        <div class="repeater mt-4">
                            <!--heading start-->
                            <div class="card-header d-flex justify-content-between align-items-center p-2">
                                <h3 class="text-purple fw-bold mb-0">Add Other Guest</h3>
                                <div>
                                    <input class="btn btn-purple px-4" data-repeater-create type="button"
                                        value="Add" />
                                </div>
                            </div>
                            <!--heading end-->
                            @if (count($editbooking->bookinglogs))
                            @foreach ($editbooking->bookinglogs as $logs)
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
                                             value="{{$logs->guest_name}}"   id="" />
                                        </div>
                                        <!-- col start -->
                                        <div class="col-md-2 mb-3">
                                            <label class=" fw-bold mb-1 ">Guest Age:</label>
                                            <input type="number" class="form-control" name="guestage"  value="{{$logs->guest_age}}" id="" />
                                        </div>
                                        <!-- col start -->
                                        <div class="col-md-2 mb-3">
                                            <label class=" fw-bold mb-1 ">Guest Relation:</label>
                                            <input type="text" class="form-control" name="guestrelation" value="{{$logs->guest_relation}}"
                                                id="" />
                                        </div>
                                        <!-- col start -->
                                        <div class="col-md-2 mb-3">
                                            <label class="fw-bold mb-1 ">Guest Remarks:</label>
                                            <input type="text" class="form-control" name="guestremarks" value="{{$logs->guest_remarks}}"
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
                            @endforeach
                            @else
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
                            @endif


                        </div>
                        {{-- <div class="col-md-4 mb-3">
                            <label class="fw-bold mb-1">Extra Remark:</label>
                            <textarea name="remark" id="" class="form-control" rows="1"></textarea>
                        </div> --}}

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-purple btn-lg">Update Booking</button>
                        </div>

                </div>
                <!--end::Input group-->

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
        function select_categoryEdit(id) {
            var cate_id = $('#categoryedit').val();
            var  pre_room =$('input[name=edit_roomno]').val();
            // console.log(pre_room);
            $.ajax({
                url: '/bookings/edit/'+id,
                data: {
                    cate_id: cate_id
                },
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var html = `<option value="" selected>Rooms...</option>`;
                    //  console.log(response);
                    $('#roomedit').html('');

                    for (let i = 0; i < response.length; i++) {

                        if (response[i].id==pre_room) {
                            html += `<option value="${response[i].id}"  selected  > ${response[i].room_number}</option>`;
                        }else{
                            html += `<option value="${response[i].id}"> ${response[i].room_number}</option>`;

                        }
                    }
                    $('#roomedit').html(html);
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



        // =====================state city dropdown api=========================
        var auth_token;

        function dropdown_state() {
            $.ajax({
                type: "GET",
                url: "https://www.universal-tutorial.com/api/getaccesstoken",
                success: function(data) {
                    auth_token = data.auth_token;
                    get_state(data.auth_token);
                },
                headers: {
                    Accept: "application/json",
                    "api-token": "D-FpCSCxWG7D2BjTHw7fu6AG4NJLVdTsPy-quvPKpXt-hfNo8xwOvacZauakrYwsGvY",
                    "user-email": "monikabothra1996@gmail.com",
                },
            });
            $("#state").change(function() {
                get_city(false);
            });
        }

        dropdown_state();

        function get_state(auth_token) {
            var country_name = "India";
            var state_namepre = $('input[name="editstate"]').val();
            $.ajax({
                type: "GET",
                url: "https://www.universal-tutorial.com/api/states/" + country_name,
                success: function(data) {
                    $("#state").empty();
                    var html = `<option value="">choose..</option>`;
                    data.forEach((element) => {
                        if (state_namepre==element.state_name) {
                            html += '<option value="' +
                            element.state_name +
                            '" selected >' +
                            element.state_name +
                            "</option>";
                        }else{
                            html += '<option value="' +
                            element.state_name +
                            '">' +
                            element.state_name +
                            "</option>";
                        }


                    });
                    $("#state").append(html);
                    // for edit ==========
                    var precity = $('input[name="editcity"]').val();
                    get_city(precity)
                    // ===================
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
            // var precity = $('input[name="editcity"]').val();
            // if (precity!='') {
            //             $("#city").val(precity);
            //             return;
            //         }
            $.ajax({
                type: "GET",
                url: "https://www.universal-tutorial.com/api/cities/" + state_name,
                success: function(data) {
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

            // =============== get prefilled details on mobile no. =================
        //     $('#mobile').on('keyup', function() {
        //     var numb = $('#mobile').val();
        //     var sizeofno = $('#mobile').val().length;
        //     // console.log(sizeofno);
        //     if (sizeofno == 10) {
        //         $.ajax({
        //             url: '/getguestpreviousdetails',
        //             data: {
        //                 numb: numb
        //             },
        //             type: 'get',
        //             success: function(data) {
        //                 // console.log(data.guestpredetail);
        //                 var resp = data.guestpredetail;
        //                 if (resp) {
        //                     $('#name').val(resp.guest_name);id_numberphoto
        //                     $('#guest_father').val(resp.guest_father_name);
        //                     $('#caste').val(resp.guest_cast);
        //                     $('#age').val(resp.age);
        //                     $('#guest_address').val(resp.guest_address);
        //                     $('#tehsil').val(resp.tehsil);
        //                     // $('#city').val(resp.city);
        //                     $('#state').val(resp.state);
        //                         get_city(resp.city);
        //                     if (resp.id_number) {
        //                         document.getElementById("id_numberphoto").style.display = 'block';
        //                         var img = '/storage/' + resp.id_number;
        //                         $("#id_numberphoto").attr('src', img);
        //                         $('#idproof').removeAttr("required");
        //                     } else {
        //                         document.getElementById("id_numberphoto").style.display = 'none';
        //                         $('#idproof').attr("required","required");
        //                     }
        //                     $('#showpreviousid').attr('href', img);
        //                     $("#imageidprf").val(resp.id);
        //                     $("#patient_name").val(resp.patient_name);
        //                     $("#hospitalname").val(resp.hospital_id);
        //                     $("#relation").val(resp.relation_patient);
        //                     $("#wardno").val(resp.patient_ward_no);
        //                     $("#doctor").val(resp.docter_name);

        //                 } else {
        //                     $('#name').val('');
        //                     $('#guest_father').val('');
        //                     $('#caste').val('');
        //                     $('#age').val('');
        //                     $('#guest_address').val('');
        //                     $('#tehsil').val('');
        //                     $('#city').val('');
        //                     $('#state').val('');
        //                     document.getElementById("id_numberphoto").style.display = 'none';
        //                     $("#id_numberphoto").attr('src', '');
        //                     $('#showpreviousid').attr('href', '');
        //                     $("#imageidprf").val('');
        //                     $('#idproof').attr("required","required");
        //                     $("#patient_name").val('');
        //                     $("#hospitalname").val('');
        //                     $("#relation").val('');
        //                     $("#wardno").val('');
        //                     $("#doctor").val('');
        //                 }

        //                 // idproof
        //             }
        //         })
        //     }

        // })
        // ==============================
    </script>
@endsection
