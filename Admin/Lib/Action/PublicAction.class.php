<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

class PublicAction extends Action {

    // 检查用户是否登录
    protected function checkUser() {
        if (!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->assign('jumpUrl', 'Public/login');
            $this->error('没有登录');
        }
    }

    // 用户登录页面
    public function login() {
        if (!isset($_SESSION[C('USER_AUTH_KEY')])) {  
            $this->display();
        } else {
            $this->redirect('Index/index');
        }
    }

    public function index() {
        //如果通过认证跳转到首页
        redirect(__APP__);
    }

    // 用户登出
    public function logout() {
        if (isset($_SESSION[C('USER_AUTH_KEY')])) {
            unset($_SESSION[C('USER_AUTH_KEY')]);
            unset($_SESSION);
            session_destroy();
            $this->assign("jumpUrl", __URL__ . '/login/');
            $this->ajaxReturn(a, '登出成功！', 1);
        } else {
            $this->ajaxReturn(1, '已经登出！', 1);
        }
    }

    // 登录检测
    public function checkLogin() {        
        if (empty($_POST['account'])) {
            $this->ajaxReturn($_POST, '帐号必须！');
        } elseif (empty($_POST['password'])) {
            $this->ajaxReturn($_POST, '密码必须！');
        }
        //生成认证条件
        $map = array();
        // 支持使用绑定帐号登录
        $map['account'] = $_POST['account'];
        //$map['password']= md5($_POST['password']);
        $map["status"] = '1';
        if($_SESSION['verify'] != md5($_POST['verify'])) {
           	//$this->error('验证码错误！');
                $this->ajaxReturn($authInfo, '验证码错误', 0);
        }
        import('ORG.Util.RBAC');
        $authInfo = RBAC::authenticate($map);
        //使用用户名、密码和状态的方式进行认证
        //dump($map);
        //dump($authInfo);
        if (!$authInfo) {
            $this->ajaxReturn($authInfo, '帐号不存在或已经被禁用', 0);
        } else {
            if ($authInfo['password'] != md5($_POST['password'])) {
                $this->ajaxReturn($authInfo, '密码错误！', 0);
            }
            //保存当前用户登录ID
            $_SESSION[C('USER_AUTH_KEY')] = $authInfo['id'];
             if($authInfo['account']==C('RBAC_SUPERADMIN'))//超级管理员
            {
                session(C('ADMIN_AUTH_KEY'),TRUE);
            }
            $_SESSION['_ACCESS_LIST'] = RBAC::getAccessList($authInfo['id']);        
            //RBAC::saveAccessList();
            
            $_SESSION['email'] = $authInfo['email'];
            $_SESSION['nickname'] = $authInfo['nickname'];
            $_SESSION['password'] = $authInfo['password'];
            $_SESSION['lastLoginTime'] = $authInfo['last_login_time'];
            $_SESSION['remark'] = $authInfo['remark'];
            $_SESSION['status'] = $authInfo['status'];
            $_SESSION['last_login_ip'] = $authInfo['last_login_ip'];
            //取出相关角色信息
            $ru = M('role_user');
            $con['user_id'] = $_SESSION[C('USER_AUTH_KEY')];
            $rul = $ru->where($con)->select();
            $role = M('role');
            $con1['id'] = $rul[0]['role_id'];
            $rl = $role->where($con1)->select();
            $_SESSION['role'] = $rl[0]['name'];
            //取出相关可访问资源信息
            $ac = M('access');
            $con2['role_id'] = $rl[0]['id'];
            $acl = $ac->where($con2)->select();
            for ($i = 0; $i < count($acl); $i++) {
                $resourceIds[$i] = $acl[$i]['node_id'];
            }
            $resourceIds = implode(",", $resourceIds); //把数组转化成字符串
            $_SESSION['resourceIds'] = $resourceIds;         
                        
            //保存登录信息
            $User = M('User');
            $ip = get_client_ip();
            $time = time();
            $data = array();
            $data['id'] = $authInfo['id'];
            $data['last_login_time'] = $time;
            $data['login_count'] = array('exp', 'login_count+1');
            $data['last_login_ip'] = $ip;
            $User->save($data);
            $_SESSION['now_login_ip'] = get_client_ip();//当前登录IP

            $this->ajaxReturn($authInfo, '登录成功！', 1);
        }
    }

    //生成验证码
    public function verify() {
        $type = isset($_GET['type']) ? $_GET['type'] : 'gif';
        import("ORG.Util.Image");
        Image::buildImageVerify(4, 1, $type);
    }
//    Public function verify(){        
//        import('ORG.Util.Image');
//        Image::buildImageVerify();        
//    }

}

?>