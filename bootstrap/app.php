<?php

use Dotenv\Dotenv;
use Slim\Views\Twig;
use Slim\Factory\AppFactory;
use Slim\Views\TwigExtension;
use Slim\Psr7\Factory\UriFactory;
use Illuminate\Database\Capsule\Manager as Capsule;
use Dotenv\Exception\InvalidPathException;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    (new Dotenv(__DIR__ . '/../'))->load();
} catch (InvalidPathException $e) {
    //
}

$settings = require __DIR__ . '/../config/settings.php';

$container = new DI\Container();

AppFactory::setContainer($container);

$app = AppFactory::create();

$container->set('settings', function () {
  return $settings;
});

$container->set('db', function ($container) {
  $capsule = new Capsule;
  $capsule->addConnection($container->get('settings')['db']);

  $capsule->setAsGlobal();
  $capsule->bootEloquent();

  return $capsule;
});

$container->set('view', function ($container) use ($app) {
    $twig = new Twig(__DIR__ . '/../resources/views', [
        'cache' => false
    ]);

    $twig->addExtension(
        new TwigExtension(
            $app->getRouteCollector()->getRouteParser(),
            (new UriFactory)->createFromGlobals($_SERVER),
            '/'
        )
    );

    return $twig;
});

require_once __DIR__ . '/../routes/web.php';
