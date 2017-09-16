<?php

namespace Tests\framework\DataProcessor;

use framework\DataProcessor\UserNameProcessor;
use PHPUnit\Framework\TestCase;

class UserNameProcessorTest extends TestCase
{
    /**
     * @var \framework\DataProcessor\UserNameProcessor
     */
    private $dataProcessor;

    public function setUp()
    {
        $this->dataProcessor = new UserNameProcessor();
    }

    public function testProcessNames()
    {
        $firstName = 'test';
        $lastName = 'name';
        $name = $this->dataProcessor->process($lastName.', '.$firstName);

        self::assertEquals($firstName.' '.$lastName, $name);

        $name = $this->dataProcessor->process($lastName.' '.$firstName);

        static::assertEquals(' '.$lastName.' '.$firstName, $name);

        $name = $this->dataProcessor->process($lastName.','.$firstName);

        self::assertEquals($firstName.' '.$lastName, $name);
    }
}
