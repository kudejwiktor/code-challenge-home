<?php

namespace Home\LocationService\Domain\Location;

use Home\LocationService\SharedKernel\LocationId\LocationId;

interface LocationRepository
{
    public function all();

    /**
     * @param Location $aLocation
     */
    public function save(Location $aLocation): void;

    /**
     * @param LocationId $id
     * @return Location
     */
    public function findById(LocationId $id): Location;

    /**
     * @param LocationId $id
     * @return bool
     */
    public function exist(LocationId $id): bool;
}