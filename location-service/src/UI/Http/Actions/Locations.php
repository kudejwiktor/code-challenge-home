<?php

namespace Home\LocationService\UI\Http\Actions;

use Home\LocationService\Application\Location\LocationService;
use Home\LocationService\Application\Query\Location\Filters\Php\{DistanceFilter, NameOrAddressFilter};
use Home\LocationService\Application\Services\Google\HomePlLocationFinder;
use Home\LocationService\Infrastructure\Persistence\Location\LocationDbQuery;
use Home\LocationService\UI\Http\{
    Exception\UnauthorizedRequestException,
    Exception\BadRequestException,
    Exception\InternalServerErrorException,
    Exception\NotFoundException,
    BadRequestResponse,
    InternalServerErrorResponse,
    NotFoundResponse,
    UnauthorizedRequestResponse,
};
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class Locations
 * @package Home\LocationService\UI\Http\Actions
 */
class Locations extends BaseAction
{
    /**
     * @var LocationService
     */
    private $locationQuery;

    /**
     * @var HomePlLocationFinder
     */
    private $locationFinder;

    /**
     * Locations constructor.
     * @param LocationDbQuery $locationQuery
     * @param HomePlLocationFinder $locationFinder
     */
    public function __construct(LocationDbQuery $locationQuery, HomePlLocationFinder $locationFinder)
    {
        $this->locationQuery = $locationQuery;
        $this->locationFinder = $locationFinder;
    }

    /**
     * @param ServerRequest $request
     * @return ResponseInterface
     */
    public function __invoke(ServerRequest $request): ResponseInterface
    {
        try {
            $filters = $this->mapFilters($request);
            $locations = $this->locationQuery->findByFilters($filters);

            if (empty($locations)) {
                $response = new NotFoundResponse([
                    'message' => 'Locations could not be found',
                ]);

                return new JsonResponse($response, $response->getCode(), $this->defaultHeaders());
            }
        } catch (NotFoundException $e) {
            $response = new NotFoundResponse([
                'message' => 'Locations could not be found',
            ]);

            return new JsonResponse($response, $response->getCode(), $this->defaultHeaders());
        } catch (BadRequestException $e) {
            $response = new BadRequestResponse([
                'message' => $e->getMessage()
            ]);

            return new JsonResponse($response, $response->getCode(), $this->defaultHeaders());
        } catch (UnauthorizedRequestException $e) {
            $response = new UnauthorizedRequestResponse([
                'message' => $e->getMessage()
            ]);

            return new JsonResponse($response, $response->getCode(), $this->defaultHeaders());
        } catch (InternalServerErrorException $e) {
            $response = new InternalServerErrorResponse([
                'message' => $e->getMessage()
            ]);

            return new JsonResponse($response, $response->getCode());
        }

        return new JsonResponse($locations, 200, $this->defaultHeaders());
    }

    /**
     * @param ServerRequest $request
     * @return array
     */
    private function mapFilters(ServerRequest $request): array
    {
        $filters = [];
        $parameters = $request->getQueryParams();

        if ($parameters['distance'] && is_numeric($parameters['distance'])) {
            $homePlLocation = $this->locationFinder->findByName(config('company')['name']);

            $filters[] = new DistanceFilter(
                $parameters['distance'],
                $homePlLocation->getLatitude(),
                $homePlLocation->getLongitude()
            );
        }

        if ($parameters['text']) {
            $filters[] = new NameOrAddressFilter($parameters['text']);
        }

        return $filters;
    }
}