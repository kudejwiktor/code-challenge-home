<?php

namespace Home\LocationService\UI\Http;

/**
 * Class BadRequestResponse
 * @package Home\LocationService\UI\Http
 */
class BadRequestResponse extends HttpResponse
{
    /**
     * @var int
     */
    protected $code = 400;

    /**
     * BadRequestResponse constructor.
     * @param array $message
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }
}