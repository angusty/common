<?php

namespace Org;

class UcService
{
    public function __construct()
    {
        include_once ('config.php');
        include_once ('uc_client/client.php');
    }

    public function register($username, $password, $email, $openid = 0)
    {
        $uid = uc_user_register($username, $password, $email, $openid);

        //UCenter的注册验证函数
        if ($uid <= 0) {
            if ($uid == - 1) {
                return '用户名不合法';
            } elseif ($uid == - 2) {
                return '包含不允许注册的词语';
            } elseif ($uid == - 3) {
                return '用户名已经存在';
            } elseif ($uid == - 4) {
                return 'Email 格式有误';
            } elseif ($uid == - 5) {
                return 'Email 不允许注册';
            } elseif ($uid == - 6) {
                return '该 Email 已经被注册';
            } else {
                return '未定义';
            }
        } else {
            return array(
                'uid' => $uid,
                'username' => $username,
                'password' => $password
            );
        }
    }

    public function uc_login($username, $password)
    {
        list($uid, $username, $password, $email) = uc_user_login($username, $password);
        if ($uid > 0) {
            return array(
                'uid' => $uid,
                'username' => $username,
                'password' => $password,
                'email' => $email
            );
        } elseif ($uid == - 1) {
            return '用户不存在,或者被删除';
        } elseif ($uid == - 2) {
            return '密码错误';
        } elseif ($uid == - 3) {
            return '安全提问错误';
        } else {
            return '未定义';
        }
    }

    //同步登陆
    public function uc_synlogin($uid)
    {
        return uc_user_synlogin($uid);
    }

    //绑定微信
    public function band_openid($username, $openid, $is_weixinlogin)
    {
        return $ucresult = uc_band_openid($username, $openid, $is_weixinlogin);
    }

    // 检查用户是否注册过 注册过直接扫描登录
    public function checkUserExist($openid)
    {
        if (empty($openid)) {
            return null;
        }
        return $uid = uc_checkUserExist($openid);
    }

    public function checkUserNameExist($username)
    {
        if (empty($username)) {
            return null;
        }
        return $uid = uc_checkUserNameExist($username);
    }

    /**
     * 同步退出登陆
     * @return html
     */
    public function uc_synlogout()
    {
        return uc_user_synlogout();
    }

    /**
     * ucenter通过用户名获取用户的方法
     * @link http://faq.comsenz.com/library/UCenter/interface/interface_pm.htm
     * @author  yangbo
     * @date    2014-12-24
     * @param   string  $username  用户名
     * @param   boolean  $isuid  falase 使用用户名获取(默认)  true 使用uid获取
     * @return  false/array(id,username,email)
     */
    public function getUserByUsername($username, $isuid = false)
    {
        if ($data = uc_get_user($username, $isuid)) {
            return $data;
        } else {
            return false;
        }
    }

    /**
     * 检查用户是否有新的短消息
     * @author  yangbo
     * @date    2014-12-24
     * @param   string  $uid  短消息uid
     * @param   int  $more  1 返回数组 有newpm和newprivatepm属性  2 数组增加newchatpm 3(默认值) 更详细的内容
     * @return  boolean  有新的短消息返回array newpm为短消息的条数 ,否则返回false
     */
    public function checkHasNewMessage($uid, $more = 3)
    {
        $data = uc_pm_checknew($uid, $more);
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    /**
     * 发送短消息接口
     * @link http://faq.comsenz.com/library/UCenter/interface/interface_pm.htm
     * @author  yangbo
     * @date    2014-12-24
     * @param   string  $fromuid  发件人用户 ID ,不能为0
     * @param   string  $msgto  收件人用户名 / 用户 ID，多个用逗号分割
     * @param   string  $subject  消息标题
     * @param   string  $message  消息内容
     * @param   boolean  $instantly  是否直接发送 1:(默认值) 直接发送消息 0:进入发送短消息的界面
     * @param   string  $replypid  回复的消息 ID  大于 0:回复指定的短消息  0:(默认值) 发送新的短消息
     * @param   boolean  $isusername  msgto 参数是否为用户名 1:msgto 参数为用户名 0:(默认值) msgto 参数为用户 ID
     * @param   boolean  $type   消息类别   1:群聊消息  0:(默认值)私人消息
     * @return  array  格式 array('status'=>, 'info'=> , ['last_mid'=>]) 成功 status=1,并返回最后发送的消息编号 last_mid,失败 status=0
     */
    public function sendMessage($fromuid, $msgto, $subject, $message, $instantly = 1, $replypid = 0, $isusername = 0, $type = 0)
    {
        $return_message = [0 => '发送失败', -1 => '超过两人会话的最大上限', -2 => '超过两次发送短消息时间间隔', -3 => '不能给非好友批量发送短消息', -4 => '目前还不能使用发送短消息功能(注册多少日后才可以使用发短消息限制)', -5 => '超过群聊会话的最大上限', -6 => '在忽略列表中', -7 => '超过群聊人数上限', -8 => '不能给自己发短消息', -9 => '收件人不能为空', -10 => '发起群聊人数小于两人'];
        $return_array = [];

        //print_r(func_get_args());
        $return = uc_pm_send($fromuid, $msgto, $subject, $message, $instantly, $replypid, $isusername, $type);
        if ($return > 0) {
            $return_array['status'] = 1;
            $return_array['info'] = '发送消息成功';
            $return_array['last_mid'] = $return;
        } else {
            $return_array['status'] = 0;
            $return_array['info'] = $return_message[$return];
        }
        return $return_array;
    }

    /**
     * 获取短消息列表 函数已内置分页，直接通过 page 和 pagesize 即可实现翻页
     * @author  yangbo
     * @date    2014-12-24
     * @param   string  $uid  用户 ID
     * @param   integer  $page  当前页编号，默认值 1
     * @param   integer  $pagesize 每页最大条目数，默认值 10
     * @param   string  $folder  短消息所在的文件夹 newbox:新件箱 inbox:(默认值) 收件箱 outbox:发件箱
     * @param   string  $filter  过滤方式 newpm:(默认值) 未读消息， privatepm 已读消息
     * @param   integer  $msglen  截取短消息内容文字的长度，0 为不截取，默认值 0
     * @return  false/array   array(count=> .., data=> ...)
     */
    public function getMessageList($uid, $page = 1, $pagesize = 10, $folder = 'outbox', $filter = 'privatepm', $msglen = 0)
    {
        $messages = uc_pm_list($uid, $page, $pagesize, $folder, $filter, $msglen);
        if (is_array($messages) && !empty($messages)) {
            return $messages;
        } else {
            return false;
        }
    }

    /**
     * 获取列表短消息具体内容
     * @author  yangbo
     * @date    2014-12-25
     * @param   string  $uid  用户 ID
     * @param   integer  $touid  消息对方用户 ID
     * @param   integer  $isplid  touid参数是会话id还是用户id  默认是1 会话id
     * @param   integer  $page  当前页码  $page=0 所有 $page从1开始
     * @param   integer  $pagesize  每页最大条数
     * @param   stirng  $pmid  消息 ID
     * @param   integer  $daterange  日期范围  1:(默认值) 今天 2:昨天 3:前天 4:上周 5:更早
     * @param   integer  $type  消息类型 1: 私人消息, 2: 群聊消息
     *
     * 当要查找一个会话里面的所有列表的时候用 设置 $isplid=1, $pmid=0, $touid=会话id(会话id可以从getMessageList获取)
     * 当要查找某个uid对另一个uid发送消息时, 设置 $isplid =0, $pmid=0, $touid=某个用户id
     * @return  false/array
     */
    public function getMessage($uid, $touid, $isplid = 1, $page = 1, $pagesize = 10, $pmid = 0, $daterange = 1, $type = 0)
    {
        $data = uc_pm_view($uid, $pmid, $touid, $daterange, $page, $pagesize, $type, $isplid);
        if (is_array($data) && !empty($data)) {
            return $data;
        } else {
            return false;
        }
    }

    /**
     * 获取单条消息
     * @author  yangbo
     * @date    2014-12-26
     * @param   string  $uid  用户id
     * @param   string  $pmid  消息id
     * @return  array
     */
    public function getOneMessage($uid, $pmid)
    {
        $data = uc_pm_viewnode($uid, 0, $pmid);
        return $data;
    }

    /**
     * 返回指定消息数量
     * @author  yangbo
     * @date    2014-12-25
     * @param   string  $uid  用户ID
     * @param   string  $touid  查找的会话 ID 或者用户 ID
     * @param   [type]  $isplid  touid参数是会话 ID(1) (默认)   还是用户 ID (0)
     * @return  false/number 数量
     */
    public function getMessageNum($uid, $touid, $isplid = 1)
    {
        $num = uc_pm_view_num($uid, $touid, $isplid);
        return $num;
    }

    /**
     * 根据消息id数组 删除消息
     * @author  yangbo
     * @date    2014-12-24
     * @param   string  $uid  用户id
     * @param   array  $pmids  消息id数组
     *  @param   string  $folder  短消息所在的文件夹 inbox(默认):收件箱 outbox:发件箱
     * @return  false/true 是否删除成功
     */
    public function deleteMessageByMids($uid, $pmids, $folder = 'index')
    {
        if (is_array($pmids) && !empty($pmids)) {
            $num = uc_pm_delete($uid, $folder, $pmids);
            return $num ? true : false;
        } else {
            return false;
        }
    }

    /**
     * 根据uid数组删除和uid对话的所有消息
     * @author  yangbo
     * @date    2014-12-25
     * @param   string  $uid  用户id
     * @param   array $touids  用户id数组
     * @return  false/true 是否删除成功
     */
    public function deleteMessageByUids($uid, $touids)
    {
        if (is_array($touids) && !empty($touids)) {
            $num = uc_pm_deleteuser($uid, $touids);
            return $num ? true : false;
        } else {
            return false;
        }
    }

    /**
     * 更新用户资料
     * @author  yangbo
     * @date    2015-01-07
     * @param   [type]  $username 用户名
     * @param   [type]  $oldpw  旧密码
     * @param   [type]  $newpw  新密码，如不修改为空
     * @param   string  $email  Email，如不修改为空
     * @param   integer  $ignoreoldpw  是否忽略旧密码  1:忽略，更改资料不需要验证密码  0(默认值): 不忽略，更改资料需要验证密码
     * @param   string  $questionid  安全提问索引
     * @param   string  $answer  安全提问答案
     * @return  [type]  [description]
     */
    public function updateUser($username, $oldpw, $newpw, $email = '', $ignoreoldpw = 0, $questionid = '', $answer = '')
    {
        $ucresult = uc_user_edit($username, $oldpw, $newpw, $email, $ignoreoldpw, $questionid, $answer);
        $msg = array(-1 => '原密码不正确', -4 => 'Email 格式有误', -5 => 'Email 不允许注册', -6 => '该 Email 已经被注册', -7 => '没有做任何修改', -8 => '该用户受保护无权限更改',
            0 => '没有做任何修改',
            1 => '更新成功'
        );
        if ($ucresult > 0) {
            $return_array['status'] = 1;
            $return_array['info'] = '修改成功';
            $return_array['msg'] = $msg[$ucresult];
        } else {
            $return_array['status'] = 0;
            $return_array['info'] = '修改失败';
            $return_array['msg'] = $msg[$ucresult];
        }

        return $return_array;
    }

    /**
     * 根据uid修改用户名的方法
     * @date    2015-01-08
     * @author  yangbo
     * @param   [type]  $uid  uid
     * @param   [type]  $username  用户名
     * @return  [type]  [description]
     */
    public function updateUserByUid($uid, $username)
    {
        $data = uc_update_member_by_uid($uid, $username);
        return $data;
    }

    /**
     * 获取积分接口
     * @author  yangbo
     * @date    2015-01-12
     * @param   string  $appid  应用id
     * @param   string  $uid  用户id
     * @param   stirng $credit  积分编号
     * @return
     */
    public function getCredit($appid, $uid, $credit)
    {
        return uc_user_getcredit($appid, $uid, $credit);
    }

    /**
     * 积分兑换
     * @author  yangbo
     * @date    2015-01-12
     * @param   string  $uid  用户id
     * @param   string $from  原积分
     * @param   string  $to   目标积分
     * @param   string  $toappid  目标应用id
     * @param   string  $amount  积分数额
     * @return  int 0 失败   1 成功
     */
    public function creditExchange($uid, $from, $to, $toappid, $amount)
    {
        return uc_credit_exchange_request($uid, $from, $to, $toappid, $amount);
    }
}
?>
