<?php

namespace Home\LocationService\Application\Location\Commands;

use Home\LocationService\Application\Command;

/**
 * Class UpdateLocationCommand
 * @package Home\LocationService\Application\Location\Commands
 */
class UpdateLocationCommand implements Command
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $street;
    /**
     * @var string
     */
    public $postal_code;
    /**
     * @var string
     */
    public $city;
    /**
     * @var
     */
    public $suit_number;
    /**
     * @var float
     */
    public $latitude;
    /**
     * @var float
     */
    public $longitude;

    /**
     * UpdateLocationCommand constructor.
     * @param string|null $id
     * @param string|null $name
     * @param string|null $street
     * @param int|null $suit_number
     * @param string|null $postal_code
     * @param string|null $city
     * @param float|null $latitude
     * @param float|null $longitude
     */
    public function __construct(
        ?string $id,
        ?string $name,
        ?string $street,
        ?string $suit_number,
        ?string $postal_code,
        ?string $city,
        ?float $latitude,
        ?float $longitude)
    {
        $this->id = $id;
        $this->name = $name;
        $this->street = $street;
        $this->postal_code = $postal_code;
        $this->city = $city;
        $this->suit_number = $suit_number;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
}