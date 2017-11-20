<?php 
namespace app\admin\controller;

use think\Controller;

class Cnotice extends Controller
{
    //洪山区慈善会列表页
    public function index()
    {
        //查询数据库内容
        $data = db('charitable_notice')->where('belong_id',1)->select();
		return $this->fetch('',[
		    'data' => $data,
		]);
	} 
	//党代表志愿服务基金列表页
	public function index2()
	{
	    //查询数据库内容
	    $data = db('charitable_notice')->where('belong_id',2)->select();
	    return $this->fetch('',[
	        'data' => $data,
	    ]);
	}
	//社区公益基金列表页
	public function index3()
	{
	    //查询数据库内容
	    $data = db('charitable_notice')->where('belong_id',3)->select();
	    return $this->fetch('',[
	        'data' => $data,
	    ]);
	}
	//社会慈善基金列表页
	public function index4()
	{
	    //查询数据库内容
	    $data = db('charitable_notice')->where('belong_id',4)->select();
	    return $this->fetch('',[
	        'data' => $data,
	    ]);
	}
	//社会捐赠基金列表页
	public function index5()
	{
	    //查询数据库内容
	    $data = db('charitable_notice')->where('belong_id',5)->select();
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
	            'belong_id' =>$data['category'],
	        ];
	        $c = $data['category'];
	        if($c==1){
	            $c ='';
	        }
	        $res = db('charitable_notice')->insert($ins_data);
	        if($res){
	            $this->success('添加成功','admin/cnotice/index'.$c,'',2);
	        }else{
	            $this->error('添加失败','admin/cnotice/index'.$c,'',2);
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
    	   $res = db('charitable_notice')->where('id',$datas['id'])->update($datas);
    	   if($res){
    	       $this->success('修改成功','admin/cnotice/index','',2);
    	   }else{
    	       $this->error('修改失败');
    	   }
	    }else{
	        $id = input('get.id');
	        $data = db('charitable_notice')->where('id',$id)->find();
	        return $this->fetch('',[
	            'data' => $data
	        ]);
	    }
	}
	//删除
	public function del(){
	    $id = input('id');
	    //删除操作
	    $dels = db('charitable_notice')->where('id',$id)->delete();
	    if($dels){
	        $this->success('删除成功','cnotice/index','',2);
	    }else{
	        $this->error('删除失败');
	    }
	}
}

?>