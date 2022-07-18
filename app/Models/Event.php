<?php

namespace App\Models;

use App\Constants\Event as ConstantsEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

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

    public function getLotteryPoolCountAttribute()
    {
        return $this->lotteryPoolMemberIds()->count();
    }

    public function winnersMemberIds()
    {
        return $this->load('prices.winners')
            ->prices
            ->pluck('winners.*.id')
            ->collapse();
    }

    public function poolMemberIds()
    {
        return DB::table('member_event_relation')
            ->select('member_id')
            ->where('event_id', $this->id)
            ->get()
            ->pluck('member_id');
    }

    public function lotteryPoolMemberIds()
    {
        $winnersId = $this->winnersMemberIds();

        $poolsId = $this->poolMemberIds();

        return $poolsId->diff($winnersId);
    }

    public function lotteryPool()
    {
        $winners = $this->winnersMemberIds();

        return $this->memberPool()->whereIntegerNotInRaw('id', $winners);
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
