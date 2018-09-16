<?php
/**
 * Created by PhpStorm.
 * User: zmax
 * Date: 16.09.18
 * Time: 8:33
 */

namespace ZtnMax\HexletWorkshop\Tests;

use \PHPUnit\Framework\TestCase,
    \ZtnMax\HexletWorkshop\Weather\App,
    \ZtnMax\HexletWorkshop\Weather\WeatherServiceFactory,
    \GuzzleHttp\ClientInterface,
    \Psr\Http\Message\ResponseInterface;

class WeatherTest extends TestCase
{
    public function testFirstService()
    {
        $client = $this->createHttpClient();
        $city = 'london'; // todo брать значение из fixture

        $expectedData = [
            'temp' => '20.645', // todo брать значение из fixture
            'windSpeed' => '10.05' // todo брать значение из fixture
        ];

        $service = new App(WeatherServiceFactory::FIRST_SERVICE, $client);
        $data = $service->getDataByCity($city);
        $this->assertEquals($expectedData, [
            'temp' => $data->getTemp(),
            'windSpeed' => $data->getWindSpeed()
        ]);
    }

    private function createHttpClient(): ClientInterface
    {
        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient->method('request')->willReturnCallback(function($method, $url = '') {
            $body = $this->getFixtureByUrl($url);
            $httpResponse = $this->createMock(ResponseInterface::class);
            $httpResponse->method('getBody')->willReturn($body);
            return $httpResponse;
        });

        return $httpClient;
    }

    private function getFixtureByUrl($url)
    {
        $fixture = strpos($url, 'query=london') !== false ? 'weatherCityResponse' : 'weatherResponse';
        return file_get_contents(__DIR__."/fixtures/{$fixture}.json");
    }
}
