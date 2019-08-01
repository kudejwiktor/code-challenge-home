<?php

namespace Home\LocationService\Application;


class CommandValidation
{
    /**
     * @var array
     */
    protected $rules;

    /**
     * @var CommandValidationInterface
     */
    protected $validator;

    /**
     * CommandValidation constructor.
     * @param CommandValidatorInterface $validator
     */
    public function __construct(CommandValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param Command $command
     * @return CommandValidation|null
     */
    public function loadValidator(Command $command)
    {
        $fullReference = explode('\\', get_class($command));
        $commandName = array_pop($fullReference);
        $validatorName = str_replace('Command', 'Validator', $commandName);
        $validatorClass = implode('\\', $fullReference) . '\\' . $validatorName;

        if (class_exists($validatorClass)) {
            return new $validatorClass($this->validator);
        }

        return null;
    }

    /**
     * @param Command $command
     * @throws CommandValidationException
     */
    public function validate(Command $command)
    {
        $this->validator->validate((array)$command, $this->rules);
        if ($this->validator->fails()) {
            throw new CommandValidationException($this->validator->errors());
        }
    }
}