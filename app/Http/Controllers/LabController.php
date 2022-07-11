<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabController extends Controller
{
    public function __construct()
    {               
        if(env('APP_DEBUG') != true)
            return abort(404);
    }

    public function lab()
    {
        Mail::to('foo@bar.com')->send(new Congrats);

        return 'success';
    }
}
