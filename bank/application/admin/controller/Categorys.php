<?php
namespace app\admin\controller;
 
use think\Controller;
class Categorys extends Controller {    
    //商品分类信息列表
    public function index() {
        //查询商品分类表中的所有数据
        $local = db('shop_category')->select();
        return $this->fetch('',['local'=>$local]);
    }
    
    //商品分类信息添加
    public function add() {
        //判断表单是否通过post方式传参
        if(request()->isPost()) {
            //获取提交数据
            $data = input("post.");
            //提交的数据入库
            $localData = [
                'name' => $data['name'],
                'pid' =>  0,
            ];
            //将提交的数据保存在数据库中
            $res = db('shop_category')->insert($localData);
            if($res) {
                $this->success('添加成功', url('categorys/index'));
            }else {
                $this->error('添加失败', url('categorys/add'));
            }
        }else{
            return $this->fetch();
        }        
    }    
  
    //删除商品分类信息
    public function del() {
        $id = input('id');
        $rget =db('shop_category')->where('id',$id)->delete();
        if($rget){
            $this->success('更新成功');
        }else {
            $this->error('更新失败');
        }       
    }
}