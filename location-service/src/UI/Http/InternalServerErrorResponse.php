<?php


namespace Home\LocationService\UI\Http;


/**
 * Class InternalServerErrorResponse
 * @package Home\LocationService\UI\Http
 */
class InternalServerErrorResponse extends HttpResponse
{
    /**
     * @var int
     */
    protected $code = 500;

    /**
     * InternalServerErrorResponse constructor.
     * @param array $message
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }
}