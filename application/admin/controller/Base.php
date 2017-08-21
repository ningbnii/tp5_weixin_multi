<?php

namespace app\admin\controller;

use app\admin\model\UcenterMember;
use think\Controller;

class Base extends Controller
{
    protected $uid;

    public function _initialize()
    {
        if (!session('user_auth') || !session('user_auth_sign')) {
            return $this->redirect('/');
        }
        $this->uid = session('user_auth')['uid'];
        $dispatch = $this->request->dispatch();
        $activeRouter = $dispatch['module'][0] . '/' . $dispatch['module'][1] . '/' . $dispatch['module'][2];
        $auth = new \com\Auth();
        if (!$auth->check($activeRouter, session('user_auth')['uid'])) {
            return $this->error('没有权限', '/');
        }

        $sidebar = session('sidebar');
        if(!$sidebar){
            $sidebar = UcenterMember::getSidebar($this->uid);
            session('sidebar', $sidebar);
        }
        $this->assign('sidebar', $sidebar);


    }
}
