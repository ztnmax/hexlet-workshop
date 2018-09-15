<?php
/**
 * Created by PhpStorm.
 * User: zmax
 * Date: 15.09.18
 * Time: 8:22
 */

namespace ZtnMax\HexletWorkshop;

class IPApiService extends Service
{
    const URL = 'http://ip-api.com/json/';

    public function getDataByIP(string $ip): GeoData
    {
        $resp = $this->query(['ip' => $ip]);
        $data = $this->decode($resp);
        $this->validate($data);
        return new GeoData($data['country'], $data['city'], $data['zip']);
    }

    private function query(array $params)
    {
        $query = array_key_exists('ip', $params) ? $params['ip'] : '';
        return file_get_contents(self::URL . $query);
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