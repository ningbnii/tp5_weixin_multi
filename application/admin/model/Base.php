<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Base extends Model
{
    use SoftDelete;

    protected $deleteTime = 'delete_time';

    protected function base($query)
    {
        if(session('user_auth')['uid'] != 1){
            $field = $this->getDeleteTimeField(true);
            $query->useSoftDelete($field);
        }
    }

    /**
     * 操作失败，返回错误信息
     * @Author   chenning
     * @DateTime 2017-01-17T11:31:50+0800
     * @param    [type]                   $data [description]
     * @return   [type]                         [description]
     */
    protected static function success($data){
        return ['status'=>200, 'data'=>$data];
    }

    /**
     * 操作成功
     * @Author   chenning
     * @DateTime 2017-01-17T11:31:50+0800
     * @param    [type]                   $data [description]
     * @return   [type]                         [description]
     */
    protected static function error($data){
        return ['status'=>400, 'error'=>$data];
    }
}
