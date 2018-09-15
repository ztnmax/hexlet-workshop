<?php
/**
 * Created by PhpStorm.
 * User: zmax
 * Date: 15.09.18
 * Time: 8:18
 */

namespace ZtnMax\HexletWorkshop;

abstract class Service
{
    abstract function getDataByIP(string $ip): GeoData;
}