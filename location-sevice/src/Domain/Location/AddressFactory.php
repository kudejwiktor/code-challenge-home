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
            (int)$data['suite_number'],
            $data['postal_code'],
            $data['city']
        );
    }
}