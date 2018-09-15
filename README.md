# Hexlet workshop
## Библиотека для получения geo данных
Пример использования:
```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use \ZtnMax\HexletWorkshop\GeoApp;
use \ZtnMax\HexletWorkshop\IPApiService;

$app = new GeoApp(new IPApiService());
$geoData = $app->getDataByIP($ip);

echo implode(' ', [
  'country' => $geoData->getCountry(),
  'city' => $geoData->getCity(),
  'zip' => $geoData->getZip()
]);
```