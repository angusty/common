<?php

/*
    [UCenter] (C)2001-2099 Comsenz Inc.
    This is NOT a freeware, use is subject to license terms

    $Id: client.php 1079 2011-04-02 07:29:36Z zhengqingpeng $
*/

if (!defined('UC_API')) {
    exit('Access denied');
}
error_reporting(0);

define('IN_UC', TRUE);
define('UC_CLIENT_VERSION', '1.6.0');
define('UC_CLIENT_RELEASE', '20110501');
define('UC_ROOT', dirname(__FILE__));
define('UC_DATADIR', UC_ROOT . './data/');
define('UC_DATAURL', UC_API . '/data');
$GLOBALS['uc_controls'] = array();

function uc_addslashes($string, $force = 0, $strip = FALSE)
{
    !defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
    if (!MAGIC_QUOTES_GPC || $force) {
        if (is_array($string)) {
            foreach ($string as $key => $val) {
                $string[$key] = uc_addslashes($val, $force, $strip);
            }
        } else {
            $string = addslashes($strip ? stripslashes($string) : $string);
        }
    }
    return $string;
}

if (!function_exists('daddslashes')) {
    function daddslashes($string, $force = 0)
    {
        return uc_addslashes($string, $force);
    }
}

function uc_stripslashes($string)
{
    !defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
    if (MAGIC_QUOTES_GPC) {
        return stripslashes($string);
    } else {
        return $string;
    }
}

function uc_serialize($arr, $htmlon = 0)
{
    include_once UC_ROOT . './lib/xml.class.php';
    return xml_serialize($arr, $htmlon);
}

function uc_unserialize($s)
{
    include_once UC_ROOT . '/lib/xml.class.php';
    return xml_unserialize($s);
}

function uc_authcode($string, $operation = 'DECODE', $key = '', $expiry = 0)
{
    $ckey_length = 4;
    $key = md5($key ? $key : UC_KEY);
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()) , -$ckey_length)) : '';
    $cryptkey = $keya . md5($keya . $keyc);
    $key_length = strlen($cryptkey);
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb) , 0, 16) . $string;
    $string_length = strlen($string);
    $result = '';
    $box = range(0, 255);
    $rndkey = array();
    for ($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }

    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for ($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result.= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if ($operation == 'DECODE') {
        if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb) , 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc . str_replace('=', '', base64_encode($result));
    }
}

function uc_fopen2($url, $limit = 0, $post = '', $cookie = '', $bysocket = FALSE, $ip = '', $timeout = 15, $block = TRUE)
{
    $__times__ = isset($_GET['__times__']) ? intval($_GET['__times__']) + 1 : 1;
    if ($__times__ > 2) {
        return '';
    }
    $url.= (strpos($url, '?') === FALSE ? '?' : '&') . "__times__=$__times__";
    return uc_fopen($url, $limit, $post, $cookie, $bysocket, $ip, $timeout, $block);
}

function uc_fopen($url, $limit = 0, $post = '', $cookie = '', $bysocket = FALSE, $ip = '', $timeout = 15, $block = TRUE)
{
    $return = '';
    $matches = parse_url($url);
    !isset($matches['host']) && $matches['host'] = '';
    !isset($matches['path']) && $matches['path'] = '';
    !isset($matches['query']) && $matches['query'] = '';
    !isset($matches['port']) && $matches['port'] = '';
    $host = $matches['host'];
    $path = $matches['path'] ? $matches['path'] . ($matches['query'] ? '?' . $matches['query'] : '') : '/';
    $port = !empty($matches['port']) ? $matches['port'] : 80;
    if ($post) {
        $out = "POST $path HTTP/1.0\r\n";
        $out.= "Accept: */*\r\n";

        //$out .= "Referer: $boardurl\r\n";
        $out.= "Accept-Language: zh-cn\r\n";
        $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
        $out.= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
        $out.= "Host: $host\r\n";
        $out.= 'Content-Length: ' . strlen($post) . "\r\n";
        $out.= "Connection: Close\r\n";
        $out.= "Cache-Control: no-cache\r\n";
        $out.= "Cookie: $cookie\r\n\r\n";
        $out.= $post;
    } else {
        $out = "GET $path HTTP/1.0\r\n";
        $out.= "Accept: */*\r\n";

        //$out .= "Referer: $boardurl\r\n";
        $out.= "Accept-Language: zh-cn\r\n";
        $out.= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
        $out.= "Host: $host\r\n";
        $out.= "Connection: Close\r\n";
        $out.= "Cookie: $cookie\r\n\r\n";
    }
    if (function_exists('fsockopen')) {
        $fp = @fsockopen(($ip ? $ip : $host) , $port, $errno, $errstr, $timeout);
    } elseif (function_exists('pfsockopen')) {
        $fp = @pfsockopen(($ip ? $ip : $host) , $port, $errno, $errstr, $timeout);
    } else {
        $fp = false;
    }

    if (!$fp) {
        return '';
    } else {
        stream_set_blocking($fp, $block);
        stream_set_timeout($fp, $timeout);
        @fwrite($fp, $out);
        $status = stream_get_meta_data($fp);
        if (!$status['timed_out']) {
            while (!feof($fp)) {
                if (($header = @fgets($fp)) && ($header == "\r\n" || $header == "\n")) {
                    break;
                }
            }

            $stop = false;
            while (!feof($fp) && !$stop) {
                $data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));
                $return.= $data;
                if ($limit) {
                    $limit-= strlen($data);
                    $stop = $limit <= 0;
                }
            }
        }
        @fclose($fp);
        return $return;
    }
}

//调用远程url接口
function uc_api_url($module, $action, $arg = '', $extra = '')
{
    $arg = http_build_query($arg);
    $data = "&action={$action}&time=" . time();
    $string = urlencode(uc_authcode($arg . $data, 'ENCODE', UC_KEY, 3600)); //关键步奏
    //组装url
    $url = UC_API . '?code=' . $string; //组装成 ？code=加密字段 形式，UC_API，UC_API地址
    $return = file_get_contents($url);
    if (xml_parser($return) !== false) {
        $return = uc_unserialize($return);
    }
    return $return;
}
function xml_parser($str)
{
    $xml_parser = xml_parser_create();
    if (!xml_parse($xml_parser, $str, true)) {
        xml_parser_free($xml_parser);
        return false;
    } else {
        return (json_decode(json_encode(simplexml_load_string($str)) , true));
    }
}

