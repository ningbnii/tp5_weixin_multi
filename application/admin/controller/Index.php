<?php

namespace app\admin\controller;

use app\admin\model\UcenterMember;
use Gregwar\Captcha\CaptchaBuilder;
use think\Controller;

class Index extends Controller
{
    /**
     * 登录页面
     * @Author: 296720094@qq.com chenning
     * @return \think\response\View
     */
    public function index()
    {
        if ($this->request->isPost()) {
            $result = $this->validate(input('post.'),'UcenterMember.login');
            if(true !== $result){
                return $this->error($result);
            }

            $ucenterMemberData = UcenterMember::getByUsername(input('username'));
            dump($ucenterMemberData);exit;
            if ($ucenterMemberData->password != think_ucenter_encrypt($password, config('UC_AUTH_KEY'))) {
                return $this->error('账号或密码错误！');
            }
            $ucenterMemberData->last_login_time = time();
            $ucenterMemberData->save();
            $auth = [
                'uid'=>$ucenterMemberData->id,
                'group_id'=>$ucenterMemberData->authGroupAccess->group_id,
                'username'=>$ucenterMemberData->username,
                'last_login_time'=>time(),
            ];
            session('user_auth', $auth);
            session('user_auth_sign', data_auth_sign($auth));
            return $this->redirect('main/index');
        } else {
            return view('index');
        }
    }

    /**
     * 验证码
     * @Author: 296720094@qq.com chenning
     */
    public function captcha()
    {
        $builder = new CaptchaBuilder();
        $builder->build()->output();
        session('phrase', strtolower($builder->getPhrase()));
    }
}
