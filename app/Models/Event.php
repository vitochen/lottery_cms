<?php

namespace App\Models;

use App\Constants\Event as ConstantsEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    public function getLotteryStatusAttribute()
    {
        $prices = $this->prices;

        $revealedPrices = $prices->filter(function ($m) {
            return $m->is_revealed;
        });

        $allCount = $prices->count();
        $revealedCount = $revealedPrices->count();

        if ($revealedCount == 0) {
            return ConstantsEvent::UNREVEAL_KEY;
        } else if ($revealedCount == $allCount) {
            return ConstantsEvent::FINISHED_KEY;
        } else if ($revealedCount < $allCount) {
            return ConstantsEvent::RUNNING_KEY;
        }
    }

    public function lotteryPool()
    {
        $winners = $this->load('prices.winners')
                    ->prices
                    ->pluck('winners.*.id')
                    ->collapse()
                    ->unique()
                    ->toArray();

        return $this->belongsToMany(Member::class, 'member_event_relation')
                    ->whereNotIn('id', $winners);
    }
    
    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function memberPool()
    {
        return $this->belongsToMany(Member::class, 'member_event_relation');
    }
}
