<?php

namespace Home\LocationService\UI\Http\Actions;

use Home\LocationService\Application\Location\LocationService;
use Home\LocationService\Infrastructure\Persistence\Location\LocationDbQuery;
use Home\LocationService\UI\Http\NotFoundResponse;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class Location
 * @package Home\LocationService\UI\Http\Actions
 */
class Location extends BaseAction
{
    /**
     * @var LocationService
     */
    private $locationQuery;

    /**
     * Location constructor.
     * @param LocationDbQuery $locationQuery
     */
    public function __construct(LocationDbQuery $locationQuery)
    {
        $this->locationQuery = $locationQuery;
    }

    /**
     * @param ServerRequest $request
     * @return ResponseInterface
     */
    public function __invoke(ServerRequest $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $location = $this->locationQuery->findById($id);
        if (!$location) {
            $response = new NotFoundResponse([
                'message' => 'Location could not be found',
                'details' => ['id' => $id]
            ]);
            return new JsonResponse($response, $response->getCode(), $this->defaultHeaders());
        }

        return new JsonResponse($location, 200, $this->defaultHeaders());
    }
}