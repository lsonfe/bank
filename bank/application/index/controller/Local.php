<?php
namespace app\index\controller;

class Local extends Base
{
    //地方动态列表
    public function index()
    {
        //查询地方动态表
        $local = db('local')->paginate(6);
        return $this->fetch('',['local'=>$local]);
    }
    
    //地方动态详情
    public function detail(){
        //接收id
        $id = input('id');
        //查询数据库
        $detail = db('local')->where('id',$id)->find();
        return $this->fetch('',['detail'=>$detail]);
    }
}
