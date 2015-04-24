<?php
echo '当前ip地址：' , $_SERVER['REMOTE_ADDR'];
if (!empty($_GET)) {
    echo '带来的的参数: ';
    print_r($_GET);
}

