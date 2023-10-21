@php
    $pageName = 'Machines';

    $tableHead = ['Machine Name' , 'Group Name' , 'QR Code' , 'Created Date' , 'Status' , 'Action'];
@endphp

@extends('layouts.backend', ['pageName' => $pageName])

@section('content')
    <x-reusables.app-header pageName="{{ $pageName }}" modulePlaceholder="Machine" :createButton="true" module="machinery" />

    <!-- Page Content -->
    <div class="content  mx-0 w-100">
        <!-- Info -->

        <!-- END Info -->

        <!-- Dynamic Table Full -->
        <div class="block block-rounded">

            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                    
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full fs-sm">
                        
                        <x-reusables.table-header :tableHead="$tableHead"/>
                        
                        <tbody>
                            
                                @foreach ($listingData as $data)
                                    
                                    <tr>

                                        <td class="whitespace-nowrap ">
                                            {{ $data->machine_name }}
                                        </td>

                                        <td class="whitespace-nowrap ">
                                            {{ $data->group->group_name }}
                                        </td>

                                        <td class="whitespace-nowrap open-qr-modal "  data-machine = "{{ $data->machine_name }}"  data-bs-toggle="modal" data-bs-target="#qrModalPopup" >
                                            
                                            {!! $data->qrcode !!}
                                        </td>

                                        <td class="whitespace-nowrap ">
                                            {{ $data->created_at }}
                                        </td>

                                        <td class="whitespace-nowrap ">

                                                <a href = "{{route('toggle-machine-status' , ['machine_placeholder' => $data->id])}}" 
                                                    class=" fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill cursor-pointer {{$data->is_active ? 'bg-success-light text-success' : 'bg-danger-light text-danger'  }}">
                                                        {{$data->is_active ? 'Active' : 'Inactive'}}
                                                </a>

                                        </td>

                                        <td class="whitespace-nowrap">
                                            <x-reusables.action-buttons :id="$data->id" module="machinery"
                                                :name="$data->machine_name" />
                                        </td>

                                    </tr>
                                    
                                @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->

    {{-- Modal Popup for QrCode --}}

    <div class="modal fade" id="qrModalPopup" tabindex="-1" role="dialog" aria-labelledby="qrModalPopupLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title machinery-modal-title"  id="qrModalPopupLabel">Modal title</h5>
                
                <div>
                    
                    <i class="fa-solid fa-print cursor-pointer print-qr"></i>

                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close" fdprocessedid="ldx5yw">
                        <i class="fa fa-fw fa-times text-dark"></i>
                    </button>
                    
                </div>
            </div>
            <div class="modal-body qr-modal-body text-center">

            </div>
            
          </div>
        </div>
      </div>
@endsection
