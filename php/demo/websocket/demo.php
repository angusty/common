<?php
//建立 socket 套接字
$address = 'localhost';
$port = '8236';
$master = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($master, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($master, $address, $port);
socket_listen($master);
