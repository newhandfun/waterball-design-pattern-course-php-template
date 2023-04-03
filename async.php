<?php

/**
 * 關於如何用libuv在php實做非同步IO的那些回事
 * 
 * 這隻程式做的事情:
 * 1. 使用者透過stdin在一個陣列中新增字串
 * 2. 程式一秒鐘刪除一個字串，並印出來
 * 3. 若使用者輸入exit則離開程式
 * 
 * 若有更直覺的寫法或解釋，請發PR，感恩。
 * 
 * by 新手方(newhandfun) 2023/04/04
 */

require_once('src/helper.php');

$timer = 0;
$strings = [];

// 開始 event loop
$loop = uv_default_loop();

// 刪除字串的 event
function deleteString()
{
    global $timer, $async, $strings;
    // 我猜你也不希望浪費效能吧
    usleep(10000);
    if (count($strings) == 0) {
        $timer = 0;
    } elseif ($timer == 0) {
        $timer = time();
    } elseif (time() - $timer >= 1) {
        $deletedOne = array_pop($strings);
        printLine("刪除{$deletedOne}囉!");
        $timer = time();
    }
    uv_async_send($async);
}
$async = uv_async_init($loop, 'deleteString');
uv_async_send($async);

$pipe = uv_pipe_init(uv_default_loop(), 0);

// 註冊輸入的 event
function addStringOrExit($pipe, $input)
{
    global $strings;
    $string = trim($input);
    if ($string == 'exit') {
        if (count($strings) > 0) {
            printLine('還有字串尚未刪除......不管了，直接下班。');
        } else {
            printLine('沒字串了，大家可以回家啦!');
        }
        uv_close($pipe);
        exit();
    }
    $strings[] = $string;
}
uv_pipe_open($pipe, 1);
uv_read_start($pipe, 'addStringOrExit');
uv_run();