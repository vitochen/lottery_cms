<?php

namespace App\Http\Controllers;

use App\Abstracts\BaseController;
use App\Http\Requests\PriceCreateRequest;
use App\Http\Requests\PriceUpdateRequest;
use App\Repositories\Prices;
use Illuminate\Http\Request;

class PriceController extends BaseController
{
    protected $repository = Prices::class;
    protected $route = 'price';
    protected $view = 'price';
    protected $lang = 'price';
    protected $storeRequest = PriceCreateRequest::class;
    protected $updateRequest = PriceUpdateRequest::class;

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

    public function reveal($id)
    {
        $price = $this->repos->draw($id);

        $event = $price->event;

        return view('event.priceModal', compact('event'));
    }

    public function winner($id)
    {
        $price = $this->repos->firstOf('id', $id);

        $members = $price->winners()->simplePaginate(15);

        $title = $price->event->name . ' > ' . $price->name . ' # ' . __('event.price_history');

        $backLink = view('components.linkCol', [
            'route' => route('event.showPrice', ['id' => $price->event->id]), 
            'name' => '< ' . __('event.lottery_history')
        ])->render();

        return view('event.memberModal', compact('title', 'members', 'backLink'));
    }
}
