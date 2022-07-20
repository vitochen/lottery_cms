<div class="modal-header">
    <h4 class="modal-title" id="client_title">@lang('general.delete_head')</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    @lang('general.delete_warning')
</div>
<div class="modal-footer">
    <button type="button" class="btn" data-bs-dismiss="modal">@lang('general.cancel')</button>
    <form action="{{ $confirmRoute }}" method="post">
        @csrf

        <input name="_method" type="hidden" value="DELETE">

        <button type="submit" class="btn btn-danger">@lang('general.confirm')</button>
    </form>
</div>
