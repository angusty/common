<?php
/**
 * 照相机类
 */
class Camera
{
    public function turnon()
    {
        echo '打开照相机', '<br>';
    }

    public function turnoff()
    {
        echo '关闭照相机', '<br>';
    }

    public function rotate($degrees)
    {
        echo '旋转照相机：', $degrees, ' degrees.<br>';
    }
}
