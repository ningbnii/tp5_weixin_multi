<?php
namespace app\admin\controller;

use Gregwar\Captcha\CaptchaBuilder;

class Index
{
    /**
     * 登录页面
     * @Author: 296720094@qq.com chenning
     * @return \think\response\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * 验证码
     * @Author: 296720094@qq.com chenning
     */
    public function captcha()
    {
        $builder = new CaptchaBuilder();
        $builder->build()->output();
        session('phrase', $builder->getPhrase());
    }
}
