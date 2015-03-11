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
        }
        catch(Exception $e) {
            trigger_error("file_get_contents_chunked::" . $e->getMessage() , E_USER_NOTICE);
            return false;
        }
        return true;
    }
}

/**
 * 返回当前页面上一级URL地址函数，此函数依赖getLocalDomain()函数
 * @author  yangbo
 * @date    2015-01-15
 * @param   string  $default_url  默认url
 * @param   array|null  $exclude  排除url，当url中包含有$exclude则跳到默认的url，而不会返回到该url
 * @return  url 地址
 */
if (!function_exists('getRefererUrl')) {
    function getRefererUrl($default_url, array $exclude = null)
    {
        $local_domain = getLocalDomain();
        $last_url = $_SERVER['HTTP_REFERER'];;
        //echo $last_url;
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
 * @author  yangbo
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
 * @param $timeInt   时间戳 或 时间字符串
 * @param int $show_how_long  多少时间以内的按这个方法显示 超过的时间按原时间显示
 * @param string $format   超过参数2的时间 按这个格式化显示
 * @return bool|string  成功返回相应数值 失败返回 空字符串
 */
if (!function_exists('howLongFromPastToNow')) {
    function howLongFromPastToNow($timeInt, $show_how_long = 30, $format='Y-m-d H:i:s'){
        if(empty($timeInt)||!is_numeric($timeInt)||!$timeInt){
            $timeInt = strtotime($timeInt);
            if ($timeInt == false) {
                return '';
            }
        }
        $d=time()-$timeInt;
        if($d<0){
            return '';
        } else {
            if ($d<60) {
                return $d.'秒前';
            } else {
                if($d<3600){
                    return floor($d/60).'分钟前';
                } else {
                    if ($d<86400) {
                        return floor($d/3600).'小时前';
                    } else {
                        if ($d<60*60*24*$show_how_long) {//显示多少天内
                            return floor($d/86400).'天前';
                        } else {
                            return date($format,$timeInt);
                        }
                    }
                }
            }
        }
    }
}