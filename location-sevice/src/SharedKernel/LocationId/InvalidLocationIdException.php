<?php


namespace Home\LocationService\SharedKernel\LocationId;


use Home\LocationService\SharedKernel\Exception\LocationDomainException;
use Throwable;

class InvalidLocationIdException extends \InvalidArgumentException implements LocationDomainException
{
    /**
     * @var
     */
    private $id;

    public function __construct(string $id, $code = 0, Throwable $previous = null)
    {
        parent::__construct("Invalid location id", $code, $previous);
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}