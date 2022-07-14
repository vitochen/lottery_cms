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
    
    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
