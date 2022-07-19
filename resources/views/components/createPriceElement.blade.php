<div class="row mt-2" id="{{ $key = $price ? $price->id : uniqid() }}">
    <div class="col-md-5 form-group required row">
        {!! Form::label(trans('price.name'), null, ['class'=>'col-md-4 col-form-label text-md-end']) !!}

        <div class="col-md-8">
            {!! Form::input('text', 'price[name][]', $price ? $price->name : null, ['class'=>'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-md-5 form-group required row">
        {!! Form::label(trans('price.quantity'), null, ['class'=>'col-md-4 col-form-label text-md-end']) !!}

        <div class="col-md-8">
            {!! Form::input('number', 'price[quantity][]', $price ? $price->quantity : null, ['class'=>'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-md-2">
        @if($isFirst)
        <i class="fas fa-plus-circle fa-2x mt-2" style="color: green;cursor: pointer;" onclick="addPriceEleViaApi()" style=""></i>
        @else
        <i class="fas fa-minus-circle fa-2x mt-2" style="color: red;cursor: pointer;" onclick="deletePriceEle('{{$key}}')"></i>
        @endif
    </div>
</div>