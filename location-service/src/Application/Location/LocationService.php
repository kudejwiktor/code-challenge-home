<?php

namespace Home\LocationService\Application\Location;

use Home\LocationService\Application\CommandValidation;
use Home\LocationService\Application\Location\Commands\{
    AddLocationCommand,
    DeleteLocationCommand,
    UpdateLocationCommand
};
use Home\LocationService\Domain\Location\{
    Address,
    Location,
    LocationFactory,
    LocationRepository
};
use Home\LocationService\SharedKernel\LocationId\{InvalidLocationIdException, LocationId};
use Home\LocationService\Domain\Location\Exception\LocationNotFoundException;
use Home\LocationService\Application\CommandValidationException;
use Home\LocationService\Infrastructure\Persistence\Location\LocationDbRepository;

class LocationService
{
    /**
     * @var LocationRepository
     */
    private $locationRepository;

    /**
     * @var CommandValidation
     */
    private $validator;

    /**
     * LocationService constructor.
     * @param LocationDbRepository $locationRepository
     * @param CommandValidation $validator
     */
    public function __construct(LocationDbRepository $locationRepository, CommandValidation $validator)
    {
        $this->locationRepository = $locationRepository;
        $this->validator = $validator;
    }

    /**
     * @param AddLocationCommand $command
     * @return LocationId
     * @throws CommandValidationException
     */
    public function add(AddLocationCommand $command): LocationId
    {
        $validator = $this->validator->loadValidator($command);
        $validator->validate($command);
        $address = new Address($command->street, $command->suit_number, $command->postal_code, $command->city);
        $location = Location::add($command->name, $address, $command->longitude, $command->latitude);
        $this->locationRepository->save($location);

        return $location->getId();
    }

    /**
     * @param UpdateLocationCommand $command
     * @return LocationId
     * @throws CommandValidationException
     * @throws LocationNotFoundException
     */
    public function update(UpdateLocationCommand $command): LocationId
    {
        $validator = $this->validator->loadValidator($command);
        $validator->validate($command);

        try {
            $id = LocationId::fromString($command->id);
            $exist = $this->locationRepository->exist($id);
        } catch (InvalidLocationIdException $e) {
            throw LocationNotFoundException::forStringId($command->id);
        }

        if (!$exist) {
            throw LocationNotFoundException::forStringId($command->id);
        }

        $location = LocationFactory::fromArray((array)$command);
        $this->locationRepository->save($location);

        return $location->getId();
    }

    /**
     * @param DeleteLocationCommand $command
     * @return LocationId
     * @throws LocationNotFoundException
     * @throws CommandValidationException
     */
    public function delete(DeleteLocationCommand $command): ?LocationId
    {
        $validator = $this->validator->loadValidator($command);
        $validator->validate($command);

        try {
            $id = LocationId::fromString($command->id);
            $this->locationRepository->delete($id);
        } catch (InvalidLocationIdException $e) {
            throw LocationNotFoundException::forStringId($command->id);
        }

        return $id;
    }
}