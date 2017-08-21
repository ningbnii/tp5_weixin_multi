<?php

namespace app\admin\model;

class UcenterMember extends Base
{
    public function authGroupAccess()
    {
        return $this->hasOne('AuthGroupAccess','uid','id');
    }

    /**
     * 获取权限菜单
     * @Author: 296720094@qq.com chenning
     */
    public static function getSidebar($uid)
    {
        $user = self::get($uid);
        $list = AuthRule::getList(['is_show' => 1, 'id' => ['in', $user->authGroupAccess->authGroup->getAttr('rules')]]);
        return $list;
    }
}
