<?php

/**
 * 分段下载 当一个文件很大的时候,如果一次下载，内存会不够用，可以使用分段下载
 *
 * DEMO:
 * $success = file_get_contents_chunked("my/large/file",4096,function($chunk,&$handle,$iteration){
 *     //处理$chunk的方法，本例中已经读取了4096字节在内存中，此处你可以写入文件 或者什么操作
 * }
 * if(!$success){
 *    //下载失败处理
 * }
 *
 * @param   string  $file   完整路径文件
 * @param   int  $chunk_size  每次下载字节数
 * @param   callback  $callback  回调函数
 * @return  boolean
 */
if (!function_exists('file_get_contents_chunked')) {
    function file_get_contents_chunked($file, $chunk_size, $callback)
    {
        try {
            $handle = fopen($file, "r");
            $i = 0;
            while (!feof($handle)) {
                call_user_func_array($callback, array(fread($handle, $chunk_size), &$handle, $i));
                $i++;
            }
            fclose($handle);
        } catch (Exception $e) {
            trigger_error("file_get_contents_chunked::" . $e->getMessage(), E_USER_NOTICE);
            return false;
        }
        return true;
    }
}

/**
 * 返回当前页面上一级URL地址函数，此函数依赖getLocalDomain()函数
 * @date    2015-01-15
 * @param   string  $default_url  默认url
 * @param   array|null  $exclude  排除url，当url中包含有$exclude则跳到默认的url，而不会返回到该url
 * @return  url 地址
 */
if (!function_exists('getRefererUrl')) {
    function getRefererUrl($default_url, array $exclude = null)
    {
        $local_domain = getLocalDomain();
        $last_url = $_SERVER['HTTP_REFERER'];
        if (empty($last_url)) {
             //如果过来的url为空 给个默认值
            $last_url = $default_url;
        } else {
             //不为空则分解url
            $parse_url = parse_url($last_url);
            $last_host = $parse_url['host'];
            //判断过来的url是不是本域名的，不是本域名来的 不跳回原来的url
            if (strpos($last_host, $local_domain) === false) {
                $last_url = $default_url;
            }
        }
        if (is_array($exclude) && !empty($exclude)) {
            $is_break = false;// 标记是否匹配url
            foreach ($exclude as $key => $url) {
                if (strpos($last_url, $url) !== false) {
                    $last_url = $default_url;
                    $is_break = true;
                    break;
                }
            }
        }
        return $last_url;
    }
}

/**
 * 获得当前一级域名 baidu.com形式非 www.baidu.com形式
 * @date    2015-01-15
 * @return  domian 域名
 */
if (!function_exists('getLocalDomain')) {
    function getLocalDomain()
    {
        $local_domain = $_SERVER['HTTP_HOST'];
        //处理当前域名   形如 baidu.com 的形式
        $local_domain_array = explode('.', $local_domain);
        if (count($local_domain_array) === 3) {
            $local_domain = $local_domain_array[1] . '.' . $local_domain_array[2];
        }
        return $local_domain;
    }
}

/**
 * 过去某个时间(或时间戳)离现在多久
 * @param $ptime   时间戳 或 时间字符串
 * @return bool|string  成功返回相应数值 失败返回 空字符串
 */
if (!function_exists('howLongFromPastToNow')) {
    function howLongFromPastToNow($ptime)
    {
        if (empty($ptime) || !is_numeric($ptime) || !$ptime) {
            $ptime = strtotime($ptime);
            if ($ptime == false) {
                return '';
            }
        }
        $etime = time() - $ptime;
        if ($etime < 59) {
            return '刚刚';
        }
        $interval = array (
            12 * 30 * 24 * 60 * 60 => '年前 ('.date('Y-m-d', $ptime).')',
            30 * 24 * 60 * 60 => '个月前 ('.date('Y-m-d', $ptime).')',
            7 * 24 * 60 * 60 => '周前 ('.date('m-d', $ptime).')',
            24 * 60 * 60 => '天前',
            60 * 60 => '小时前',
            60 => '分钟前',
            1 => '秒前'
        );
        foreach ($interval as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = floor($d);
                return $r . $str;
            }
        }
    }
}

/**
 * 根据文件名后缀 返回相应的 mime
 * @date    2015-04-16
 * @param   string  $file  文件名
 * @param   mix  $allow_suffix  允许的文件名后缀  字符串形式以'|' 分割 或数组形式
 * @return  array
 */
if (!function_exists('getVideoMimeTypeByFileSuffix')) {
    function getVideoMimeTypeByFileSuffix($file, $allow_suffix = 'mp4|flv')
    {
        $return = ['status'=>0, 'file'=>$file];
        $suffix = pathinfo($file, PATHINFO_EXTENSION);
        $mapping = array(
            'video/mp4' => array('mp4'),
            'video/x-flv' => array('flv'),
            'video/avi' => array('avi', 'divx'),
            'video/mpeg' => array('mpeg', 'mp3'),
            'video/ogg' => array('ogg'),
            'video/webm' => array('webm'),
            'video/quicktime' => array('qt', 'mov')
        );
        $mapping = array_flip_into_subarray($mapping);
        if (!empty($allow_suffix)) {
            if (!is_array($allow_suffix)) {
                $allow_suffix = explode('|', $allow_suffix);
            }
            if (!in_array($suffix, $allow_suffix)) {
                $return['msg'] = '不允许的后缀名';
                return $return;
            }
        }

        if (isset($mapping[$suffix])) {
            $return['status'] = 1;
            $return['type'] = $mapping[$suffix];
        } else {
            $return['msg'] = '不能播放的video格式';
        }
        return $return;
    }

}

/**
 * 数组 键值 交换 键对应的是个数组
 * @date    2015-04-16
 * @param   array  $input  数组
 * @return   交换 键值后的数组
 */
if (!function_exists('array_flip_into_subarray')) {
    function array_flip_into_subarray($input)
    {
        $output = array();
        foreach ($input as $key => $values) {
            foreach ($values as $value) {
                $output[$value] = $key;
            }
        }
         return $output;
    }
}

/**
 * 字符串转数组   $string = "array(1,2)" 转成 $array = array(1,2);
 * @date    2015-04-17
 * @param   string  $data  字符串
 * @return  array 数组
 */
if (!function_exists('string2array')) {
    function string2array($data)
    {
        if (empty($data)) {
            return array();
        }
        @eval("\$array = $data;");
        return $array;
    }
}

/**
 * 按照 RFC 3986 对 URL 进行编码 其中一个场景是当进行file_get_contents的时候 如果url有空格会报错
 * @param $url 要编码的url
 * @return string 编码后的url
 */
function file_url($url)
{
    $parts = parse_url($url);
    $path_parts = array_map('rawurldecode', explode('/', $parts['path']));
    return
        $parts['scheme'] . '://' .
        $parts['host'] . ':' .
        $parts['port'] .
        implode('/', array_map('rawurlencode', $path_parts))
        ;
}

/**
 * 获取当前页面的host和完整url
 * @return array [host => '当前域名带http://或https://', current_url => 当前url]
 * 使用场景： 当需要根据当前url生成二维码可使用current_url 或者下一个跳转页面和当前主域名相同可使用host
 */
function getCurrentUrl()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] === 443) ? 'https://' : 'http://';
    if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
        $host = $_SERVER['HTTP_X_FORWARDED_HOST'];
    } else {
        $host = $_SERVER['HTTP_HOST'];
    }
    $request_url = $_SERVER['REQUEST_URI'];
    return [
        'host'  => $protocol . $host,
        'current_url' => $protocol . $host . $request_url
    ];
}

/**
 * 通过指定的$keys返回数组$array中相应的key存在的新数组
 * @param array $array 要处理的数组
 * @param array $keys 需要的键值数组
 * @return array 返回数组
 *  demo：
 * $array = ['a' => 111, 'b' => 222, 'c' => 3333, 'd' => 444]
 * $keys = ['b', 'd']
 * getByKeys($array, $keys) 结果 ['b' => 222, 'd' => 444]
 */
function getArrayByKeys(array $array, array $keys)
{
    return array_intersect_key($array, array_flip($keys));
}

/**
 * 取得$array数组中 除了键值为$except_keys的数组的所有元素
 * 该函数和 @see getArrayByKeys 作用相反
 * @param array $array
 * @param array $except_keys
 * @return array
 *  demo：
 * $array = ['a' => 111, 'b' => 222, 'c' => 3333, 'd' => 444]
 * $except_keys = ['b', 'd']
 * getByExceptKeys($array, $except_keys) 结果 ['a' => 111, 'c' => 333]
 */
function getArrayByExceptKeys(array $array, array $except_keys)
{
    return array_diff_key($array, array_flip($except_keys));
}
