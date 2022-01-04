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
                    <a href="{{ route('post.create') }}" class="btn btn-primary">Add</a>
                    <div class="">
                        <table id="datatable" class="table table-striped table-bordered dt-responsive " style="width: 100%;">
                            <thead>
                            <tr style="text-align: center">
                                <th style="font-weight: bold; width:5px;">{{ __('No') }}</th>
                                <th style="font-weight: bold; width:20px;">{{ __('Title') }}</th>
                                <th style="font-weight: bold; width:30px;">{{ __('Action ') }}</th>
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
                url: '{{route('b2.datatable')}}',
            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, width: '5%', className:'text-center align-middle'},
                {data: 'title', name: 'title', className: 'text-center align-middle mw-300 full_name',width: '25%'},
                {data: 'action', name:'action', className: 'text-center align-middle status', width: '15%'},
            ],
            "pageLength": 10,
            drawCallback: function(){
                addEventListener();
            }
        });
        function addEventListener(){
            $('body').on('click', '.btn-delete', function (e) {
                e.preventDefault();
                var me = $(this),
                    url = me.attr('data-url'),
                    id =  me.attr('data-id')
                swal.fire({
                    title: '{{ __("Confirm delete") }}',
                    text: '{{ __("Do you want to delete this post?") }}',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __("Yes") }}',
                    cancelButtonText: '{{ __("Cancel") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "POST",
                            url: url,
                            data: {
                                '_token': '{{ csrf_token() }}',
                            },
                            success: function(result) {
                                table.ajax.reload();
                                toastr.success(result.message)
                            },
                            error: function(result) {
                                Swal.fire(
                                    'Deleted!',
                                    'Delete fail.',
                                    'warning'
                                )
                            }
                        });
                    }
                });
            })
        }

    })

</script>
@endsection
