<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * 提供一些方便的方法
 */
class MyTestCase extends TestCase
{
    protected $programLocation = '/app/main.php';

    /**
     * 直接比較題目提供的in對應的out檔案
     * 跟程式邏輯是否一致
     * 可以搭配dataProvider服用
     */
    public function assertInAndOutFile(string $inFilePath, string $outFilePath, string $message) :void
    {
        $result = shell_exec("php {$this->programLocation} < {$inFilePath}.in");

        $expected = file_get_contents("{$outFilePath}.out");

        $this->assertEquals($expected, $result, $message);
    }
}
