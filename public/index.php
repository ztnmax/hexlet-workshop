<?php
/**
 * Created by PhpStorm.
 * User: zmax
 * Date: 16.09.18
 * Time: 15:57
 */

use \Psr\Http\Message\ResponseInterface as Response,
    \ZtnMax\HexletWorkshop\IPApiService;

require '../vendor/autoload.php';

$app = new \DI\Bridge\Slim\App;

// Разделение частей IP сделано через ":" так как с символом "." есть проблемы у встроенного php сервера
$app->get('/geo/{ip:[:0-9]+}', function ($ip, Response $response, IPApiService $service) {
    $ip = str_replace(':', '.', $ip);
    $geoData = $service->getDataByIP($ip);
    $response->getBody()->write(json_encode([
        'country' => $geoData->getCountry(),
        'city' => $geoData->getCity(),
        'zip' => $geoData->getZip()
    ]));
    return $response;
});

$app->run();