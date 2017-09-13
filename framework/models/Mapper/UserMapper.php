<?php

namespace framework\models\Mapper;

use Carbon\Carbon;
use framework\models\Entity\User;

class UserMapper
{
    /**
     * @param array $data
     *
     * @return \framework\models\Entity\User
     */
    public function map(array $data): User
    {
        $entity = new User();
        $entity->setId($data['id'])
               ->setName($this->processName($data['name']))
               ->setEmail($data['email'])
               ->setBirthDate(Carbon::createFromTimestamp(strtotime($data['birth_date'])))
        ;

        return $entity;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    private function processName(string $name): string
    {
        $name = explode(',', $name);
        $lastName = array_shift($name);
        $firstName = array_shift($name);

        return $firstName.' '.$lastName;
    }
}