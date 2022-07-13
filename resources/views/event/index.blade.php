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
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="question_modal">
        <div class="modal-dialog">
            <div class="modal-content" id="question_content"></div>
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
                    {"className": "dt-center", "targets": [0,]}
                ],
                columns: [
                    {data: 'id', name: 'id', width: 30},
                    {data: 'name', name: 'name'},
                ]
            });
        });
    </script>
@endsection