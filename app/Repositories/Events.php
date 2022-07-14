<?php

namespace App\Repositories;

use App\Abstracts\BaseRepository;

class Events extends BaseRepository
{
    static $LANG_KEY = [
        'unreveal' => 'unrun_lottery',
        'running' => 'runing_lottery',
        'finished' => 'runed_lottery',
    ];

    public function getQuery()
    {
        $m = $this->getModel();

        return $m::query();
    }

    static public function getStatusName($lotteryStatusAttribute)
    {
        return __('event.' . static::$LANG_KEY[$lotteryStatusAttribute]);
    }
}
