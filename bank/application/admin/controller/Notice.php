<?php
namespace app\admin\controller;
 
use think\Controller;
class Notice extends Controller
{
    //列表页
    public function index()
    {
        //查询数据库内容
        $data = db('notice')->select();
		return $this->fetch('',[
		    'data' => $data,
		]);
	} 
	//添加
	public function add(){   
	    if(request()->isPost()){
	        $data = input('post.');
	        $ins_data = [
	            'title' => $data['title'],
	            'time' => strtotime($data['time']),
	            'content' => $data['content'],
	        ];
	        $res = db('notice')->insert($ins_data);
	        if($res){
	            $this->success('添加成功','admin/notice/index','',2);
	        }else{
	            $this->error('添加失败','admin/notice/index','',2);
	        }
	        
	    }else{
	        return $this->fetch();
	    }
	}
	//修改
	public function edit(){
	    if(request()->isPost()){
    	   $datas = input('post.');
    	 
    	   $datas['time'] = time();
    	   $res = db('notice')->where('id',$datas['id'])->update($datas);
    	   if($res){
    	       $this->success('修改成功','admin/notice/index','',2);
    	   }else{
    	       $this->error('修改失败');
    	   }
	    }else{
	        $id = input('get.id');
	        $data = db('notice')->where('id',$id)->find();
	        return $this->fetch('',[
	            'data' => $data
	        ]);
	    }
	}
	//删除
	public function del(){
	    $id = input('id');
	    //删除操作
	    $dels = db('notice')->where('id',$id)->delete();
	    if($dels){
	        $this->success('删除成功','notice/index','',2);
	    }else{
	        $this->error('删除失败');
	    }
	}
    
}



















