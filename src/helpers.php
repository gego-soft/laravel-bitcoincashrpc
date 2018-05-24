<?php

if (! function_exists('bitcoincashd')) {
    /**
     * Get bitcoincashd client instance.
     *
     * @return \Gegosoft\Bitcoincash\Client
     */
    function bitcoincashd()
    {
        return app('bitcoincashd');
    }
}
