<?php
/**
 * Created by PhpStorm.
 * User: zmax
 * Date: 16.09.18
 * Time: 7:43
 */
namespace ZtnMax\HexletWorkshop\Weather;

class App
{
    private $services;
    private $httpClient;

    public function __construct(array $options = [])
    {
        $this->httpClient = $options['httpClient'] ?? null;
        $services = array_merge($options['services'] ?? [], [
            'first_weather' => FirstWeatherService::class,
            'second_weather' => SecondWeatherService::class,
        ]);

        $this->services = $this->createServices($services);
    }

    public function getDataByCity(string $city, string $serviceName = null): WeatherData
    {
        $serviceName = $serviceName ?? 'first_weather';
        return $this->getService($serviceName)->getData(['city' => $city]);
    }

    private function createServices(array $services): array {
        return array_map(function($class) {
            $service = new $class($this->httpClient);
            if (!($service instanceof IWeatherService)) {
                throw new \Exception('Incorrect service class');
            }
            return $service;
        }, $services);
    }

    private function getService(string $serviceName): IWeatherService
    {
        if (!array_key_exists($serviceName, $this->services)) {
            throw new \Exception('Service not supported');
        }

        return $this->services[$serviceName];
    }
}