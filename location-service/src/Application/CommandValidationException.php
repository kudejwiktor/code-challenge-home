<?php

namespace Home\LocationService\Application;

use Throwable;

class CommandValidationException extends \Exception
{
    /**
     * @var array
     */
    private $errors;

    public function __construct(array $errors, $code = 0, Throwable $previous = null)
    {
        parent::__construct('Command could not be processed', $code, $previous);
        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}