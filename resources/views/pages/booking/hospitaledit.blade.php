<div class="modal-content">
    <div class="modal-header border border-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <h3 class="text-purple text-center mb-4 mt-0">Edit Hospital</h3>
        <form id="editHospitalForm" action="{{ route('hospital.update', $hospital->id) }}" method="post">
            @csrf
            @method('PUT') {{-- Use 'PUT' or 'PATCH' based on your form --}}
            <div class="row">
                <!-- col start -->
                <div class="col-12 mb-3">
                    <label class="fw-bold mb-1">Hospital Name:</label>
                    <input type="text" class="form-control" name="name" id="hospitalName" value="{{ $hospital->name }}" required />
                </div>
                <!--begin repeater-->
                <div class="repeater">
                    <!--begin repeater list-->
                    <div data-repeater-list="wards">
                        <!--begin repeater item-->
                        @foreach($hospital->wards as $ward)
                        <div data-repeater-item>
                            <!--begin::Input group-->
                            <div class="row justify-content-center align-items-center">
                                <!-- col start -->
                                <div class="col-md-9 mb-3">
                                    <label class="fw-bold mb-1">Ward:</label>
                                    <input type="text" class="form-control wardNumber" name="wards" value="{{ $ward->ward }}" required />
                                </div>
                                <!-- col start -->
                                <div class="col-md-3 mb-3">
                                    <label class="fw-bold mb-1 text-white">Action:</label>
                                    <input class="btn btn-sm btn-danger form-control" data-repeater-delete type="button" value="Delete"/>
                                </div>
                            </div>
                            <!--end Input group-->
                        </div>
                        @endforeach
                    </div>
                    <!--end repeater list-->
                    <input class="btn btn-purple px-4" data-repeater-create type="button" value="Add"/>
                </div>
                <!--end repeater-->
            </div>
            <div class="mt-3 mb-5 text-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-purple" value="Update"/>
            </div>
        </form>
    </div>
</div>


