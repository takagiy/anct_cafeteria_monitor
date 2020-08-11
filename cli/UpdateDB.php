<?php

require_once __DIR__.'../bootstrap/app.php';
$app->getContainer()->get('db');

use Cli\Helpers\DBManager;

$manager = new DBManager();
//$manager->updateDate();
$manager->resetStocks();
//$manager->fillPermanents(14);
