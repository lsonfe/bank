<?php
namespace app\admin\controller;
 
use think\Controller;
class  Index extends Controller
{
    public function index()
    {
        //获取session
        $user = session('user','','edu');
        if(!$user){
            $this->redirect('login/index');
        }
		return $this->fetch();
	} 
    public  function welcome(){
        return '欢迎来到时间银行后台首页';
    }
    public function test(){
        sendSms('13774024983', 7556);
    }
}




















