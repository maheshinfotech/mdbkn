@php
    $pageName = 'booking';
    // $tableHead = ['Full Name', 'Machine Name', 'Reading Number', 'Fuel in Liters'];
    // $tableHeadSecond = ['Full Name', 'Machine Name', 'Working Hours'];
@endphp

@extends('layouts.backend')

@section('content')
    <x-reusables.app-header pageName="{{ $pageName }}" />

    @if (Session::has('message'))
    <div class="alert alert-success w-25 text-center  mx-auto" role="alert" id="alert1"> {{Session::get('message')}}
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
                                <div class="row mb-4 justify-content-center align-items-center">
                                    <!-- col 1 starts  -->
                                    <div class="col-lg-6 col-12">
                                        <label class=" fs-7 fw-bold mb-1 ">Choose Category:</label>
                                        <select id="category" class="form-select" name="category" required onchange="select_category()">
                                            <option   value="" disabled selected>Category...</option>
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
                                    <div class="col-md-3 mb-3">
                                        <label class=" fw-bold mb-1 ">Guest Name:</label>
                                        <input type="text" class="form-control" name="guest_name" id="name"  required/>
                                    </div>
                                    <!-- col start -->
                                    <div class="col-md-3 mb-3">
                                        <label class="fw-bold mb-1">Relation (Patient):</label>
                                        <input type="text" class="form-control" id="relation" name="relation" />
                                    </div>
                                    <!-- col start -->
                                    <div class="col-md-3 mb-3">
                                        <label class="fw-bold mb-1 ">Guest Father Name:</label>
                                        <input type="text" class="form-control" name="guest_father" id="guest_father" />
                                    </div>


                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row">
                                     <!-- col start -->
                                     <div class="col-md-3 mb-3">
                                        <label class=" fw-bold mb-1 ">Patient Name:</label>
                                        <input type="text" class="form-control" name="patient_name" id="patient_name" required />
                                    </div>
                                    <!-- col start -->
                                    <div class="col-md-2 mb-3">
                                        <label class="d-flex align-items-center fw-bold mb-1"> Guest Caste:</label>
                                        <input type="text" class="form-control" name="caste" id="caste" />
                                    </div>
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
                                        <label class="fw-bold mb-1">Tehsil:</label>
                                        <input type="text" class="form-control" id="tehsil" name="tehsil" />
                                    </div>




                                    <!-- col start -->
                                    {{-- <div class="col-md-2 mb-3">
                                        <label class=" fw-bold mb-1">Check-Out Time:</label>
                                        <input type="time" class="form-control" name="checkout" id="checkout" />
                                    </div> --}}
                                    <!-- col start -->
                                    {{-- <div class="col-md-2 mb-3">
                                        <label class="fw-bold mb-1"> Estimated Total Days:</label>
                                        <input type="text" class="form-control" id="estimateddays"
                                            name="estimateddays" />
                                    </div> --}}
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row justify-content-center">
                                     <!-- col start -->
                                     <div class="col-md-2 mb-3">
                                        <label class=" fw-bold mb-1 ">City:</label>
                                        <input type="text" class="form-control" name="city" id="city" />
                                    </div>
                                      <!-- col start -->
                                      <div class="col-md-2 mb-3">
                                        <label class=" fw-bold mb-1">State:</label>
                                        <input type="text" class="form-control" name="state" id="state" required />
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
                                        <label class="fw-bold mb-1 ">Check-In Time:</label>
                                        <input type="time" class="form-control" name="checkin" id="checkin" required />
                                    </div>
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
                                        <label class="fw-bold mb-1 ">Doctor Name:</label>
                                        <input type="text" class="form-control" name="doctor" id="doctor" />
                                    </div>




                                    <!-- col start -->
                                    <div class="col-md-2 mb-3">
                                        <label class="fw-bold mb-1">Ward-Type (Ct/Rt):</label>
                                        <select id="wardtype" class="form-select" name="wardtype" required>
                                            <option value="" selected>Choose...</option>
                                            <option value="ct">Ct</option>
                                            <option value="rt">Rt</option>
                                            <option value="other">Other</option>
                                        </select>
                                        {{-- <input type="text" class="form-control" id="wardtype" name="wardtype" required /> --}}
                                    </div>
                                    <!-- col start -->
                                    {{-- <div class="col-md-2 mb-3">
                                        <label class="fw-bold mb-1">Payable Rent:</label>
                                        <input type="text" class="form-control" id="payablerent"
                                            name="payablerent" />
                                    </div> --}}
                                    <!-- col start -->
                                    {{-- <div class="col-md-2 mb-3">
                                        <label class="fw-bold mb-1">Base Rent:</label>
                                        <input type="text" class="form-control" id="baserent" name="baserent" />
                                    </div> --}}
                                    <!-- col start -->
                                    {{-- <div class="col-md-2 mb-3">
                                        <label class="fw-bold mb-1">Paid Rent:</label>
                                        <input type="text" class="form-control" id="paidrent" name="paidrent" />
                                    </div> --}}
                                    <!-- col start -->
                                    <div class="col-md-2 mb-3">
                                        <label class="fw-bold mb-1">Parking Provided:</label>
                                        <select id="" class="form-select" name="parking" id="parking">
                                            <option value="" selected>Choose...</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                    </div>
                                    <!-- col start -->
                                    <!-- col start -->
                                    <div class="col-md-2 mb-3">
                                        <label class="fw-bold mb-1">Advance Payment:</label>
                                        <input type="number" class="form-control" id="advance" name="advance" />
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
                            <!--end repeater-->
                            <div class="text-center mt-4">
                                <button type="submit"  class="btn btn-purple btn-lg">Create Booking</button>
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
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>

    <script>
        function select_category(){
            var id =$('#category').val();
            $.ajax({
                url:'/bookings/create',
                data:{id:id},
                type:'get',
                success:function(response){
                    var html=`<option value="" selected>Rooms...</option>`;
                    // console.log(response);
                    $('#room').html('');

                    for(let i=0;i<response.length;i++){
                        html+=`<option value="${response[i].id}"> ${response[i].room_number}</option>`;
                    }
                    $('#room').html(html);


                }
            });
        }

        $('.repeater').repeater({

        });

    $("#alert1")
    .fadeTo(2000, 2000)
    .slideUp(500, function () {
        $("#alert1").slideUp(500);
    });

    // =============== get prefilled details on mobile no. =================
        $('#mobile').on('keyup',function(){
            var numb = $('#mobile').val();
            var sizeofno = $('#mobile').val().length;
            // console.log(sizeofno);
            if (sizeofno==10) {
                $.ajax({
                    url:'/getguestpreviousdetails',
                    data:{numb:numb},
                    type:'get',
                    success:function(data){
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
                                var img ='/storage/' + resp.id_number;
                                $("#id_numberphoto").attr('src',img);
                            }else{
                                    document.getElementById("id_numberphoto").style.display = 'none';
                            }
                            $('#showpreviousid').attr('href',img);
                            $("#imageidprf").val(resp.id);

                        }else{
                            $('#name').val('');
                            $('#guest_father').val('');
                            $('#caste').val('');
                            $('#age').val('');
                            $('#guest_address').val('');
                            $('#tehsil').val('');
                            $('#city').val('');
                            $('#state').val('');
                            document.getElementById("id_numberphoto").style.display = 'none';
                            $("#id_numberphoto").attr('src','');
                            $('#showpreviousid').attr('href','');
                            $("#imageidprf").val('');
                        }

                        // idproof
                    }
                })
            }

        })
        // ==============================
    </script>
@endsection