<?php

namespace Home\LocationService\Domain\Location\Exception;

use Home\LocationService\SharedKernel\Exception\LocationDomainException;

class LocationException extends \Exception implements LocationDomainException
{
    protected const NOT_FOUND_ERROR_CODE = 1001;
}