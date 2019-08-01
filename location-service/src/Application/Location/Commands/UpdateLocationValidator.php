<?php

namespace Home\LocationService\Application\Location\Commands;


use Home\LocationService\Application\{CommandValidation, CommandValidationInterface};

/**
 * Class UpdateCommandValidator
 * @package Home\LocationService\Application\Location\Commands
 */
class UpdateLocationValidator extends CommandValidation
{
    /**
     * @var array
     */
    protected $rules = [
        'id' => 'required',
        'name' => 'required',
        'street' => 'required',
        'postal_code' => 'required',
        'city' => 'required',
        'suit_number' => '',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric'
    ];
}