<?php

namespace App\Constants;

class Button 
{
    static $STYLE = [
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'success' => 'btn-success',
        'danger' => 'btn-danger',
        'warning' => 'btn-warning',
        'info' => 'btn-info',
        'light' => 'btn-light',
        'dark' => 'btn-dark',
    ];

    static $OUTLINE_STYLE = [
        'primary' => 'btn-outline-primary',
        'secondary' => 'btn-outline-secondary',
        'success' => 'btn-outline-success',
        'danger' => 'btn-outline-danger',
        'warning' => 'btn-outline-warning',
        'info' => 'btn-outline-info',
        'light' => 'btn-outline-light',
        'dark' => 'btn-outline-dark',
    ];

    static public function map($a, $b)
    {
        return array_map(function($key) use ($b){ return $b[$key]; }, $a);
    }

}