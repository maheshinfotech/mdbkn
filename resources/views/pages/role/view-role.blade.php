@php
$pageName = "Roles";
$tableHead = ['Role Name' , 'Created Date' ,  'Action'] ;
@endphp

@extends('layouts.backend' , ['pageName' => "Roles"])

{{-- @section('js')
  @vite(['resources/js/pages/datatables.js'])
@endsection --}}

@section('content')
  <x-reusables.app-header pageName="{{$pageName}}" :createButton="true" module="role" />

  <!-- Page Content -->
  <div class="content  mx-0 w-100">
    <!--  Table -->
    <div class="container-fluid px-0 mb-5">
        <div class="card d-print-none">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h3 class="text-purple fw-bold mb-0">Roles</h3>
                <div>
                    <a href="/manage-role" type="button" class="btn btn-purple">
                        Add Role +
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle py-3" id="roles_table"
                        style="width:100%;white-space:nowrap;" data-paging="true" data-searching="true"
                        data-ordering="false" data-info="false">
                        <x-reusables.table-header :tableHead="$tableHead"/>
                        <tbody>
                            @foreach ($listingData as $data)
                                <tr>
                                    <td class="whitespace-nowrap ">
                                        {{ $data->role_name }}
                                    </td>
                                    <td class="whitespace-nowrap ">
                                        {{ $data->created_at }}
                                    </td>
                                    {{-- <td class="whitespace-nowrap ">

                                        <a href = "{{route('toggle-role-status' , ['role_placeholder' => $data->id])}}"
                                            class=" fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill cursor-pointer {{$data->is_active ? 'bg-success-light text-success' : 'bg-danger-light text-danger'  }}">
                                                {{$data->is_active ? 'Active' : 'Inactive'}}
                                        </a>
                                    </td> --}}
                                    <td class="whitespace-nowrap">
                                        <x-reusables.action-buttons :id="$data->id" module="role"
                                            :name="$data->role_name" />
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="block block-rounded">
      <div class="block-content block-content-full">
        <div class="table-responsive">

            <table class="table table-bordered table-striped table-vcenter js-dataTable-full fs-sm">
                <x-reusables.table-header :tableHead="$tableHead"/>
                <tbody>
                    @foreach ($listingData as $data)
                        <tr>
                            <td class="whitespace-nowrap ">
                                {{ $data->role_name }}
                            </td>
                            <td class="whitespace-nowrap ">
                                {{ $data->created_at }}
                            </td>

                            <td class="whitespace-nowrap">
                                <x-reusables.action-buttons :id="$data->id" module="role"
                                    :name="$data->role_name" />
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div> --}}
    <!-- END Table -->
  </div>
  <!-- END Page Content -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
        $(document).ready(function() {
            var table = $('#roles_table').DataTable({
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
    </script>
@endsection
