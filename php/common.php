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
 * 根据返回的url跳回url，除了$exclude_url数组中的url，其它的都跳回default_url
 * @param  string $host_domain 域名
 * @param stirng  $default_url 默认url
 * @param array $exclude_url   当从这些url过来的时候，跳回原url
 * @return string url   返回url
 */
if (!function_exists('returnURL')) {
     function returnURL($host_domain, $default_url, array $exclude_url=null)
     {
         $last_url = $_SERVER['HTTP_REFERER'];
         if (empty($last_url) ) {  //如果过来的url为空 给个默认值
             $last_url = $default_url;
         } else { //不为空则分解url
            $parse_url = parse_url($last_url);
            $host = $parse_url['host'];
            //判断过来的url是不是本域名的，不是本域名来的 不跳回原来的url
            if (strpos($host, $host_domain) === false) {
                $last_url = $default_url;
            }
         }
         if (!empty($exclude_url)) {
            $is_break = false;
             foreach($exclude_url as $key=>$url) {
                 if(strpos($last_url, $url) !== false) {
                     $last_url = $url;
                     $is_break = true;
                     break;
                 }
             }
             if ($is_break === false) {
                $last_url = $default_url;
             }
         }
         return $last_url;
     }
 }

