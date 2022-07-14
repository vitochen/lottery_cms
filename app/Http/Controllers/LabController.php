<?php

namespace App\Http\Controllers;

use App\Constants\Button;
use App\Constants\Event as ConstantsEvent;
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

        $a = ConstantsEvent::$statusBtnStyle;
        $b = Button::$OUTLINE_STYLE;

        $res = array_map(function($key) use ($b){ return $b[$key]; }, $a);

        // $res = array_map(null, $a, $b);

        dd($res);
    }
}
