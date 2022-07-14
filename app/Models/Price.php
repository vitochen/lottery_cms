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
}
