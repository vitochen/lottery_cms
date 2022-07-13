@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>
                        @lang('general.create_attribute', ['attribute' => __('event.title')])
                        </h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('event.create') }}">
                            {{ csrf_field() }}

                            <div class="form-group row required">
                                {!! Form::label(trans('event.name'), null, ['class'=>'col-md-4 col-form-label text-md-end']) !!}

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
        </div>
    </div>
@endsection

@section('footer_script')
    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
    </script>
@endsection