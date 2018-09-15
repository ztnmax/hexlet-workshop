<?php
/**
 * Created by PhpStorm.
 * User: zmax
 * Date: 15.09.18
 * Time: 7:56
 */

namespace ZtnMax\HexletWorkshop;

class GeoData
{
    private $country;
    private $city;
    private $zip;

    public function __construct(string $country, string $city, string $zip)
    {
        $this->country = $country;
        $this->city = $city;
        $this->zip = $zip;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getZip(): string
    {
        return $this->zip;
    }
}