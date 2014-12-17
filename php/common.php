<?php

/**
 * 分段下载 当一个文件很大的时候,如果一次下载，内存会不够用，可以使用分段下载
 *
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
