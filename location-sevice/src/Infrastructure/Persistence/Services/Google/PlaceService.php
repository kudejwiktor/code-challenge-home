<?php

namespace Home\LocationService\Infrastructure\Persistence\Services\Google;

use GuzzleHttp\Client;
use Home\LocationService\Application\Query\Location\LocationView;
use Home\LocationService\Application\Services\Google\HomePlLocationFinder;
use Home\LocationService\UI\Http\{
    BadRequestException,
    InternalServerErrorException,
    NotFoundException,
    UnauthorizedRequestException
};

/**
 * Class PlaceService
 * @package Home\LocationService\Infrastructure\Persistence\Services\Google
 */
class PlaceService implements HomePlLocationFinder
{
    /**
     * @var Client
     */
    private $client;

    /**
     * URI for google places api
     */
    private const uri = "/maps/api/place";

    /**
     * Google success status code
     */
    private const STATUS_200 = 'OK';

    /**
     * Google empty status response
     */
    private const STATUS_204 = 'ZERO_RESULTS';

    /**
     *  Google bad request status code
     */
    private const STATUS_400 = 'INVALID_REQUEST';

    /**
     * Google unauthorized request status code
     */
    private const STATUS_401 = 'REQUEST_DENIED';

    /**
     * Google server-side error status code
     */
    private const STATUS_500 = 'UNKNOWN_ERROR';

    /**
     * Status thrown when incorrect uri given
     */
    private const WEB_SERVICE_NOT_FOUND_CODE = 404;

    /**
     * PlaceService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $uri
     * @param array $query
     * @return mixed|null
     * @throws NotFoundException
     * @throws BadRequestException
     * @throws UnauthorizedRequestException
     * @throws InternalServerErrorException
     */
    private function request(string $uri, array $query)
    {
        try {
            $request = $this->client->get(self::uri . $uri, ['query' => $query]);
            $response = json_decode($request->getBody()->getContents());

            if ($request->getStatusCode() === self::WEB_SERVICE_NOT_FOUND_CODE) {
                throw new NotFoundException('Google Places web service could not be found');
            }

            switch ($response->status) {
                case self::STATUS_200:
                    return $response->candidates[0];

                case self::STATUS_204;
                    return null;

                case self::STATUS_400:
                    throw new BadRequestException('Invalid request data given');

                case self::STATUS_401:
                    throw new UnauthorizedRequestException('Request could not be authorized');

                case self::STATUS_500:
                    throw new InternalServerErrorException('Request could not be processed due to Google places server-side error');
            }
        } catch (\Exception $e) {
            throw new InternalServerErrorException('Server-side error');
        }
    }

    /**
     * @param string $name
     * @return LocationView
     * @throws NotFoundException
     * @throws BadRequestException
     * @throws UnauthorizedRequestException
     * @throws InternalServerErrorException
     * @throws \Exception
     */
    public function findByName(string $name): LocationView
    {
        $query = array_merge(
            $this->client->getConfig('query'), [
                'input' => $name,
                'inputtype' => 'textquery',
                'fields' => 'geometry,name,formatted_address'
            ]
        );

        $response = $this->request("/findplacefromtext/json", $query);

        return LocationView::fromGooglePlaces($response);
    }
}