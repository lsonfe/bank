<?php
namespace app\index\controller;

class Domestic extends Base
{
    //国内资讯列表
    public function index()
    {
        //查询国内资讯表
        $domestic = db('domestic')->paginate(15);
        return $this->fetch('',['domestic'=>$domestic]);
    }
    
    //国内资讯详情页
    public function detail(){
        //接受id
        $id = input('id');
        //查询数据库
        $detail = db('domestic')->where('id',$id)->find();
        return $this->fetch('',['detail'=>$detail]);
    }
}
