<?php

namespace Tests\framework\models\Provider;

use framework\Exception\ModelNotFoundException;
use framework\models\Entity\User;
use framework\models\Mapper\UserMapper;
use framework\models\Provider\UserProvider;
use framework\models\UserModel;
use PHPUnit\Framework\TestCase;

class UserProviderTest extends TestCase
{
    /**
     * @var \framework\models\Provider\UserProvider
     */
    private $userProvider;

    /**
     * @var \framework\models\UserModel
     */
    private $model;

    /**
     * @var \framework\models\Mapper\UserMapper
     */
    private $mapper;

    /**
     * @var array
     */
    private $data = [
        'id' => 1,
        'name' => 'name, user',
        'email' => 'user@email.com',
        'birth_date' => '1992-02-23',
    ];

    protected function setUp()
    {
        $this->model = static::createMock(UserModel::class);
        $this->mapper = static::createMock(UserMapper::class);
        $this->userProvider = new UserProvider($this->model, $this->mapper);

        $this->mapper->method('map')
                     ->with($this->data)
                     ->willReturn(new User())
        ;
    }

    public function testGetUser()
    {
        $this->model->method('getUser')
                    ->with(1)
                    ->willReturn($this->data)
        ;
        $user = $this->userProvider->getUser(1);

        static::assertInstanceOf(User::class, $user);
    }

    public function testWithNonExistingUser()
    {
        $this->model->method('getUser')
                    ->with(2)
                    ->willThrowException(new ModelNotFoundException('No such user'))
        ;

        static::expectException(ModelNotFoundException::class);

        $this->userProvider->getUser(2);
    }
}
