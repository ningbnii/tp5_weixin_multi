<?php

namespace app\admin\model;

class AuthGroupAccess extends Base
{
    public function authGroup()
    {
        return $this->belongsTo('AuthGroup','group_id','id');
    }

    public function ucenterMember()
    {
        return $this->belongsTo('UcenterMember','uid','id');
    }
}
