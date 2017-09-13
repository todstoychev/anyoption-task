<?php

namespace framework\models\Provider;

use framework\models\Entity\User;
use framework\models\Mapper\UserMapper;
use framework\models\UserModel;

class UserProvider
{
    /**
     * @var  \framework\models\UserModel
     */
    private $model;

    /**
     * @var \framework\models\Mapper\UserMapper
     */
    private $mapper;

    /**
     * UserProvider constructor.
     *
     * @param \framework\models\UserModel $model
     * @param \framework\models\Mapper\UserMapper $mapper
     */
    public function __construct(UserModel $model, UserMapper $mapper)
    {
        $this->model = $model;
        $this->mapper = $mapper;
    }

    /**
     * @param int $id
     *
     * @return \framework\models\Entity\User
     */
    public function getUser(int $id): User
    {
        $data = $this->model->getUserData($id);
        $data['id'] = $id;

        return $this->mapper->map($data);
    }
}