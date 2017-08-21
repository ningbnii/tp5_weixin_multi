<?php

namespace app\admin\model;

class AuthRule extends Base
{
    /**
     * 权限列表
     * @Author: 296720094@qq.com chenning
     * @param $where
     */
    public static function getList($where = [])
    {
        $list = self::where($where)->order('sort')->select();
        $items = [];
        foreach($list as $key=>$value){
            $list[$key]['count'] = count(explode('-',$value->getAttr('path')));
            $items[$value->id] = $value->getData();
        }
        $list = generateTree($items);
        return $list;
    }
}
