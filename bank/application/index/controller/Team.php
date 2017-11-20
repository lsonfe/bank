<?php
namespace app\index\controller;

class Team extends Base
{
    //光荣团队列表
    public function index()
    {
        //查询光荣团队表
        $local = db('team')->paginate(6);
        return $this->fetch('',['local'=>$local]);
    }
    
    //光荣团队详情
    public function detail(){
        //接收id
        $id = input('id');
        //查询数据库
        $detail = db('team')->where('id',$id)->find();
        return $this->fetch('',['detail'=>$detail]);
    }
}
