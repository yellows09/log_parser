<?php
include 'CountData.php';

$logFIle = file_get_contents(FILE_NAME);

$start = new CountData($logFIle);

echo $start->toJson($start->countViews(),
    $start->countUniqueURL(),
    $start->countTraffic(),
    $start->countCrawlers(["Googlebot", "Yandexbot"]),
    $start->countStatusCodes([200, 301]));