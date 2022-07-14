<?php

namespace App\Constants;

class Event 
{
    const UNREVEAL_KEY = 'unreveal';
    const RUNNING_KEY = 'running';
    const FINISHED_KEY = 'finished';

    static $STATUS_BTN_STYLE = [
        'unreveal' => 'secondary',
        'running' => 'primary',
        'finished' => 'success',
    ];
}