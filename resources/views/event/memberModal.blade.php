<div class="modal-header">
    <h4 class="modal-title">
        {{ $event->name }} > {{ $price->name}} # @lang('event.price_history')
    </h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    @include('components.linkCol', [
        'route' => route('event.showPrice', ['id' => $event->id]), 
        'name' => '< ' . __('event.lottery_history')
    ])

    <table class="table">
        <thead>
            <tr>
                <th scope="col">@lang('general.id')</th>
                <th scope="col">@lang('member.name')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
            <tr>
                <th>{{ $member->id }}</th>
                <td>
                    {{ $member->name }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('general.close')</button>
</div>