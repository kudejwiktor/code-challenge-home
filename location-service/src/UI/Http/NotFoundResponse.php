<?php

namespace Home\LocationService\UI\Http;


/**
 * Class NotFoundResponse
 * @package Home\LocationService\UI\Http
 */
class NotFoundResponse extends HttpResponse
{
    protected $code = 404;
    /**
     * NotFoundResponse constructor.
     * @param array $message
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }
}