<?php
/**
 * Created by PhpStorm.
 * User: zmax
 * Date: 16.09.18
 * Time: 8:08
 */

namespace ZtnMax\HexletWorkshop\Weather;

class WeatherData
{
    private $temp;
    private $windSpeed;

    public function __construct(string $temp, string $windSpeed)
    {
        $this->temp = $temp;
        $this->windSpeed = $windSpeed;
    }

    public function getTemp(): string
    {
        return $this->temp;
    }

    public function getWindSpeed(): string
    {
        return $this->windSpeed;
    }
}