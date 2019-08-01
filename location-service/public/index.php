<?php

use Middlewares\{FastRoute, RequestHandler};
use Relay\Relay;
use Zend\Diactoros\ServerRequestFactory;
use Narrowspark\HttpEmitter\SapiEmitter;
use function FastRoute\simpleDispatcher;
/**
 * @var $container \DI\Container
 */
$container = require __DIR__ . '/../app/bootstrap.php';
$routes = require __DIR__ . '/../app/routes.php';

$router = simpleDispatcher($routes);

$middlewareQueue[] = new FastRoute($router);
$middlewareQueue[] = new RequestHandler($container);

$requestHandler = new Relay($middlewareQueue);
$response = $requestHandler->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();


return $emitter->emit($response);

$a = $container->get(ParagonIE\EasyDB\EasyDB::class);



$rawLocation = $a->run('SELECT count(*) as cnt FROM location WHERE id = ?', "dbf476cd-a6db-494b-8563-d2bd90b73659");

$a->insert('location', [
    'id' => 'rwerw',
    'city' => 'fsf',
    'name' => 'das',
    'suite_number' => 1,
    'latitude' => 14.22,
    'longitude' => 54.122,
    'postal_code' => '44-112',
    'street' => 'dasd',
]);
dd($rawLocation);
