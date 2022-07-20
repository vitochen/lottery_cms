@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title float-start">
                @lang('title.member_title')
            </h3>

            {{-- todo it shoule also have import --}}
            {{-- <button type="button" class="btn btn-success float-end text-white"
                    onclick="location.href='{{ route('event.create') }}'">
                @lang('general.create_attribute', ['attribute' => __('event.title')])
            </button> --}}
        </div>
        <div class="card-body">

            <table class="table table-bordered" id="datatable">
                <thead>
                <tr>
                    <th>@lang('general.id')</th>
                    <th>@lang('member.name')</th>
                    <th>@lang('member.joined_event_count')</th>
                    <th>@lang('member.winned_price_count')</th>
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
                    url: "{{ route('member.data') }}",
                    type: "get",
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        alert("Unstable internet, please refresh the page. Or contract technical support if this keeps happen.");
                    }
                },
                columnDefs: [
                    {"className": "dt-center", "targets": [0, 2, 3]}
                ],
                columns: [
                    {data: 'id', name: 'id', width: 30},
                    {data: 'name', name: 'name'},
                    {data: 'joined_event_count', name: 'joined_event_count', width: 120},
                    {data: 'winned_price_count', name: 'winned_price_count', width: 120},
                ]
            });
        });
    </script>
@endsection