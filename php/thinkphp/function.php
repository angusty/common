<?php
/**
     * 根据 ucenter members 同步 discuz member数据, 用到的是thinkphp的数据库操作
     * @author  yangbo
     * @date    2015-01-09
     * @return  [type]  [description]
     */
    function updateDiscuzmemberWithUcenter()
    {
        //ucenter数据库配置
        $ucenter_config = array(
            'DB_TYPE' => 'mysqli', // 数据库类型
            'DB_HOST' => 'localhost',
            'DB_NAME' => 'database_name', // 数据库名
            'DB_USER' => 'root', // 用户名
            'DB_PWD' => '', // 密码
            'DB_PORT' => 3306, // 端口
            'DB_PREFIX' => '', // 数据库表前缀
            'DB_CHARSET'=> 'utf8', // 字符集
        );
        //discuz数据库配置
        $bbs_config = array(
            'DB_TYPE' => 'mysqli', // 数据库类型
            //'DB_HOST' => '199.168.1.125', // 服务器地址
            'DB_HOST' => 'localhost',
            'DB_NAME' => 'database_name', // 数据库名
            'DB_USER' => 'root', // 用户名
            'DB_PWD' => '', // 密码
            'DB_PORT' => 3306, // 端口
            'DB_PREFIX' => '', // 数据库表前缀
            'DB_CHARSET'=> 'utf8', // 字符集
        );
        $ucenter_members = M('uc_members', '', $ucenter_config);
        $ucenter_user = $ucenter_members->select();
        $bbs_members = M('pre_common_member', '', $bbs_config);
        //要插入的数据字段
        $change_field = array('uid', 'email', 'username', 'password', 'regdate');
        $count = array('update'=>0, 'insert'=>0);
        if (is_array($ucenter_user) && !empty($ucenter_members)) {
            foreach ($ucenter_user as $key=>$item) {
                $where['uid'] = $item['uid'];
                $bbs_user = $bbs_members->where($where)->find();
                //修改字段
                $item_change_field = array();
                foreach ($change_field as $key => $value) {
                    $item_change_field[$value] = $item[$value];
                }
                $item_change_field['timeoffset'] = 9999;
                $item_change_field['credits'] = 2;

                //判断这条记录是否存在 存在则update 不存在则insert
                if ($bbs_user) {  //update
                    $bbs_members->data($item_change_field)->save();
                    $count['update'] = $count['update']+1;
                } else {  //insert
                    $bbs_members->data($item_change_field)->add();
                    $count['insert'] = $count['insert']+1;
                }

            }
        }
        echo '更新数据：' . $count['update'] . '条，' . '插入数据' . $count['insert'] . '条';
    }
