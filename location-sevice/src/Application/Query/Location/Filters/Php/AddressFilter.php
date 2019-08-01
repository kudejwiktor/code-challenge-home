<?php

namespace Home\LocationService\Application\Query\Location\Filters\Php;

use Home\LocationService\Application\Query\Location\LocationView;

/**
 * Class AddressFilter
 * @package Home\LocationService\Application\Query\Location\Filters\Php
 */
class AddressFilter
{
    /**
     * @var
     */
    private $name;

    /**
     * AddressFilter constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param LocationView $locationView
     * @return bool
     */
    public function __invoke(LocationView $locationView): bool
    {
        $address = stripos($locationView->getAddress(), $this->name);

        return (false !== $address);
    }
}