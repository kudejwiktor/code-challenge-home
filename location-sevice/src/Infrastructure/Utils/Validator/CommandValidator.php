<?php

namespace Home\LocationService\Infrastructure\Utils\Validator;

use Home\LocationService\Application\CommandValidatorInterface;
use Rakit\Validation\Validator;

class CommandValidator implements CommandValidatorInterface
{
    /**
     * @var Validator
     */
    private $validator;

    /**
     * @var bool
     */
    private $failed = false;

    /**
     * @var array
     */
    private $errors = [];

    /**
     * CommandValidator constructor.
     */
    public function __construct()
    {
        $this->validator = new Validator();
    }

    /**
     * @param array $input
     * @param array $rules
     * @return void
     */
    public function validate(array $input, array $rules): void
    {
        $validation = $this->validator->make($input, $rules);
        $validation->validate();
        $this->failed = $validation->fails();
        $this->errors = $validation->errors->firstOfAll();
    }

    /**
     * @return bool
     */
    public function fails(): bool
    {
        return $this->failed;
    }

    /**
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }
}