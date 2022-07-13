<?php

namespace App\Http\Controllers;

use App\Abstracts\BaseController;
use App\Http\Requests\EventCreateRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Repositories\Events;
use Illuminate\Http\Request;

class EventController extends BaseController
{
    protected $repository = Events::class;
    protected $route = 'event';
    protected $view = 'event';
    protected $lang = 'event';
    protected $storeRequest = EventCreateRequest::class;
    protected $updateRequest = EventUpdateRequest::class;

    public function createPrepare(Request $request): array
    {
        return $request->only([
            'name'
        ]);
    }
    
    public function updatePrepare(Request $request): array
    {
        return $request->only([
            'name'
        ]);
    }
}
