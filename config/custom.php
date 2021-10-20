<?php

$dt = new DateTime(null, new DateTimeZone("UTC"));
return [
  'url_api_v2' => 'http://sirs.kemkes.go.id/fo/index.php/LapV2/',
  'url_api' => 'http://sirs.kemkes.go.id/fo/index.php/',
  'headers' => [
    'X-rs-id' => '1671347',
    'X-Timestamp' => $dt->getTimestamp(),
    'X-pass' => '112233'
  ]
];