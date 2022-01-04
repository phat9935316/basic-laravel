@extends('layouts.app')

@section('content')
<div class="container">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2 mt-4">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label style="margin: auto 0px">Search:</label>
                                        <input class="form-control " style="font-size: 12px" name="search" placeholder="user_id" id="user_id"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label style="margin: auto 0px">Search:</label>
                                        <input class="form-control " style="font-size: 12px" name="search" placeholder="phone" id="phone"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label style="margin: auto 0px">Search:</label>
                                        <input class="form-control " style="font-size: 12px" name="search" placeholder="role_name" id="role_name"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group py-2">
                                        <button class="btn btn-info">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <table id="datatable" class="table table-striped table-bordered dt-responsive " style="width: 100%;">
                            <thead>
                            <tr style="text-align: center">
                                <th style="font-weight: bold; width:5px;">{{ __('No') }}</th>
                                <th style="font-weight: bold; width:20px;">{{ __('user_id') }}</th>
                                <th style="font-weight: bold; width:30px;">{{ __('phone') }}</th>
                                <th style="font-weight: bold; width:30px;">{{ __('role_name ') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
</div>
@endsection
@section('js')
<script src="{{ asset('https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function () {
        var counter = 1
        //=============================================//
        // -- Page rows
        //=============================================//
        var table = $('#datatable').DataTable({
            "dom": '<"top">rt<"bottom mt-3"<"row justify-content-between m-0"<"col-6"li><"col-6 row justify-content-end"p>>><"clear">',
            "processing": true,
            "deferRender": true,
            "ajax": {
                url: '{{route('b3.datatable')}}',
                data: function (d) {
                    d.user_id = $('#user_id').val()
                    d.phone = $('#phone').val()
                    d.role_name = $('#role_name').val()
                }
            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, width: '5%', className:'text-center align-middle'},
                {data: 'user_id', name: 'user_id', className: 'text-center align-middle mw-300 full_name',width: '10%'},
                {data: 'phone', name: 'phone', className: 'text-center align-middle mw-300 email', width: '15%'},
                {data: 'role_name', name:'role_name', className: 'text-center align-middle status', width: '15%'},
            ],
            "pageLength": 10,
        });

        $('.btn-info').on('click', function(){
            table.ajax.reload(null, false);
        })
    })

</script>
@endsection
