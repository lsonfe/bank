<?php
namespace app\admin\controller;
 
use think\Controller;
class  Shop extends Controller {    
    //商品信息列表
    public function index() {
        //查询商品表中的所有数据
        $local = db('shop')->select();
        foreach($local as &$val){//引用赋值
            //发布活动公司名称
            $val['category_id'] = db('shop_category')->where('id',$val['category_id'])->find()['name'];
        }
        unset($val); // 最后取消掉引用
        return $this->fetch('',['local'=>$local]);
    }
    
    //商品信息添加
    public function add() {
        //判断表单是否通过post方式传参
        if(request()->isPost()) {
            //获取提交数据
            $data = input("post.");
            //提交的数据入库
            $localData = [
                'name' => $data['name'],
                'price' =>  $data['price'],
                'exchanged' =>  $data['exchanged'],
                'stock' => $data['stock'],
                'image' => $data['image'],
                'category_id' => $data['category_id'],
            ];
            //将提交的数据保存在数据库中
            $res = db('shop')->insert($localData);
            if($res) {
                $this->success('添加成功', url('shop/index'));
            }else {
                $this->error('添加失败', url('shop/add'));
            }
        }else{
            $category = db('shop_category')->select();
            return $this->fetch('',['category'=>$category]);
        }        
    }    
    //修改数据
    public function edit(){
        $data =input('post.','','htmlentities');
        //判断是否有post提交数据，是的话进行修改操作
        if(!empty($data)){
            //判断是否上传图片
            if(!empty($data['image'])){
                $re = db('shop')->where('id',$data['id'])->update($data);
            }else{
                //获取图片路径
                $image = db('shop')->where('id',$data['id'])->find()['image'];
                $data['image'] = $image;
                $re = db('shop')->where('id',$data['id'])->update($data);
            }
            //判断是否修改成功
            if($re){
                $this->success('修改成功','shop/index');
            }else{
                $this->error('修改失败');
            }
            //否则进入修改页面进行正常的修改
        }else{
            $id = input('id');
            //获取点击的数据
            $local = db('shop')->where('id',$id)->find();
            $local['category'] = db('shop_category')->where('id',$local['category_id'])->find()['name'];
            $category = db('shop_category')->select();
            return $this->fetch('',[
                'local' => $local,
                'category' => $category,
            ]);
        }
    }
    //删除商品信息
    public function del() {
        $id = input('id');
        $rget =db('shop')->where('id',$id)->delete();
        if($rget){
            $this->success('更新成功');
        }else {
            $this->error('更新失败');
        }       
    }
}