<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/*
 * 审核状态
 * 0 待审，1 通过， 2 拒绝
 */
function status1($status) {
    if($status == 1){
        $str = "<span class='label label-success radius'>审核通过</span>";
    }elseif($status == 0){
        $str = "<span class='label label-danger radius'>待审</span>";
    }else{
        $str = "<span class='label label-danger radius'>不通过</span>";
    }
    return $str;
}

/**
 * 通用的分页样式
 * @param unknown $obj
 */
function pagination($obj){
    if(!$obj){
        return '';
    }
    //获取url后面参数的方法       tp5自带
    $params = request()->param();
    return "<div class='cl pd-5 bg-1 bk-gray mt-20 tp5-o2o'>".$obj->appends($params)->render()."</div>";
}