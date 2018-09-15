<?php

namespace ZtnMax\HexletWorkshop\Tests;

use \PHPUnit\Framework\TestCase,
    \ZtnMax\HexletWorkshop\IPApiService,
    \GuzzleHttp\ClientInterface,
    \Psr\Http\Message\ResponseInterface;

class UserTest extends TestCase
{
    public function testGetDataByIp()
    {
        $client = $this->createHttpClient('{"as":"AS21453 Flex Ltd.","city":"Noginsk","country":"Russia","countryCode":"RU","isp":"Flex Ltd","lat":55.8536,"lon":38.4411,"org":"Wireless network in Moscow region","query":"178.167.54.177","region":"MOS","regionName":"Moscow Oblast","status":"success","timezone":"Europe/Moscow","zip":"142400"}');
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
