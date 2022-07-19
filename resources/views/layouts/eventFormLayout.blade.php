@extends('layouts.app')

@section('header_script')
<style>
    .tab-content {
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        padding: 10px;
    }

    .nav-tabs {
        margin-bottom: 0;
    }

    .numberCircle {
        border-radius: 50%;
        width: 18px;
        height: 18px;
        padding: 1px;
        background: #fff;
        border: 2px solid #666;
        color: #666;
        text-align: center;
        font: 8px Arial, sans-serif;
        display: inline-block;
        font-weight: bolder;
    } 
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h1> @lang('general.create_attribute', ['attribute' => __('event.title')]) </h1>
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1)==\App\Constants\Event::CREATING_EVENT ? 'active' : 'disabled' }}" id="event-tab" data-toggle="tab" href="#event" role="tab"
                    aria-controls="event" aria-selected="true">
                    <div class="numberCircle">1</div>
                    @lang('event.event_tab')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1)==\App\Constants\Event::CREATING_PRICE ? 'active' : 'disabled' }}" id="price-tab" data-toggle="tab" href="#price" role="tab"
                    aria-controls="price" aria-selected="false">
                    <div class="numberCircle">2</div>
                    @lang('event.price_tab')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1)==\App\Constants\Event::CREATING_MEMBER ? 'active' : 'disabled' }}" id="member-tab" data-toggle="tab" href="#member" role="tab"
                    aria-controls="member" aria-selected="false">
                    <div class="numberCircle">3</div>
                    @lang('event.member_tab')
                </a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            @yield('tab_content')
            {{-- <div class="tab-pane fade {{ request()->segment(1)==\App\Constants\Event::CREATING_EVENT ? 'show active' : '' }}" id="event" role="tabpanel" aria-labelledby="event-tab">
                @include('event.createEvent')
            </div>
            <div class="tab-pane fade {{ request()->segment(1)==\App\Constants\Event::CREATING_PRICE ? 'show active' : '' }}" id="price" role="tabpanel" aria-labelledby="price-tab">
                @include('event.createPrice')
            </div>
            <div class="tab-pane fade {{ request()->segment(1)==\App\Constants\Event::CREATING_MEMBER ? 'show active' : '' }}" id="member" role="tabpanel" aria-labelledby="member-tab">
                @include('event.createMember')
            </div> --}}
        </div>
    </div>
</div>

@endsection