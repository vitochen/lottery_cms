<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventPriceCreateRequest;
use App\Models\Event;
use App\Models\Price;
use App\Repositories\Prices;
use Illuminate\Http\Request;

class EventPriceController extends Controller
{
    public function create($id)
    {
        $event = Event::with('prices')->find($id);
        $prices = $event->prices;

        return view('event-price.create', compact('event', 'prices'));
    }

    public function store(EventPriceCreateRequest $request)
    {
        $prices = new Prices();

        $eventId = $request->get('event_id');
        $pricesInput = $request->get('price');

        Event::find($eventId)->prices()->delete();

        for ($i = 0 ; $i<count($pricesInput['name']) ; $i++) {
            $priceModels = $prices->createModel([
                'event_id' => $eventId,
                'name' => $pricesInput['name'][$i],
                'quantity' => $pricesInput['quantity'][$i],
            ]);
        }
        
        return redirect()->route("event.member.create", ['id' => $eventId])
                        ->with('success', trans('notification.create_success', ['model' => trans("price.title")]));
    }

    public function createElement()
    {
        return view('components.createPriceElement', ['price' => null, 'isFirst' => false]);
    }
}
