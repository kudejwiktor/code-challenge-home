<?php


namespace Home\LocationService\Application\Location\Commands;


use Home\LocationService\Application\CommandValidation;

class DeleteLocationValidator extends CommandValidation
{
    protected $rules = [
        'id' => 'required',
    ];
}