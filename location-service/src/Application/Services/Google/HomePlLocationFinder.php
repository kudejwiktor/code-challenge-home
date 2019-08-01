<?php

namespace Home\LocationService\Application\Services\Google;

use Home\LocationService\Application\Query\Location\LocationView;

interface HomePlLocationFinder
{
    public function findByName(string $name): LocationView;
}