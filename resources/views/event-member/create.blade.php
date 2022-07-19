@extends('layouts.eventFormLayout')

@section('tab_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{ route('event.create') }}">
                {{ csrf_field() }}

                <div class="col-md-12 form-group row mt-2">
                    {!! Form::input('text', 'event_id', $event->id, ['hidden']) !!}
                    
                    {!! Form::label(trans('event.name'), null, ['class'=>'col-md-2 col-form-label text-md-end']) !!}
                    <div class="col-md-9">
                        {!! Form::input('text', null, $event->name, ['class'=>'form-control', 'readonly']) !!}
                    </div>
                </div>

                <hr>

                <div class="form-group row required">
                    {!! Form::label(trans('event.name'), null, ['class'=>'col-md-4 col-form-label text-md-end'])
                    !!}

                    <div class="col-md-6">
                        {!! Form::input('text', 'name', old('name'), ['class'=>'form-control']) !!}

                        @include('components.formError', array_merge(compact('errors'), ['key' => 'name']))
                    </div>
                </div>

                <div class="form-group row mb-0 mt-2">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            @lang('general.submit')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection