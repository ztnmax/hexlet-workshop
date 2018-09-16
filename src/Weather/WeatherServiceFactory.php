<?php
/**
 * Created by PhpStorm.
 * User: zmax
 * Date: 16.09.18
 * Time: 7:54
 */

namespace ZtnMax\HexletWorkshop\Weather;

use GuzzleHttp\ClientInterface;

class WeatherServiceFactory
{
    const FIRST_SERVICE = 'first_weather';
    const SECOND_SERVICE = 'second_weather';

    private static $services = [
        self::FIRST_SERVICE => FirstWeatherService::class,
        self::SECOND_SERVICE => SecondWeatherService::class,
    ];

    public static function createService(string $serviceName = null, ?ClientInterface $httpClient = null)
    {
        $serviceName = $serviceName ?? self::getDefaultService();
        if (!array_key_exists($serviceName, self::$services)) {
            throw new \Exception('Service not supported');
        }
        return new self::$services[$serviceName]($httpClient);
    }

    public static function getServices()
    {
        return array_keys(self::$services);
    }

    public static function getDefaultService()
    {
        return self::FIRST_SERVICE;
    }
}