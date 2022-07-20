<?php

namespace App\Repositories;

use App\Abstracts\BaseRepository;

class Members extends BaseRepository
{
    public function getQuery()
    {
        $m = $this->getModel();

        return $m::with('joiningEvent', 'prices');
    }
}
