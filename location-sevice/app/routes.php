<?php

use \FastRoute\RouteCollector;

return function (RouteCollector $router) {
    $router->addGroup('/rest', function (RouteCollector $r) {
        $r->get('/locations/{id}', 'Home\LocationService\UI\Http\Actions\Location');
        $r->get('/locations', 'Home\LocationService\UI\Http\Actions\Locations');
        $r->addRoute( 'POST', '/add', 'Home\LocationService\UI\Http\Actions\Add');
        $r->addRoute('PUT', '/update/{id}', 'Home\LocationService\UI\Http\Actions\Update');
        $r->addRoute('DELETE', '/delete/{id}', 'Home\LocationService\UI\Http\Actions\Delete');
    });
};