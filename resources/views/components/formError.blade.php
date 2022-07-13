<div>
    <span class="help-block" style="color: red">
        <strong>
            @if ($errors->has($key))
                {{ $errors->first($key) }}
            @endif
        </strong>
    </span>
</div>