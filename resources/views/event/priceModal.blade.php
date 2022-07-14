<div class="modal-header">
    <h4 class="modal-title">{{ $event->name }}# @lang('event.lottery_history')</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
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
                <td>{{ $price->quantity }}</td>
                <td>{{ $price->revealed_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('general.close')</button>
</div>