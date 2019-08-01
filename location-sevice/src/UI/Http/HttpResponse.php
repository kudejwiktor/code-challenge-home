<?php

namespace Home\LocationService\UI\Http;

/**
 * Class HttpResponse
 * @package Home\LocationService\UI\Http
 */
abstract class HttpResponse implements \JsonSerializable
{
    /**
     * @var array
     */
    protected $message;

    /**
     * @var int
     */
    protected $code;

    /**
     * HttpResponse constructor.
     * @param array $message
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'error' => [
                'code' => $this->getCode(),
                'message' => $this->message
            ]
        ];
    }
}