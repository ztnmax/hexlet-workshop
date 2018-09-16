<?php
/**
 * Created by PhpStorm.
 * User: zmax
 * Date: 16.09.18
 * Time: 7:43
 */
namespace ZtnMax\HexletWorkshop\Weather;

use GuzzleHttp\ClientInterface;

class App
{
    private $service;

    public function __construct(string $serviceName = null, ClientInterface $httpClient = null)
    {
        $this->service = WeatherServiceFactory::createService($serviceName, $httpClient);
    }

    public function getDataByCity(string $city): WeatherData
    {
        return $this->service->getData($city);
    }
}