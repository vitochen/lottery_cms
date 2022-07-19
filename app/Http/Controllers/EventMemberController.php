<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventMemberController extends Controller
{
    public function create($id)
    {
        $event = Event::find($id);

        return view('event-member.create', compact('event'));
    }
}
