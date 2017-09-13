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
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->model = new UserModel();
    }

    public function getUser($uid)
    {
        $result = $this->model->getUserData($uid);

        return json_encode($result);
    }
}