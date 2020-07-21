<?php

use App\Controllers\DailyController;
use App\Controllers\WeeklyController;

$app->get('/team5/index.php', DailyController::class.':index');
$app->get('/team5/weekly.php', WeeklyController::class.':index');

$app->get('/team5/api/daily/get-menus.php', DailyController::class.':get_menus');
$app->post('/team5/api/daily/set-stock.php', DailyController::class.':set_stock');
$app->get('/team5/api/weekly/get-menus.php', WeeklyController::class.':get_menus');
