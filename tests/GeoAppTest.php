<?php

namespace ZtnMax\HexletWorkshop\Tests;

use \PHPUnit\Framework\TestCase;
use \ZtnMax\HexletWorkshop\GeoApp;
use \ZtnMax\HexletWorkshop\IPApiService;

class UserTest extends TestCase
{
    public function testGetDataByIp()
    {
        $ip = '178.167.54.177';
        $expectedData = [
            'country' => 'Russia',
            'city' => 'Noginsk',
            'zip' => '142400'
        ];

        $app = new GeoApp(new IPApiService());
        $geoData = $app->getDataByIP($ip);
        $this->assertEquals($expectedData, [
            'country' => $geoData->getCountry(),
            'city' => $geoData->getCity(),
            'zip' => $geoData->getZip()
        ]);
    }
}
