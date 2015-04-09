<?php
set_time_limit(0);

class SocketServer
{
    private static $socket;
    public function socketServer($port)
    {
        global $errno, $errstr;
        if ($port < 1024) {
            die('Port must be a number which bigger than 1024' . "\n");
        }
            $socket = stream_socket_server("tcp://0.0.0.0:{$port}", $errno, $errstr);
            if (!$socket) {
                die("{$errstr} ({$errno})");
            }

            while($conn = stream_socket_accept($socket, -1)) {  //设置不超时
                static $id = 0;
                static $ct = 0;
                $ct_last = $ct;
                $ct_data = '';
                $buffer = '';
                $id++;
                echo "Client $id come . \n";
                while (!preg_match('//r?/n/', $buffer)) { //没有读取到结束符 继续读
                    if (feof($conn)) {
                        break;
                    }
                    $buffer = fread($conn, 1024);
                    echo 'R';
                    $ct += strlen($buffer);
                    $ct_data .= preg_replace('//r?/n/', '', $buffer);
                }
                $ct_size = ($ct-$ct_last) * 8;
                echo "[$id]" . __METHOD__ . " > " . $ct_data . "\n";
                fwrite($conn, "Received $ct_size byte data ./r/n");
                fclose($conn);
            }
            fclose($conn);
    }
}

$socketServer = new SocketServer(2000);
