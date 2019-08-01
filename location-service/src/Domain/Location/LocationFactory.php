<?php

namespace Home\LocationService\Domain\Location;

use Home\LocationService\SharedKernel\LocationId\{InvalidLocationIdException, LocationId};

class LocationFactory
{
    /**
     * @param array $data
     * @return Location
     * @throws InvalidLocationIdException
     */
    public static function fromArray(array $data)
    {
        $address = AddressFactory::fromArray($data);

        return new Location(
            LocationId::fromString($data['id']),
            $data['name'],
            $address,
            $data['longitude'],
            $data['latitude']
        );
    }
}