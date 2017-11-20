<?php
namespace app\index\controller;

class Charitable extends Base
{
    //基金介绍
    public function index()
    {
        return $this->fetch();
    }
    //财务公开
    public function moneyopen(){
        //查询交易明细
        $data = db('detail')->where('user_id',1)->paginate();
        return $this->fetch('',[
            'data' => $data,
        ]);
    }
    //通知公告
    public function notice(){
        //查询慈善会通知公告
        $data = db('charitable_notice')->where(['belong_id'=>1])->paginate();
        return $this->fetch('',[
            'data' => $data,
        ]);
    }
    //活动报道
    public function activity(){
        $data = db('charitable_activity')->paginate();
        return $this->fetch('',[
            'data'=> $data,
        ]);
    }
    //通知详情
    public function detail1(){
        $id = input('get.id');
        if(empty($id)){
            $this->error('数据不合法');
        }
        $data = db('charitable_notice')->where('id',$id)->find();
        return $this->fetch('',[
            'data' => $data,
        ]);
    }
    //活动详情
    public function detail2(){
        $id = input('get.id');
        if(empty($id)){
            $this->error('数据不合法');
        }
        $data = db('charitable_activity')->where('id',$id)->find();
        return $this->fetch('',[
            'data' => $data,
        ]);
    }
}
