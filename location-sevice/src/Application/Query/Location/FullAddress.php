<?php


namespace Home\LocationService\Application\Query\Location;


/**
 * Class FullAddress
 * @package Home\LocationService\Application\Query\Location
 */
class FullAddress
{
    /**
     * @var string
     */
    private $street;
    /**
     * @var int
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

    /**
     * FullAddress constructor.
     * @param string $street
     * @param int $suiteNumber
     * @param string $postalCode
     * @param string $city
     */
    public function __construct(string $street, int $suiteNumber, string $postalCode, string $city)
    {
        $this->street = $street;
        $this->suiteNumber = $suiteNumber;
        $this->postalCode = $postalCode;
        $this->city = $city;
    }

    public function __toString(): string
    {
        return "$this->street $this->suiteNumber, $this->postalCode $this->city";
    }
}