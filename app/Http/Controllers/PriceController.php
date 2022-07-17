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

        $members = $price->winners()->simplePaginate(15);

        $title = $price->event->name . ' > ' . $price->name . ' # ' . __('event.price_history');

        $backLink = view('components.linkCol', [
            'route' => route('event.showPrice', ['id' => $price->event->id]), 
            'name' => '< ' . __('event.lottery_history')
        ])->render();

        return view('event.memberModal', compact('title', 'members', 'backLink'));
    }
}
