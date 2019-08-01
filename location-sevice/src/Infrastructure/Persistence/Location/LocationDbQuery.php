<?php

namespace Home\LocationService\Infrastructure\Persistence\Location;

use Home\LocationService\Application\Query\Location\{Filters\Filter, LocationQuery, LocationView};
use Home\LocationService\SharedKernel\LocationId\LocationId;
use ParagonIE\EasyDB\EasyDB;

class LocationDbQuery implements LocationQuery
{
    /**
     * @var EasyDB
     */
    private $db;

    private const table = 'location';

    /**
     * LocationDbQuery constructor.
     * @param EasyDB $db
     */
    public function __construct(EasyDB $db)
    {
        $this->db = $db;
    }

    /**
     * @param string $id
     * @return LocationView|null
     */
    public function findById(string $id): ?LocationView
    {
        $location = $this->db->row('SELECT * from ' . self::table . ' WHERE id = ?', $id);
        if (!$location) {
            return null;
        }

        return LocationView::fromArray($location);
    }

    public function all()
    {
        $locations = $this->db->run('SELECT * FROM ' . self::table);

        return array_map(function ($location) {
            return LocationView::fromArray($location);
        }, $locations);
    }

    /**
     * @param Filter[]
     * @return array|null
     */
    public function findByFilters(array $filters): ?array
    {
        $locations = $this->all();

        foreach ($filters as $filter) {
            $locations = array_filter($locations, $filter);
        }

        return array_values($locations); //array_value will reset array indexes
    }
}