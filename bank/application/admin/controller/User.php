<?php
namespace app\admin\controller;
 
use think\Controller;
class  User extends Controller {    
    //管理员信息列表
    public function index() {
        //查询管理员表中的所有数据
        $adminList = db('admin')->select();
        return $this->fetch('',['adminList'=>$adminList]);
    }
    
    //管理员信息添加
    public function add() {
        //判断表单是否通过post方式传参
        if(request()->isPost()) {
            //获取提交数据
            $data = input("post.");
            //判断提交的用户是否重复
            $result = db('admin')->where('username',$data['username'])->find();
            if ($result) {
               $this->error('用户重名'); 
            }
            //提交的数据入库
            $adminData = [
                'username'          =>  $data['username'],
                'password'           =>  md5($data['password']),                             
            ];
            //将提交的数据保存在数据库中
            $res = db('admin')->insert($adminData);
            if($res) {
                $this->success('添加成功', url('user/index'));
            }else {
                $this->error('添加失败', url('user/add'));
            }
        }else{
            return $this->fetch();
        }        
    }     
    //删除管理员信息
    public function del() {
        $id = input('id');
        $rget =db('admin')->where('id',$id)->delete();
        if($rget){
            $this->success('更新成功');
        }else {
            $this->error('更新失败');
        }       
    }
}