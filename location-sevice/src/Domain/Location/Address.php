<?php

namespace Home\LocationService\Domain\Location;

class Address
{
    /**
     * @var string | null
     */
    private $street;

    /**
     * @var string
     */
    private $suiteNumber;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $city;

    public function __construct(?string $street, string $suiteNumber, string $postalCode, string $city)
    {
        $this->street = $street;
        $this->suiteNumber = $suiteNumber;
        $this->postalCode = $postalCode;
        $this->city = $city;
    }

    /**
     * @return int
     */
    public function getSuiteNumber(): string
    {
        return $this->suiteNumber;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }
}