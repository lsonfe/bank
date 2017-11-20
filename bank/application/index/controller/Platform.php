<?php
namespace app\index\controller;

class Platform extends Base
{
    //平台信息列表
    public function index()
    {
        $result = db('platform')->paginate(6);
        return $this->fetch('',['result'=>$result]);
    }
    
    //平台信息详情
    public function detail(){
        //接收id
        $id = input('id');
        //查询数据库
        $detail = db('platform')->where('id',$id)->find();
        return $this->fetch('',['detail'=>$detail]);
    }
}
