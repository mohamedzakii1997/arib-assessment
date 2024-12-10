<?php


namespace App\Facade;

use Illuminate\Support\Facades\Facade;

class Pagination extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Pagination';
    }
}
