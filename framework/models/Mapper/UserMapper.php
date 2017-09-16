<?php

namespace framework\models\Mapper;

use Carbon\Carbon;
use framework\DataProcessor\BirthDateProcessor;
use framework\DataProcessor\UserNameProcessor;
use framework\models\Entity\User;

class UserMapper
{
    /**
     * @var \framework\DataProcessor\UserNameProcessor
     */
    protected $userNameProcessor;

    /**
     * @var \framework\DataProcessor\BirthDateProcessor
     */
    protected $birthDateProcessor;

    /**
     * UserMapper constructor.
     *
     * @param \framework\DataProcessor\UserNameProcessor $userNameProcessor
     * @param \framework\DataProcessor\BirthDateProcessor $birthDateProcessor
     */
    public function __construct(UserNameProcessor $userNameProcessor, BirthDateProcessor $birthDateProcessor)
    {
        $this->userNameProcessor = $userNameProcessor;
        $this->birthDateProcessor = $birthDateProcessor;
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
               ->setBirthDate($this->birthDateProcessor->process($data['birth_date']))
        ;

        return $entity;
    }
}