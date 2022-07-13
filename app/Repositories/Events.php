<?php

namespace App\Repositories;

use App\Abstracts\BaseRepository;

class Events extends BaseRepository
{
    public function getQuery()
    {
        $m = $this->getModel();

        return $m::query();
    }
}
