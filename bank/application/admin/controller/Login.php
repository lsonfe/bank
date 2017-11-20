<?php 
namespace app\admin\controller;
use think\Controller;

class Login extends Controller
{
    public function index(){
        //获取数据
        $data = input('post.');
        //判断登录
        if($data){
            $where = [
                'username' => $data['username'],
                'password' => md5($data['password']),
            ];
            $res = db('admin')->where($where)->find();
            if($res){
                //设置session
                session('user',$data['username'],'edu');
                $this->redirect('index/index');
            }else{
                $this->error('用户名或密码错误');
            }
        }else{
            $user = session('user','','edu');
            if($user && $user->id){
                $this->redirect(url('index/index'));
            }
            return $this->fetch();
        }
 
    }
    
    public function loginout(){
        //清除session
        session(null,'edu');
        $this->redirect('index/index');
    }
    
}
    

?>