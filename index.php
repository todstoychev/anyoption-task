<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Debug\Debug;
use Symfony\Component\DependencyInjection\{
    ContainerBuilder, Loader\XmlFileLoader
};
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;

ini_set('display_errors', 1);

require_once __DIR__.'/vendor/autoload.php';

// Debug
Debug::enable();

// Set up request
$request = Request::createFromGlobals();

// Set up DI container
$container = new ContainerBuilder();
$loader = new XmlFileLoader($container, new FileLocator([__DIR__.'/backend/conf']));
$loader->load('services.xml');

// Set up TWIG template engine
$loader = new Twig_Loader_Filesystem([__DIR__.'/backend/views']);
$twig = new Twig_Environment($loader, array(
    'cache' => __DIR__.'/cache/views',
));

$container->set('view', $twig);

// Set up router
$locator = new FileLocator([__DIR__.'/backend/conf']);
$requestContext = new RequestContext('/');
$requestContext->fromRequest($request);

$router = new Router(
    new YamlFileLoader($locator),
    'routes.yml',
    ['cache_dir' => __DIR__.'/cache/routes'],
    $requestContext
);

$container->set('router', $router);
