<?php
namespace app\index\controller;

class Volunteer extends Base
{
    //基金介绍
    public function index()
    {
        return $this->fetch();
    }
    //财务公开
    public function moneyopen()
    {
        $data = db('detail')->where('user_id',2)->paginate();
        return $this->fetch('',[
            'data' => $data,
        ]);
    }
    //公示与报告
    public function notice()
    {
        $data = db('charitable_notice')->where('belong_id',2)->paginate();
        return $this->fetch('',[
            'data'=>$data,
        ]);
    }
    //联系我们
    public function contact()
    {
        return $this->fetch();
    }
    //详情页
    public function detail(){
        $id = input('get.id');
        if(empty($id)){
            $this->error('数据不合法');
        }
        $data = db('charitable_notice')->where('id',$id)->find();
        return $this->fetch('',[
            'data' => $data,
        ]);
    }
}
