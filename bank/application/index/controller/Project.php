<?php
namespace app\index\controller;

class project extends Base
{
    //热点项目列表
    public function index()
    {
        $project = db('project')->paginate(6);
        return $this->fetch('',['project'=>$project]);
    }
    
    //平台信息详情
    public function detail(){
        //接收id
        $id = input('id');
        //查询数据库
        $detail = db('project')->where('id',$id)->find();
        return $this->fetch('',['detail'=>$detail]);
    }
}
