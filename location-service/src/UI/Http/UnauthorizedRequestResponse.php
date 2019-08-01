<?php

namespace Home\LocationService\UI\Http;

/**
 * Class UnauthorizedRequestResponse
 * @package Home\LocationService\UI\Http
 */
class UnauthorizedRequestResponse extends HttpResponse
{
    /**
     * @var int
     */
    protected $code = 401;

    /**
     * UnauthorizedRequestResponse constructor.
     * @param array $message
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }
}