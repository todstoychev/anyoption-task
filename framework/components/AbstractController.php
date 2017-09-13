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
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}