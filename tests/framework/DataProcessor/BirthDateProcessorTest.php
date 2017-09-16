<?php

namespace Tests\framework\DataProcessor;

use Carbon\Carbon;
use framework\DataProcessor\BirthDateProcessor;
use PHPUnit\Framework\TestCase;

class BirthDateProcessorTest extends TestCase
{
    /**
     * @var \framework\DataProcessor\BirthDateProcessor
     */
    private $processor;

    const DATE_STRING = '1992-02-23';

    protected function setUp()
    {
        $this->processor = new BirthDateProcessor();
    }

    public function testWithTimestamp()
    {
        $date = strtotime(static::DATE_STRING);
        $result = $this->processor->process($date);

        static::assertInstanceOf(Carbon::class, $result);
        static::assertEquals(static::DATE_STRING, $result->format('Y-m-d'));
    }

    public function testWithDateString()
    {
        $result = $this->processor->process(static::DATE_STRING);

        static::assertInstanceOf(Carbon::class, $result);
        static::assertEquals(static::DATE_STRING, $result->format('Y-m-d'));
    }
}
