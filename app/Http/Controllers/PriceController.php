<?php

namespace App\Http\Controllers;

use App\Repositories\Prices;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    private $prices;

    public function __construct(Prices $prices)
    {
        $this->prices = $prices;
    }

    public function reveal($id)
    {
        $price = $this->prices->draw($id);

        $event = $price->event;

        return view('event.priceModal', compact('event'));
    }

    public function winner($id)
    {
        $price = $this->prices->firstOf('id', $id);

        $members = $price->winners;

        $event = $price->event;

        return view('event.memberModal', compact('event', 'price', 'members'));
    }
}
