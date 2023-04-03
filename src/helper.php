<?php

/**
 * 此方法就是單純印字串出來
 * 但會在結尾加上換行符號
 */
function printLine($string) :void
{
    echo($string . PHP_EOL);
}

/**
 * 擷取輸入
 * 並拿掉輸入最後的換行符號
 * 
 * @return string
 */
function input() :string
{
    return trim(fgets(STDIN));
}