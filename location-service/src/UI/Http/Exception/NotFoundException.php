<?php

namespace Home\LocationService\UI\Http\Exception;

use Throwable;

class NotFoundException extends HttpException
{
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }
}
