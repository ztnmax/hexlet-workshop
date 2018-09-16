<?php
/**
 * Created by PhpStorm.
 * User: zmax
 * Date: 16.09.18
 * Time: 8:11
 */

namespace ZtnMax\HexletWorkshop\Weather;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class FirstWeatherService
{
    const URL = 'https://www.metaweather.com/api/location/';
    private $httpClient;

    public function __construct(?ClientInterface $client = null)
    {
        $this->httpClient = $client ?? new Client();
    }

    public function getData(string $city): WeatherData
    {
        if (!$city === '') {
            throw new \Exception('City can\'t be empty');
        }

        $response = $this->httpClient->request('GET', $this->getUrlByCity($city));
        return $this->parse($response->getBody());
    }

    private function parse(string $json): WeatherData
    {
        $weatherData = json_decode($json, true);
        $weather = $weatherData["consolidated_weather"][0];
        return new WeatherData($weather['the_temp'], $weather['wind_speed']);
    }

    private function getUrlByCity(string $city): string
    {
        return self::URL . $this->getCityId($city);
    }

    private function getCityId(string $city)
    {
        $url = self::URL . 'location/search/?query=' . $city;
        $response = $this->httpClient->request('GET', $url);
        $json = json_decode($response->getBody());

        if (!$json) {
            throw new \Exception('City not found');
        }

        return $json[0]->woeid;
    }
}