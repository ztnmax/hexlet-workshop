<?php
/**
 * Created by PhpStorm.
 * User: zmax
 * Date: 16.09.18
 * Time: 10:32
 */

namespace ZtnMax\HexletWorkshop\Weather;

use GuzzleHttp\ClientInterface;

interface IWeatherService
{
    public function __construct(?ClientInterface $client = null);
    public function getData(array $params = []): WeatherData;
}