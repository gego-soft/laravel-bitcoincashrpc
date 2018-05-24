<?php

namespace Gegosoft\Bitcoincash\Facades;

use Illuminate\Support\Facades\Facade;

class Bitcoincashd extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bitcoincashd';
    }
}
