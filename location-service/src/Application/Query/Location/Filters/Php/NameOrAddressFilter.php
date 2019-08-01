<?php

namespace Home\LocationService\Application\Query\Location\Filters\Php;

use Home\LocationService\Application\Query\Location\LocationView;

/**
 * Class NameFilter
 * @package Home\LocationService\Application\Query\Location\Filters\Php
 */
class NameOrAddressFilter
{
    /**
     * @var
     */
    private $name;

    /**
     * NameFilter constructor.
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
        $name = stripos($locationView->getName(), $this->name);
        $address = stripos($locationView->getAddress(), $this->name);

        return (false !== $name || false !== $address);
    }
}