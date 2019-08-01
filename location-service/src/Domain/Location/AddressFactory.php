<?php

namespace Home\LocationService\Domain\Location;


class AddressFactory
{
    /**
     * @param array $data
     * @return Address
     */
    public static function fromArray(array $data): Address
    {
        return new Address(
            $data['street'],
            $data['suit_number'],
            $data['postal_code'],
            $data['city']
        );
    }
}