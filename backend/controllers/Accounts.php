<?php

namespace backend\controllers;

use framework\components\AbstractController;
use framework\models\UserModel;
use Symfony\Component\HttpFoundation\Request;

class Accounts extends AbstractController
{
    private $model;

    /**
     * Accounts constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->model = new UserModel();
    }

    public function getUser(int $uid)
    {
        $result =
            $this->get('provider.user')
                 ->getUser($uid)
        ;

        return $this->view('accounts.html.twig', ['user' => $result]);
    }
}