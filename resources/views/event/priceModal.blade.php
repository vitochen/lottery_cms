<div class="modal-header">
    <h4 class="modal-title">{{ $event->name }} # @lang('event.lottery_history')</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="float-end">
        @lang('event.pool_count')
        @include('components.linkCol', [
            'route' => route('event.showPool', ['id' => $event->id]), 
            'name' => $event->lottery_pool_count
        ])
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">@lang('price.name')</th>
                <th scope="col">@lang('price.quantity')</th>
                <th scope="col">@lang('price.reveal_at')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($event->prices as $price)
            <tr>
                <th>{{ $price->name }}</th>
                <td>
                    @if ($price->revealed_at)
                        @include('components.linkCol', [
                            'route' => route('price.winner', ['id' => $price->id]), 
                            'name' => $price->quantity
                        ])
                    @else
                        {{ $price->quantity }}
                    @endif
                </td>
                <td>
                    @if ($price->revealed_at)
                        {{ $price->revealed_at}}
                    @else
                        @include('components.btnCol', [
                            'style' => App\Constants\Button::$STYLE['warning'], 
                            'route' => route('price.reveal', ['id' => $price->id]), 
                            'name' => __('event.reveal')
                        ])
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('general.close')</button>
</div>