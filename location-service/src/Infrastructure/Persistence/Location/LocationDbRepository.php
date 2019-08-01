<?php

namespace Home\LocationService\Infrastructure\Persistence\Location;

use Home\LocationService\Domain\Location\Exception\{LocationNotFoundException};
use Home\LocationService\Domain\Location\{Location, LocationFactory, LocationRepository};
use Home\LocationService\SharedKernel\LocationId\LocationId;
use ParagonIE\EasyDB\EasyDB;

/**
 * Class LocationDbRepository
 * @package Home\LocationService\Infrastructure\Persistence\Location
 */
class LocationDbRepository implements LocationRepository
{
    /**
     * @var string
     */
    private const table = 'location';

    /**
     * @var EasyDB
     */
    private $db;

    /**
     * LocationDbRepository constructor.
     * @param EasyDB $db
     */
    public function __construct(EasyDB $db)
    {
        $this->db = $db;
    }

    /**
     * @param LocationId $id
     * @return bool
     */
    public function exist(LocationId $id): bool
    {
        $exist = $this->db->row('SELECT count(*) as cnt FROM ' . self::table . ' WHERE id = ?', $id->getId())['cnt'];
        return (boolean)$exist;
    }

    /**
     * @param LocationId $locationId
     * @throws LocationNotFoundException
     */
    public function delete(LocationId $locationId): void
    {
        if (!$this->exist($locationId)) {
            throw LocationNotFoundException::forId($locationId);
        }
        $this->db->delete(self::table, ['id' => $locationId->getId()]);
    }

    /**
     * @param Location $aLocation
     * @throws \Exception
     */
    public function save(Location $aLocation): void
    {
        $data = [
            'id' => $aLocation->getId(),
            'name' => $aLocation->getName(),
            'street' => $aLocation->getAddress()->getStreet(),
            'suite_number' => $aLocation->getAddress()->getSuiteNumber(),
            'postal_code' => $aLocation->getAddress()->getPostalCode(),
            'city' => $aLocation->getAddress()->getCity(),
            'latitude' => $aLocation->getLatitude(),
            'longitude' => $aLocation->getLongitude()
        ];

        try {
            if ($this->exist($aLocation->getId())) {
                $this->db->update(self::table,
                    $data,
                    ['id' => $aLocation->getId()->getId()]
                );
            } else {
                $this->db->insert(self::table, $data);
            }
        } catch (\Exception $e) {
            //TODO: throw repository exception
            throw new \Exception('Could not save Location to storage');
        }
    }

    /**
     * @param LocationId $id
     * @return Location
     * @throws LocationNotFoundException
     */
    public function findById(LocationId $id): Location
    {
        $rawData = $this->db->run('SELECT * from ' . self::table . ' where id = ?', $id->getId());
        if (empty($rawData)) {
            throw LocationNotFoundException::forId($id);
        }

        return LocationFactory::fromArray($rawData[0]);
    }
}