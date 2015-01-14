<?php
/**
 * description: discuz接口
 * @author: yangbo
 * @date: 2015/1/13 14:15
 * @return 
 */

namespace Org;

class DiscuzServer
{
    //初始化加载文件
    public function __construct()
    {
        include_once ('config.discuz.php');
        include_once ('uc_client/discuz_client.php');
    }

    /**
     * 获取用户指定积分   积分编号可以通过getCreditsettings获得
     *
     * @param $uid             用户id
     * @param int $credit     用户积分编号   默认是     1:威望   2：金钱    3：贡献
     * @return bool|string
     *
     */
    public function getCredit($uid, $credit=2)
    {
        $return = false;
        if (!empty($uid)) {
            $return  = uc_api_url('uc_note', 'getcredit', array('uid'=>$uid, 'credit'=>$credit));
        }
        return $return;
    }

    /**
     * 获取积分设置
     * @return array
     * 格式： array('积分编号'=>array(0=>'积分内容', 1=>...), ...)
     */
    public function getCreditsettings()
    {
        return uc_api_url('uc_note', 'getcreditsettings');
    }

    /**
     * 增减用户指定$credit积分编号的积分的方法
     * @param $uid      用户uid
     * @param $credit   积分编号
     * @param $amount  积分数量,支持负数   3 - 积分加3   -5 - 积分减5
     * @return false|true   更新成功返回true 失败 false
     */
    public function updateCredit($uid, $credit, $amount)
    {
        $return = false;
        if (!empty($uid)) {
            $return = uc_api_url('uc_note', 'updatecredit', array('uid'=>$uid, 'credit'=>$credit, 'amount'=>$amount));
            $return = !empty($return) ? true: false;
        }
        return $return;
    }

    /**
     * 获取用户信息，可以通过该接口获取用户积分  credits字段
     * @param $uid   用户id
     * @return false|array
     */
    public  function getUser($uid)
    {
        $reutn = false;
        if (!empty($uid)) {
            $return = uc_api_url('uc_note', 'getUser', array('uid'=>$uid));
        }
        return $return;
    }
    /**
     * discuz重命名用户  并不会同步修改 ucenter的数据
     * @param $uid   用户id
     * @param $newusername   新用户名
     * @return bool|false
     */
    public function renameUser($uid, $newusername)
    {
        $return = false;
        if (!empty($uid)) {
            $return = uc_api_url('uc_note', 'renameuser', array('uid'=>$uid, 'newusername'=>$newusername));
            $return = !empty($return) ? true : false;
        }
        return $return;
    }

    /**
     * 修改密码   测试 有问题
     * @param $username   用户名
     * @param $password   新密码
     * @return  bool|false
     */
//    public function updatePassword($username, $password)
//    {
//        $return = false;
//        if (!empty($username)) {
//            $return = uc_api_url('uc_note', 'updatepw', array('username'=>$username, 'password'=>$password));
//            //$return = !empty($return) ? true : false;
//        }
//        return $return;
//    }
}