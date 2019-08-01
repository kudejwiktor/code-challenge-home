<?php

namespace Home\LocationService\Application\Query\Location;

use Home\LocationService\SharedKernel\LocationId\LocationId;

interface LocationQuery
{
    /**
     * @param string $id
     * @return LocationView|null
     */
    public function findById(string $id): ?LocationView;

    public function findByFilters(array $filters): ?array;

    public function all();
}

;