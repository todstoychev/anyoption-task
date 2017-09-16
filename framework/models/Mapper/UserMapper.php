<?php

namespace framework\models\Mapper;

use Carbon\Carbon;
use framework\DataProcessor\UserNameProcessor;
use framework\models\Entity\User;

class UserMapper
{
    /**
     * @var \framework\DataProcessor\UserNameProcessor
     */
    protected $userNameProcessor;

    public function __construct(UserNameProcessor $userNameProcessor)
    {
        $this->userNameProcessor = $userNameProcessor;
    }

    /**
     * @param array $data
     *
     * @return \framework\models\Entity\User
     */
    public function map(array $data): User
    {
        $entity = new User();
        $entity->setId($data['id'])
               ->setName($this->userNameProcessor->process($data['name']))
               ->setEmail($data['email'])
               ->setBirthDate(Carbon::createFromTimestamp(strtotime($data['birth_date'])))
        ;

        return $entity;
    }
}