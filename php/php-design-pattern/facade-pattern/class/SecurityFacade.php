<?php
/**
 * 门面类
 */
class SecurityFacade
{
    //照相机
    private $camera_a, $camera_b;
    //灯
    private $light_a, $light_b, $light_c;
    //感应器
    private $sensor;
    //报警器
    private $alarm;

    public function __construct()
    {
        $this->camera_a = new Camera();
        $this->camera_b = new Camera();

        $this->light_a = new Light();
        $this->light_b = new Light();
        $this->light_c = new Light();

        $this->sensor = new Sensor();

        $this->alarm = new Alarm();
    }

    public function activate()
    {
        $this->camera_a->turnon();
        $this->camera_b->turnon();

        $this->light_a->turnon();
        $this->light_b->turnon();
        $this->light_c->turnon();

        $this->sensor->activate();

        $this->alarm->activate();
    }

    public function deactivate()
    {
        $this->camera_a->turnoff();
        $this->camera_b->turnoff();

        $this->light_a->turnoff();
        $this->light_b->trunoff();
        $this->light_c->trunoff();

        $this->sensor->deactivate();

        $this->alarm->deactivate();
    }


}
