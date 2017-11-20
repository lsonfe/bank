<?php
namespace app\admin\controller;
 
use think\Controller;
class  Feedback extends Controller {    
    //反馈意见列表
    public function index() {
        //查询反馈意见表中的所有数据
        $local = db('feedback')->select();
        return $this->fetch('',['local'=>$local]);
    }
    //删除反馈意见信息
    public function del() {
        $id = input('id');
        $rget =db('feedback')->where('id',$id)->delete();
        if($rget){
            $this->success('更新成功');
        }else {
            $this->error('更新失败');
        }       
    }
}