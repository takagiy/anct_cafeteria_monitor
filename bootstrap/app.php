<?php

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use Illuminate\Database\Capsule\Manager as Capsule;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\UriFactory;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv(__DIR__.'/../'))->load();
} catch (InvalidPathException $e) {
}

$container = new DI\Container();

AppFactory::setContainer($container);

$app = AppFactory::create();

$container->set('settings', function () {
    return [
        'db' => [
            'driver' => 'pgsql',
            'host' => 'localhost',
            'database' => 'team5db',
            'username' => 'team5',
            'password' => '1qazxsw23edc',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ],
    ];
});

$container->set('db', function ($container) {
    $capsule = new Capsule();
    $capsule->addConnection($container->get('settings')['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
});

$container->set('view', function ($container) use ($app) {
    $twig = new Twig(__DIR__.'/../resources/views', [
        'cache' => false,
    ]);

    $twig->addExtension(
        new TwigExtension(
            $app->getRouteCollector()->getRouteParser(),
            (new UriFactory())->createFromGlobals($_SERVER),
            '/'
        )
    );

    return $twig;
});

require_once __DIR__.'/../routes/web.php';

$app->addErrorMiddleware(true, true, true);
