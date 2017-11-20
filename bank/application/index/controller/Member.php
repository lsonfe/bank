<?php
namespace app\index\controller;

class Member extends Base
{
    //会员风采列表
    public function index()
    {
        //查询会员风采表
        $local = db('member')->paginate(6);
        return $this->fetch('',['local'=>$local]);
    }
    
    //会员风采详情
    public function detail(){
        //接收id
        $id = input('id');
        //查询数据库
        $detail = db('member')->where('id',$id)->find();
        return $this->fetch('',['detail'=>$detail]);
    }
}
