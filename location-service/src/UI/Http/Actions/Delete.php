<?php

namespace Home\LocationService\UI\Http\Actions;

use Home\LocationService\Application\CommandValidationException;
use Home\LocationService\Application\Location\Commands\DeleteLocationCommand;
use Home\LocationService\Application\Location\LocationService;
use Home\LocationService\Domain\Location\Exception\LocationNotFoundException;
use Home\LocationService\UI\Http\{BadRequestResponse, NotFoundResponse};
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequest;

class Delete extends BaseAction
{
    /**
     * @var LocationService
     */
    private $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function __invoke(ServerRequest $request): ResponseInterface
    {
        try {
            $id = $request->getAttribute('id');
            $command = new DeleteLocationCommand($id);
            $this->locationService->delete($command);
        } catch (CommandValidationException $e) {
            $response = new BadRequestResponse($e->getErrors());
            return new JsonResponse($response, $response->getCode(), $this->defaultHeaders());
        } catch (LocationNotFoundException $e) {
            $response = new NotFoundResponse([
                'message' => 'Location could not be found',
                'details' => ['id' => $command->id]
            ]);
            return new JsonResponse($response, $response->getCode(), $this->defaultHeaders());
        }

        return new JsonResponse($id, 200, $this->defaultHeaders());
    }
}