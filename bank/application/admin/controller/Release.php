<?php
namespace app\admin\controller;
 
use think\Controller;
class Release extends Controller {    
    //发布需求信息列表
    public function index() {
        //查询发布需求表中的所有数据
        $local = db('release')->select();
        foreach($local as &$val){//引用赋值
            //发布需求分类
            $val['category'] = db('category')->where('id',$val['category'])->find()['name'];
            //发布人
            $val['user_id'] = db('user')->where('id',$val['user_id'])->find()['username'];
            //接取人
            $val['jiequ2'] = db('user')->where('id',$val['jiequ2'])->find()['username'];
            switch ($val['status']){    //修改审核状态文字
                case 0 : $val['status']="待审";break;
                case 1 : $val['status']="通过";break;
                case 2 : $val['status']="未通过";break;
            }
            switch ($val['status']){    //修改完成状态文字
                case 0 : $val['status']="发布中";break;
                case 1 : $val['status']="已接取";break;
                case 2 : $val['status']="已完成";break;
            }
        }
        unset($val); // 最后取消掉引用
        return $this->fetch('',['local'=>$local]);
    }
    
    //发布需求信息审核列表
    public function check() {
        //查询发布需求表中的所有数据
        $local = db('release')->where('status',0)->select();
        foreach($local as &$val){//引用赋值
            //发布需求分类
            $val['category'] = db('category')->where('id',$val['category'])->find()['name'];
            //发布人
            $val['user_id'] = db('user')->where('id',$val['user_id'])->find()['username'];
        }
        unset($val); // 最后取消掉引用
        return $this->fetch('',['local'=>$local]);
    }
    
    //修改审核状态
    public function change(){
        //获取id
        $id = input('id');
        //获取状态值
        $status = input('status');
        //修改入库
        $result = db('release')->where('id',$id)->update(['status'=>$status]);
        //判断是否修改成功
        if($result){
            return $this->redirect('release/check');
        }else{
            return $this->error('修改失败');
        }
    }
    
    //删除发布需求信息
    public function del() {
        $id = input('id');
        $rget =db('release')->where('id',$id)->delete();
        if($rget){
            $this->success('更新成功');
        }else {
            $this->error('更新失败');
        }       
    }
}