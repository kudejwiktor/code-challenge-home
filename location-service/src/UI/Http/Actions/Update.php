<?php
namespace Home\LocationService\UI\Http\Actions;


use Home\LocationService\Application\{
    CommandValidationException,
    Location\Commands\UpdateLocationCommand,
    Location\LocationService
};
use Home\LocationService\UI\Http\{
    BadRequestResponse,
    NotFoundResponse
};
use Psr\Http\Message\{
    RequestInterface,
    ResponseInterface
};
use Home\LocationService\Domain\Location\Exception\LocationNotFoundException;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class Update
 * @package Home\LocationService\UI\Http\Actions
 */
class Update extends BaseAction
{
    /**
     * @var LocationService
     */
    private $locationService;

    /**
     * Update constructor.
     * @param LocationService $locationService
     */
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
            $id = $request->getAttribute('id');
            $parameters = $request->getQueryParams();
            $command = new UpdateLocationCommand(
                $id,
                $parameters['name'],
                $parameters['street'],
                $parameters['suit_number'],
                $parameters['postal_code'],
                $parameters['city'],
                $parameters['latitude'],
                $parameters['longitude']
            );
            $location = $this->locationService->update($command);
        } catch (CommandValidationException $e) {
            $response = new BadRequestResponse($e->getErrors());
            return new JsonResponse($response, $response->getCode(), $this->defaultHeaders());
        } catch (LocationNotFoundException $e) {
            $response = new NotFoundResponse([
                'Location could not be found',
                'data' => ['id' => $command->id]
            ]);
            return new JsonResponse($response, $response->getCode(), $this->defaultHeaders());
        }

        return new JsonResponse($location->getId(), 200, $this->defaultHeaders());
    }
}