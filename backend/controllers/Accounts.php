<?php

namespace backend\controllers;

use framework\models\UserModel;

class Accounts
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function getUserAction($uid)
    {
        $result = $this->model->getUserData($uid);

        return $result;
    }
}