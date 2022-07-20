<div class="modal-header">
    <h4 class="modal-title">
        {{ $title }}        
    </h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">@lang('general.id')</th>
                <th scope="col">@lang('event.name')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <th>{{ $event->id }}</th>
                <td>
                    {{ $event->name }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $events->links('event.pagnateLink') }}
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('general.close')</button>
</div>