<?php

namespace Home\LocationService\Application;

interface CommandValidatorInterface
{
    /**
     * @param array $input
     * @param array $rules
     * @return mixed
     */
    public function validate(array $input, array $rules);

    /**
     * @return bool
     */
    public function fails(): bool;

    /**
     * @return array
     */
    public function errors(): array;
}