<?php

namespace Home\LocationService\Domain\Location;

use Home\LocationService\SharedKernel\LocationId\LocationId;

/**
 * Interface LocationRepository
 * @package Home\LocationService\Domain\Location
 */
interface LocationRepository
{

    /**
     * @param Location $aLocation
     */
    public function save(Location $aLocation): void;

    /**
     * @param LocationId $locationId
     */
    public function delete(LocationId $locationId): void;

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