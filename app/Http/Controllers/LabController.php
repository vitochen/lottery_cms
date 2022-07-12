<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Member;
use App\Repositories\Events;
use App\Repositories\Members;
use App\Repositories\Prices;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class LabController extends Controller
{
    public function __construct()
    {      
        if(env('APP_DEBUG') != true)
            return abort(404);
    }

    public function lab()
    {
        $events = new Members();

        $event = $events->firstOf('id', 1);

        dd($event);
    }
}
