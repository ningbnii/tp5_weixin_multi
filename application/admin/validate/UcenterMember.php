<?php
/**
 * Created by PhpStorm.
 * User: ning
 * Date: 2017/11/1
 * Time: 14:42
 */
namespace app\admin\validate;

use think\Validate;

class UcenterMember extends Validate{
    protected $rule = [
        'username'=>'require',
        'password'=>'require',
        'code'=>'require|checkCode',
    ];

    protected $message = [
        'username.require'=>'请填写用户名',
        'password.require'=>'请填写密码',
        'code.require'=>'请填写验证码',
    ];

    protected $scene = [
        'login'=>['username','password','code'],
    ];

    /**
     * 检查验证码是否正确
     * @param $value
     * @return bool|string
     */
    protected function checkCode($value)
    {
        $phrase = session('phrase');
        session('phrase', null);
        if($phrase != strtolower($value)){
            return '验证码错误';
        }else{
            return true;
        }
    }
}