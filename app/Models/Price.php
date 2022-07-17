<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends Model
{
    use HasFactory;

    public function getIsRevealedAttribute()
    {
        return isset($this->revealed_at);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function winners()
    {
        return $this->belongsToMany(Member::class, 'member_price_relation');
    }
}
