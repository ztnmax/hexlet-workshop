<?php
/**
 * Created by PhpStorm.
 * User: zmax
 * Date: 15.09.18
 * Time: 8:22
 */

namespace ZtnMax\HexletWorkshop;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class IPApiService
{
    const URL = 'http://ip-api.com/json/';
    private $httpClient;

    public function __construct(?ClientInterface $client = null)
    {
        $this->httpClient = $client ?? new Client();
    }

    public function getDataByIP(string $ip): GeoData
    {
        $response = $this->httpClient->request('GET', self::URL . $ip);
        $data = $this->decode($response->getBody());
        $this->validate($data);
        return new GeoData($data['country'], $data['city'], $data['zip']);
    }

    private function decode($rowData)
    {
        return json_decode($rowData, true);
    }

    private function validate(array $data)
    {
        if (!$data) {
            throw new \Exception('Response is empty');
        }

        if (!array_key_exists('status', $data)) {
            throw new \Exception('Incorrect response format');
        }

        if ($data['status'] !== 'success') {
            throw new \Exception('Service error');
        }
    }
}