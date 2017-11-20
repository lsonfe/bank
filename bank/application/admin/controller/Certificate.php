<?php 
namespace app\admin\controller;
use think\Controller;

class Certificate extends Controller
{
public function index(){
        //查询数据库
        $data = db('certificate')->where(['status'=>0])->select();
        return $this->fetch('',[
            'data' => $data,
        ]);
    }
    
    //审核记录
    public function record(){
        //查询数据库
        $data = db('certificate')->where('status','neq',0)->select();
        return $this->fetch('',[
            'data' => $data,
        ]);
    }
    //审核页面
    public function check(){
        $id = input('get.id');
        $data = db('certificate')->where('id',$id)->find();
        return $this->fetch('',[
            'data'=>$data,
        ]);
    }
    //修改状态，审核通过或拒绝  1通过，2拒绝
    public function edit(){
        $data = input('get.');
        if(empty($data)){
            return $this->error('数据不合法');
        }
        $status = $data['status'];
        $id = $data['id'];
        $res = db('certificate')->where('id',$id)->update(['status'=>$status]);
        if($res){
            return $this->success('审核成功','admin/certificate/index','',2);
        }else{
            return $this->error('审核操作失败');
        }
    }
    
    //删除
	public function del(){
	    $id = input('id');
	    //删除操作
	    $dels = db('certificate')->where('id',$id)->delete();
	    if($dels){
	        $this->success('删除成功','certificate/index','',2);
	    }else{
	        $this->error('删除失败');
	    }
	}
}
?>