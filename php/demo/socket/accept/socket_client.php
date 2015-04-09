<?php
function debug($msg)
{
    error_log($msg);
}

if ($argv[1]) {
    $socket_client = stream_socket_client('tcp://0.0.0.0:2000', $errno, $errstr, 30);
    if (!$socket_client) {
        die("{$errstr} ({$errno})");
    } else {
        $msg = trim($argv[1]);
        for($i=0; $i<10; $i++) {
            $res = fwrite($socket_client, $msg($i));
            usleep(5000);
            echo 'W';    //打印写次数

        }
        fwrite($socket_client, "\r\n");     //发送传输 结束
        debug(fread($socket_client, 1024));
        fclose($socket_client);
    }
}  else {
    for ($i=0; $i < 10; $i++) {
        system("php " . __FILE__ . " {$i} : test");
    }

}
