@component('mail::message')
Congrats! 

Due to you has involved our lottery event.

You win the special price.

@component('mail::button', ['url' => ''])
Redeem here!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
