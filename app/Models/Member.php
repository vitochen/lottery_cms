<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    public function joiningEvent()
    {
        return $this->belongsToMany(Event::class, 'member_event_relation');
    }

    public function prices()
    {
        return $this->belongsToMany(Price::class, 'member_price_relation');
    }
}
