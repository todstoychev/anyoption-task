<?php

namespace framework\components;

use Symfony\Component\DependencyInjection\{
    ContainerAwareInterface, ContainerAwareTrait, ContainerInterface
};
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;

class RouteResolver implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @var Router
     */
    private $router;

    public function __construct(Router $router, ContainerInterface $container)
    {
        $this->router = $router;
        $this->container = $container;
    }

    public function resolve(Request $request)
    {
        $options = $this->router->match($request->getPathInfo());
        $parameters = explode(':', $options['_controller']);
        $className = array_shift($parameters);
        $methodName = array_shift($parameters);
        unset($options['_controller']);
        unset($options['_route']);

        echo call_user_func_array([new $className($request), $methodName], $options);
    }
}