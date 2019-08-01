<?php

namespace Home\LocationService\Domain\Location;

use Home\LocationService\SharedKernel\LocationId\LocationId;


class Location
{
    /**
     * @var LocationId
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var Address
     */
    private $address;
    /**
     * @var float
     */
    private $longitude;
    /**
     * @var float
     */
    private $latitude;

    public function __construct(LocationId $id, string $name, Address $address, float $longitude, float $latitude)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    /**
     * @return LocationId
     */
    public function getId(): LocationId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public static function add(string $name, Address $address, float $longitude, float $latitude)
    {
        $id = LocationId::generate();
        return new self($id, $name, $address, $longitude, $latitude);
    }
}