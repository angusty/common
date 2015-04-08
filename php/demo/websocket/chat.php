<?php
class WS
{
    private $master;   //连接server的client
    private $sockets = array(); //不同状态的socket管理
    private $handshake = false; //判断是否握手

    public function __construct($address, $port)
    {
        $this->master = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die('socket_create() failed');
        var_dump($this->master);
        socket_set_option($this->master, SOL_SOCKET, SO_REUSEADDR, 1) or die('socket_set_option() failed');
        socket_bind($this->master, $address, $port) or die('socket_bind() failed');
        socket_listen($this->master) or die('socket_listen() failed');
        $this->sockets[] = $this->master;
        //debug
        echo 'master socket : ', $this->master, "\n";

        while (true) {
            // 自动选择来消息的 socket 如果是握手 自动选择主机
            $write = null;
            $except = null;
            socket_select($this->sockets, $write, $except, null);
            foreach($this->sockets as $socket) {
                if ($socket == $this->master) {
                    $client = socket_accept($this->master);
                    if ($client < 0) {
                        //debug
                        echo 'socket_accept() failed', "\n";
                        continue;
                    } else {
                        //connect($client)
                        array_push($this->sockets, $client);
                        echo "connect client\n";
                    }
                } else {
                    $bytes = @socket_recv($socket, $buffer, 2048, 0);
                    if ($bytes === 0 ) {
                        return ;
                    }
                    if (!$this->handshake) {
                        //没有握手
                        $this->dohandshake($socket, $buffer);
                        echo "shakeHands \n";
                    } else {
                        $buffer = $this->decode($buffer);
                        echo "echo: {$buffer} \n";
                    }

                }
            }
        }
    }

    public function decode($buffer)  {
        $len = $masks = $data = $decoded = null;
        $len = ord($buffer[1]) & 127;

        if ($len === 126)  {
            $masks = substr($buffer, 4, 4);
            $data = substr($buffer, 8);
        } else if ($len === 127)  {
            $masks = substr($buffer, 10, 4);
            $data = substr($buffer, 14);
        } else  {
            $masks = substr($buffer, 2, 4);
            $data = substr($buffer, 6);
        }
        for ($index = 0; $index < strlen($data); $index++) {
            $decoded .= $data[$index] ^ $masks[$index % 4];
        }
        return $decoded;
    }

    public function getKey($req) {
        $key = null;
        if (preg_match('/Sec-WebSocket-Key: (.*)\r\n/', $req, $match)) {
            $key = $match[1];
        }
        return $key;
    }

    public function encry($req){
        $key = $this->getKey($req);
        $mask = "258EAFA5-E914-47DA-95CA-C5AB0DC85B11";

        return base64_encode(sha1($key . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));
    }

    public function dohandshake($socket, $req) {
        //获取加密key
        $acceptKey = $this->encry($req);
        $upgrade = "HTTP/1.1 101 Switching Protocols\r\n" .
           "Upgrade: websocket\r\n" .
           "Connection: Upgrade\r\n" .
           "Sec-WebSocket-Accept: " . $acceptKey . "\r\n" .
           "\r\n";
        // 写入socket
        socket_write($socket,$upgrade.chr(0), strlen($upgrade.chr(0)));
        // 标记握手已经成功，下次接受数据采用数据帧格式
        $this->handshake = true;
    }
}

$ws = new WS('localhost', '8765');
