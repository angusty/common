<?php
/**
 * 报警器类
 */
class Alarm
{
    public function activate()
    {
        echo '启动警报', '<br>';
    }

    public function deactivate()
    {
        echo '关闭警报', '<br>';
    }

    public function ring()
    {
        echo '拉响警报', '<br>';
    }

    public function stopRing()
    {
        echo '停止警报', '<br>';
    }
}
