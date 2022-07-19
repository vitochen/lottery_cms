@extends('layouts.eventFormLayout')

@section('tab_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="col-md-12 form-group row mt-2">

                {!! Form::label(trans('event.name'), null, ['class'=>'col-md-2 col-form-label text-md-end']) !!}
                <div class="col-md-9">
                    {!! Form::input('text', null, $event->name, ['class'=>'form-control', 'readonly']) !!}
                </div>
            </div>

            <hr>

            @if (isset($errors) && $errors->any())
                <table class="table table-danger">
                    <tr>
                        <th>@lang('member.row')</th>
                        <th>@lang('member.errors')</th>
                    </tr>

                    @foreach ($errors->all() as $row => $error)
                        <tr>
                            <td>{{ $row+1 }}</td>
                            <td>{{ $error }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif

            <form action="{{ route('event.member.import', $event->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                {!! Form::input('text', 'event_id', $event->id, ['hidden']) !!}

                <div class="form-group row mb-0 mt-2">
                    <div class="raw col-md-8 offset-md-2 d-flex justify-content-evenly" style="display: inline-flex;">
                        <button type="button" style="display:block;width:120px; height:30px;"
                            onclick="document.getElementById('getFile').click()" class="mr-2 col-md-4">
                            @lang('member.upload_btn')
                        </button>
                        <input class="col-md-7" type="text" id="upload_filename"
                            style="border-width: 0;border-bottom-width: 1px;">
                        <input type='file' name="file" id="getFile" style="display:none">
                    </div>
                </div>

                <p class="d-flex justify-content-center">
                    @lang('member.sample_warning')
                    <a href="{{ route('download.pool_import_sample') }}" target="__blank">
                        (
                        @lang('member.sample')
                        <i class="featherIcon" data-feather="external-link" title="@lang('form.spot_intro_link')"></i>
                        )
                    </a>
                </p>

                <div class="form-group row mb-0 mt-2">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            @lang('member.import_btn')
                        </button>

                        <a href="{{ route('event.index') }}">
                            <button type="button" class="btn btn-link">
                                @lang('general.skip')
                            </button>
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection