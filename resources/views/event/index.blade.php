@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title float-start">
                @lang('title.event_title')
            </h3>

            <button type="button" class="btn btn-success float-end text-white"
                    onclick="location.href='{{ route('event.create') }}'">
                @lang('general.create_attribute', ['attribute' => __('event.title')])
            </button>
        </div>
        <div class="card-body">

            <table class="table table-bordered" id="datatable">
                <thead>
                <tr>
                    <th>@lang('general.id')</th>
                    <th>@lang('event.name')</th>
                    <th>@lang('event.status')</th>
                    <th>@lang('general.edit')</th>
                    <th>@lang('general.delete')</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('footer_script')

    <script>
        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 25,
                ajax: {
                    url: "{{ route('event.data') }}",
                    type: "get",
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        alert("Unstable internet, please refresh the page. Or contract technical support if this keeps happen.");
                    }
                },
                columnDefs: [
                    {"className": "dt-center", "targets": [0, 2, 3, 4]}
                ],
                columns: [
                    {data: 'id', name: 'id', width: 30},
                    {data: 'name', name: 'name'},
                    {data: 'lottery_status', name: 'lottery_status', width: 200, sortable: false},
                    {data: 'edit_col', name: 'edit_col', width: 40, sortable: false},
                    {data: 'del_col', name: 'del_col', width: 40, sortable: false},
                ]
            });



            $(document).on('click', '.fresh_table', function () {
                table.ajax.reload();
            });

        });
    </script>
@endsection