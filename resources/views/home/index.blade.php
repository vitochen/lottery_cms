@extends('layouts.app')

@section('content')
<div class="alert alert-success alert-dismissable margin5">
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong>@lang('home.welcome')</strong>
    @lang('home.greeting')

</div>



<div class="card">
    <div class="card-header">
        <button class="btn btn-link" data-bs-toggle="collapse" href="#collapseEvent" role="button" aria-expanded="false"
            aria-controls="collapseEvent">
            <h5>@lang('home.event_intro_tile')</h5>
        </button>
    </div>

    <div class="collapse show" id="collapseEvent">
        <div class="card-body">
            <img src="{{ \Illuminate\Support\Facades\Storage::url('public/event_intro.png') }}"
                class="rounded img-fluid" alt="event_intro">
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <button class="btn btn-link" data-bs-toggle="collapse" href="#collapseMember" role="button" aria-expanded="false"
            aria-controls="collapseMember">
            <h5>@lang('home.member_intro_tile')</h5>
        </button>
    </div>

    <div class="collapse" id="collapseMember">
        <div class="card-body">
            <img src="{{ \Illuminate\Support\Facades\Storage::url('public/member_intro.png') }}"
                class="rounded img-fluid" alt="event_intro">
        </div>
    </div>
</div>

@endsection