<?php

namespace ZtnMax\HexletWorkshop\Tests;

use \PHPUnit\Framework\TestCase,
    \ZtnMax\HexletWorkshop\IPApiService,
    \GuzzleHttp\ClientInterface,
    \Psr\Http\Message\ResponseInterface;

class GeoAppTest extends TestCase
{
    public function testGetDataByIp()
    {
        $response = file_get_contents(__DIR__.'/fixtures/ipApiResponse.json');
        $client = $this->createHttpClient($response);
        $ip = '178.167.54.177';
        $expectedData = [
            'country' => 'Russia',
            'city' => 'Noginsk',
            'zip' => '142400'
        ];

        $service = new IPApiService($client);
        $geoData = $service->getDataByIP($ip);
        $this->assertEquals($expectedData, [
            'country' => $geoData->getCountry(),
            'city' => $geoData->getCity(),
            'zip' => $geoData->getZip()
        ]);
    }

    private function createHttpClient(string $body): ClientInterface
    {
        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->method('getBody')->willReturn($body);

        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient->method('request')->willReturn($httpResponse);

        return $httpClient;
    }
}
