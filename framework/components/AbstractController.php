<?php

namespace framework\components;

use Symfony\Component\DependencyInjection\{
    ContainerAwareInterface, ContainerAwareTrait, ContainerInterface
};
use Symfony\Component\HttpFoundation\Request;

class AbstractController implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @var Request
     */
    protected $request;

    /**
     * AbstractController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $service
     *
     * @return object
     */
    public function get(string $service)
    {
        return $this->container->get($service);
    }

    /**
     * @param string $view
     * @param array $data
     *
     * @return mixed
     */
    public function view(string $view, array $data = [])
    {
        return $this->get('view')
                    ->render($view, $data)
            ;
    }
}