<?php

require_once __DIR__ . '/../bootstrap/app.php';

$app->getContainer()->get('db');
$app->run();
