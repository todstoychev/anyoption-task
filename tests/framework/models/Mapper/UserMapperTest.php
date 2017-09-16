<?php

namespace Tests\framework\models\Mapper;

use Carbon\Carbon;
use framework\DataProcessor\{
    BirthDateProcessor, UserNameProcessor
};
use framework\models\Entity\User;
use framework\models\Mapper\UserMapper;
use PHPUnit\Framework\TestCase;

class UserMapperTest extends TestCase
{
    /**
     * @var \framework\DataProcessor\UserNameProcessor
     */
    private $userNameProcessor;

    /**
     * @var \framework\DataProcessor\BirthDateProcessor
     */
    private $birthDateProcessor;

    /**
     * @var \framework\models\Mapper\UserMapper
     */
    private $mapper;

    private $data = [
        'id' => 1,
        'name' => 'name, user',
        'email' => 'user@email.com',
        'birth_date' => '1992-02-23',
    ];

    protected function setUp()
    {
        $this->userNameProcessor = static::createMock(UserNameProcessor::class);
        $this->birthDateProcessor = static::createMock(BirthDateProcessor::class);
        $this->mapper = new UserMapper($this->userNameProcessor, $this->birthDateProcessor);
        $this->userNameProcessor->method('process')
                                ->with($this->data['name'])
                                ->willReturn('user name')
        ;
        $this->birthDateProcessor->method('process')
                                ->with($this->data['birth_date'])
                                ->willReturn(Carbon::createFromTimestamp(strtotime($this->data['birth_date'])))
        ;
    }

    public function testDataMapping()
    {
        $user = $this->mapper->map($this->data);

        static::assertInstanceOf(User::class, $user);
        static::assertEquals(1, $user->getId());
        static::assertEquals('user name', $user->getName());
        static::assertEquals('user@email.com', $user->getEmail());
        static::assertInstanceOf(Carbon::class, $user->getBirthDate());
        static::assertEquals($this->data['birth_date'], $user->getBirthDate()->format('Y-m-d'));
    }
}
