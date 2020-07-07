<?php

use App\Controllers\DailyController;

$app->get('/', DailyController::class . ':index');
$app->get('/weekly', WeeklyController::class . ':index');

$app->get('/api/daily/get-menus', DailyController::class . ':get_menus');
$app->post('/api/daily/set-stock', DailyController::class . ':set_stock');
$app->get('/api/weekly/get-menus', WeeklyController::class . ':get_menus');
