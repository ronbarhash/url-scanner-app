<?php

//Подключаем автозагрузчик Composer
require 'vendor/autoload.php';

use League\Csv\Reader;
use League\Csv\Statement;
// Создаем экземплр http-клиента Guzzle
$client = new \GuzzleHttp\Client();

//Открыть файл CSV и обойти его содержимое
$csv = Reader::createFromPath($argv[1], 'r');
$csv->setDelimiter(';');
$records = $csv->getRecords();

foreach ($csv as $record) {
    try {
        $httpResponse = $client->request('GET', $record[0]);

        if ($httpResponse->getStatusCode() >= 400) {
            throw new \Exeption();
        }
        echo $record[0], ", status: ", $httpResponse->getStatusCode(), PHP_EOL;
    } catch (\Exeption $e) {
        echo $record . PHP_EOL;
    }
}




