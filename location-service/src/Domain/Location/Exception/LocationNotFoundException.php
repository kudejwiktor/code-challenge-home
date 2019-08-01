<?php

namespace Home\LocationService\Domain\Location\Exception;

use Home\LocationService\SharedKernel\LocationId\LocationId;

class LocationNotFoundException extends LocationException
{
    /**
     * @param LocationId $locationId
     * @return LocationNotFoundException
     */
    public static function forId(LocationId $locationId): LocationNotFoundException
    {
        return new static(
            sprintf('Location (id = %s) could not be found', $locationId->getId()),
            self::NOT_FOUND_ERROR_CODE
        );
    }

    /**
     * @param string $locationId
     * @return LocationNotFoundException
     */
    public static function forStringId(string $locationId): LocationNotFoundException
    {
        return new static(
            sprintf('Location (id = %s) could not be found', $locationId),
            self::NOT_FOUND_ERROR_CODE
        );
    }
}