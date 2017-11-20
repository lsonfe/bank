<?php
namespace app\admin\controller;
 
use think\Controller;
class  Team extends Controller {    
    //首页团队光荣榜信息列表
    public function index() {
        //查询首页团队光荣榜表中的所有数据
        $local = db('team')->select();
        return $this->fetch('',['local'=>$local]);
    }
    
    //首页团队光荣榜信息添加
    public function add() {
        //判断表单是否通过post方式传参
        if(request()->isPost()) {
            //获取提交数据
            $data = input("post.");
            //提交的数据入库
            $localData = [
                'company_name' => $data['company_name'],
                'content' =>  $data['content'],
                'time' => time(),
            ];
            //将提交的数据保存在数据库中
            $res = db('team')->insert($localData);
            if($res) {
                $this->success('添加成功', url('team/index'));
            }else {
                $this->error('添加失败', url('team/add'));
            }
        }else{
            return $this->fetch();
        }        
    }    
    //修改数据
    public function edit(){
        $data =input('post.','','htmlentities');
        //判断是否有post提交数据，是的话进行修改操作
        if(!empty($data)){
            //修改时间
            $data['time'] = time();
            //入库
            $re = db('team')->where('id',$data['id'])->update($data);
            //判断是否修改成功
            if($re){
                $this->success('修改成功','team/index');
            }else{
                $this->error('修改失败');
            }
            //否则进入修改页面进行正常的修改
        }else{
            $id = input('id');
            //获取点击的数据
            $local = db('team')->where('id',$id)->find();   
            return $this->fetch('',[
                'local' => $local,
            ]);
        }
    }
    //删除首页团队光荣榜信息
    public function del() {
        $id = input('id');
        $rget =db('team')->where('id',$id)->delete();
        if($rget){
            $this->success('更新成功');
        }else {
            $this->error('更新失败');
        }       
    }
}