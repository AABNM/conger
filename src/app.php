<?php

// Register service providers
$app->register(new Silex\Provider\DoctrineServiceProvider(), $app['db.options']);
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/Views', // The path to the templates, which in our case points to htdocs/ox/templates
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.messages' => array(),
));

// Register repositories.
$app['repository.conge'] = $app->share(function ($app) {
    return new App\Model\Repository\CongeRepository($app['db']);
});



