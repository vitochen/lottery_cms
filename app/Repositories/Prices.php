<?php

namespace App\Repositories;

use App\Abstracts\BaseRepository;

class Prices extends BaseRepository {

    public function draw($id)
    {
        $m = $this->getModel();

        $price = $m::with('event')->find($id);

        if($price->is_revealed)
            return $price;

        $lotteryPool = $price->event->lotteryPool();
        
        $winner = $lotteryPool->inRandomOrder()->take($price->quantity)->get();

        $price->winners()->attach($winner);

        $price->revealed_at = now();

        $price->save();

        $price->refresh();

        return $price;
    }
    
}