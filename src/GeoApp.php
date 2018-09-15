<?php
/**
 * Created by PhpStorm.
 * User: zmax
 * Date: 15.09.18
 * Time: 7:42
 */

namespace ZtnMax\HexletWorkshop;

class GeoApp
{
    private $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function getDataByIP(string $ip): GeoData
    {
        return $this->service->getDataByIP($ip);
    }
}