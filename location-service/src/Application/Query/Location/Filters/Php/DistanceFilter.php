<?php

namespace Home\LocationService\Application\Query\Location\Filters\Php;

use Home\LocationService\Application\Query\Location\LocationView;

/**
 * Class DistanceFilter
 * @package Home\LocationService\Application\Query\Location\Filters\Php
 */
class DistanceFilter
{
    /**
     * @var int
     */
    private $earthRadiusInKm = 6371;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var int
     */
    private $distance;

    /**
     * @var float
     */
    private $longitude;

    /**
     * DistanceFilter constructor.
     * @param int $distance
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(int $distance, float $latitude, float $longitude)
    {
        $this->distance = $distance;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @param LocationView $locationView
     * @return bool
     */
    public function __invoke(LocationView $locationView): bool
    {
        $dLat = deg2rad($locationView->getLatitude() - $this->latitude);
        $dLon = deg2rad($locationView->getLongitude() - $this->longitude);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($locationView->getLatitude())) * cos(deg2rad($locationView->getLatitude())) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * asin(sqrt($a));
        $d = $this->earthRadiusInKm * $c;

        return $d <= $this->distance;
    }
}