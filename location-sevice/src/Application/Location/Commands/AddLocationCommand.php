<?php

namespace Home\LocationService\Application\Location\Commands;


use Home\LocationService\Application\Command;

class AddLocationCommand implements Command
{
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

    public function __construct(
        $name,
        $street,
        $suit_number,
        $postal_code,
        $city,
        $latitude,
        $longitude)
    {
        $this->name = $name;
        $this->street = $street;
        $this->postal_code = $postal_code;
        $this->city = $city;
        $this->suit_number = $suit_number;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
}