<?php

namespace Tests;

class HelperTest extends MyTestCase
{
    public function testPrintLine()
    {
        $message = '歡迎使用新手方提供的專案基底這樣';

        $this->expectOutputString($message . PHP_EOL);

        printLine($message);
    }
}
