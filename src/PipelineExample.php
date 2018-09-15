<?php
/**
 * Created by PhpStorm.
 * User: zmax
 * Date: 15.09.18
 * Time: 10:32
 */

namespace ZtnMax\HexletWorkshop;

require_once __DIR__ . '/../vendor/autoload.php';

function pipeline($data, array $handlers) {
    return array_reduce($handlers, function($item, $handler){
        return $handler($item);
    }, $data);
}

function plural($str, $symbol) {
    return $str.endsWith('s') ? $str : $str.append($symbol);
}

echo pipeline(\collect(scandir(__DIR__)), [
    function ($files) {
        return $files->filter(function($item){
            return !\s($item)->startsWith('.');
        });
    },
    function ($files) {
        return $files->sort();
    },
    function ($files) {
        return \s($files->get(round($files->count() / 2)));
    },
    function($fileName) {
        return plural($fileName, 's');
    },
    function($fileName) {
        return $fileName.toUpperCase();
    }
]);