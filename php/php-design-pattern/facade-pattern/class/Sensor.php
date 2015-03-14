<?php
/**
 * 感应器类
 */
class Sensor
{
    public function activate()
    {
        echo '启动感应器', '<br>';
    }

    public function deactivate()
    {
        echo '关闭感应器', '<br>';
    }

    public function trigger()
    {
        echo '触发感应器', '<br>';
    }
}
