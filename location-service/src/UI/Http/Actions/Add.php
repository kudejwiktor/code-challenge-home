<?php

namespace Home\LocationService\UI\Http\Actions;

use Home\LocationService\Application\Location\Commands\AddLocationCommand;
use Home\LocationService\Application\CommandValidationException;
use Psr\Http\Message\{RequestInterface, ResponseInterface};
use Zend\Diactoros\Response\JsonResponse;
use Home\LocationService\Application\Location\LocationService;
use Home\LocationService\UI\Http\BadRequestResponse;

class Add extends BaseAction
{
    /**
     * @var LocationService
     */
    private $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $request): ResponseInterface
    {
        try {
            $parameters = $request->getQueryParams();
            $command = new AddLocationCommand(
                $parameters['name'],
                $parameters['street'],
                $parameters['suit_number'],
                $parameters['postal_code'],
                $parameters['city'],
                $parameters['latitude'],
                $parameters['longitude']
            );
            $location = $this->locationService->add($command);
        } catch (CommandValidationException $e) {
            $response = new BadRequestResponse($e->getErrors());
            return new JsonResponse($response, $response->getCode(), $this->defaultHeaders());
        }

        return new JsonResponse($location->getId(), 200, $this->defaultHeaders());
    }
}