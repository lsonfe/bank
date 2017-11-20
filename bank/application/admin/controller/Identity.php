<?php 
namespace app\admin\controller;
use think\Controller;

class Identity extends Controller
{
    public function index(){
        //查询数据库
        $data = db('identity')->where(['status'=>0])->select();
        return $this->fetch('',[
            'data' => $data,
        ]);
    }
    
    //审核记录
    public function record(){
        //查询数据库
        $data = db('identity')->where('status','neq',0)->select();
        return $this->fetch('',[
            'data' => $data,
        ]);
    }
    //审核页面
    public function check(){
        $id = input('get.id');
        $data = db('identity')->where('id',$id)->find();
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
        $res = db('identity')->where('id',$id)->update(['status'=>$status]);
        if($res){
            return $this->success('审核成功','admin/identity/index','',2);
        }else{
            return $this->error('审核操作失败');
        }
    }
    
    //删除
	public function del(){
	    $id = input('id');
	    //删除操作
	    $dels = db('identity')->where('id',$id)->delete();
	    if($dels){
	        $this->success('删除成功','identity/index','',2);
	    }else{
	        $this->error('删除失败');
	    }
	}
}

?>