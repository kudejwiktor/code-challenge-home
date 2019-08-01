<?php

namespace Home\LocationService\SharedKernel\LocationId;

use Ramsey\Uuid\Uuid;

class LocationId
{
    /**
     * @var string
     */
    private $id;

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return LocationId
     * @throws \Exception
     */
    public static function generate(): self
    {
        return new self(Uuid::uuid4());
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->__toString();
    }

    /**
     * @param string $id
     * @return bool
     */
    public static function isValid(string $id): bool
    {
        return Uuid::isValid($id);
    }

    /**
     * @param string $aId
     * @return LocationId
     * @throws InvalidLocationIdException
     */
    public static function fromString(string $aId)
    {
        try {
            $id = Uuid::fromString($aId);
            return new self($id);
        } catch (\InvalidArgumentException $e) {
            throw new InvalidLocationIdException($aId);
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->id;
    }
}