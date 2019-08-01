<?php

namespace Home\LocationService\UI\Http\Actions;


/**
 * Class BaseAction
 * @package Home\LocationService\UI\Http\Actions
 */
class BaseAction
{
    /**
     * @return array
     */
    protected function defaultHeaders(): array
    {
        return [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, PUT, POST, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => 'X-Requested-With, Content-Type, Accept, Origin, Authorization',
            'Cache-Control' => 'public, s-maxage=120',
            'Content-Type' => 'application/json',
        ];
    }
}