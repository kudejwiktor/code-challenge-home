<?php

namespace Home\LocationService\Application\Query\Location;


use Home\LocationService\SharedKernel\LocationId\LocationId;

/**
 * Class LocationView
 * @package Home\LocationService\Application\Query\Location
 */
class LocationView implements \JsonSerializable
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
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

    /**
     * LocationView constructor.
     * @param string $id
     * @param string $name
     * @param string $address
     * @param float $longitude
     * @param float $latitude
     */
    public function __construct(
        string $id,
        ?string $name,
        string $address,
        float $longitude,
        float $latitude)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getId(): string
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
     * @return string
     */
    public function getAddress(): string
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

    /**
     * @param array $location
     * @return LocationView
     */
    public static function fromArray(array $location)
    {
        $fullAddress = new FullAddress(
            $location['street'],
            $location['suite_number'],
            $location['postal_code'],
            $location['city']
        );

        return new self(
            $location['id'],
            $location['name'],
            $fullAddress,
            $location['longitude'],
            $location['latitude']
        );
    }

    /**
     * @param $location
     * @return LocationView
     * @throws \Exception
     */
    public static function fromGooglePlaces($location)
    {
        return new self(
            LocationId::generate(),// for this case we need to generate random id due to external resource
            $location->name,
            $location->formatted_address,
            $location->geometry->location->lng,
            $location->geometry->location->lat
        );
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}