<?php

namespace Home\LocationService\Application\Location\Commands;

use Home\LocationService\Application\CommandValidation;


class AddLocationValidator extends CommandValidation
{
    protected $rules = [
        'name' => 'required',
        'street' => '',
        'postal_code' => 'required',
        'city' => 'required',
        'suit_number' => '',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric'
    ];
}