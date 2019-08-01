<?php

namespace Home\LocationService\UI\Http\Exception;

use Throwable;

class BadRequestException extends HttpException
{
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct($message, 400, $previous);
    }
}
