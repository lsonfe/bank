<?php
namespace app\index\controller;

class Notice extends Base
{
    public function index()
    {
        $data = db('notice')->paginate();
        return $this->fetch('',[
            'data' => $data,
        ]);
    }
    //详情页
    public function detail(){
        $id = input('get.id');
        if(empty($id)){
            $this->error('数据不合法');
        }
        $data = db('notice')->where('id',$id)->find();
        return $this->fetch('',[
            'data' => $data,
        ]);
    }
}
