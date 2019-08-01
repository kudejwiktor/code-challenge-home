<?php

use Doctrine\Common\Cache\FilesystemCache;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;
use Home\LocationService\Application\Services\Google\HomePlLocationFinder;
use Home\LocationService\Application\CommandValidatorInterface;
use Home\LocationService\Infrastructure\Utils\Validator\CommandValidator;
use Home\LocationService\Infrastructure\Persistence\Services\Google\PlaceService;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\DoctrineCacheStorage;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;


return [
    CommandValidatorInterface::class => function () {
        return new CommandValidator();
    },

    HomePlLocationFinder::class => function () {
        $googlePlaceConfig = config('google')['place'];

        $stack = HandlerStack::create();
        $stack->push(new CacheMiddleware(), 'cache');
        $stack->push(
            new CacheMiddleware(
                new GreedyCacheStrategy(
                    new DoctrineCacheStorage(
                        new FilesystemCache($googlePlaceConfig['cache']['savePath'])
                    ),
                    $googlePlaceConfig['cache']['lifeTime']
                )
            ),
            'greedy-cache'
        );

        $client = new \GuzzleHttp\Client([
            'base_uri' => $googlePlaceConfig['uri'],
            'query' => ['key' => $googlePlaceConfig['key']],
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
            ],
            RequestOptions::TIMEOUT => $googlePlaceConfig['timeout'],
            'handler' => $stack
        ]);

        return new PlaceService($client);
    },

    ParagonIE\EasyDB\EasyDB::class => function () {
        $dbConfig = config('db');

        return ParagonIE\EasyDB\Factory::fromArray([
            'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['dbname'],
            $dbConfig['user'],
            $dbConfig['password']
        ]);
    },
];
