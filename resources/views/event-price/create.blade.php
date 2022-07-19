@extends('layouts.eventFormLayout')

@section('tab_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{ route('event.price.create', $event->id) }}" id="price-form">
                {{ csrf_field() }}

                
                <div class="col-md-12 form-group row mt-2">
                    {!! Form::input('text', 'event_id', $event->id, ['hidden']) !!}
                    
                    {!! Form::label(trans('event.name'), null, ['class'=>'col-md-2 col-form-label text-md-end']) !!}
                    <div class="col-md-9">
                        {!! Form::input('text', null, $event->name, ['class'=>'form-control', 'readonly']) !!}
                    </div>
                </div>

                <hr>

                @if (count($prices) > 0)
                    @foreach ($prices as $k => $price)
                        @include('components.createPriceElement', ['price' => $price, 'isFirst' => $k==0])
                    @endforeach
                @else
                    @include('components.createPriceElement', ['price' => null, 'isFirst' => true])
                @endif
                
            </form>
            
            <div class="form-group row mb-0 mt-2">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary" form="price-form">
                        @lang('general.submit')
                    </button>

                    <a href="{{ route('event.member.create', $event->id) }}">
                        <button type="button" class="btn btn-link">
                            @lang('general.skip')
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
