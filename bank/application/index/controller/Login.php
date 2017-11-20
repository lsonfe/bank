<?php
namespace app\index\controller;

class Login extends Base
{
    public function index()
    {
        $data = input('post.');
        //有数据传输则进行账号密码判断
        if(!empty($data)){
            $tel = $data['tel'];
            $pwd= $data['password'];
            $pwd1 = md5($pwd);
            $res = db('user')->where(['tel'=> $tel])->find();
            //判断用户存不存在
            if(empty($res)){
                echo 1;die;
            }
            //判断输入的图片验证码是否正确
            if(!captcha_check($data['checkCode'])){
                //验证码不正确
                echo 2;die;
            }
            //判断密码是否正确
            $pwd2 = $res['password'];
            if($pwd1 != $pwd2){
                echo 3;die;
            }else{
                $time =time();
                db('user')->where('tel',$tel)->update(['last_login_time'=>$time]);
                //用户登录成功，记录session
                session('tel',$tel,'bank');
                echo 4;die;
            }
                   
        //进入登录界面    
        }else{
            return $this->fetch();
        }
        
    }   
    //退出登录
    public function loginout(){
        session(null, 'bank');
         $this->redirect('index/index/index');
    }
    //忘记密码
    public function forget(){
        return $this->fetch();
    }
    //修改密码
    public function edit(){
        $data = input('post.');
        
        if(empty($data)){
            echo 1;die;
        }
        $code = $data['code'];
        $randcode = cookie('randCode');
        //判断验证码是否正确
        if($code != $randcode){
            echo 2;die;
        }
        $tel = $data['tel'];
        $pwds = $data['password'];
        //对密码加密
        $pwd = md5($pwds);
        //file_put_contents('test.txt',$pwd);
        $dd=['password'=>$pwd];
        //修改密码
        $res = db('user')->where('tel',$tel)->update($dd);
        if($res){
            echo 3;die;
        }else{
            echo 4;die;
        }
    }
    //发送短信验证码
    public function sendCode() {
         
        $phone = input('post.phone');
        //一个手机号只能注册一个账户
        $result = db('user')->where('tel',$phone)->find();
    
        if(!$result){
            echo 1;die;
        }else{
    
            //手机短信验证码发送
            $code = mt_rand(100000,999999);
            $code = '123456';
            sendSms($phone,$code);
            //接收发送的验证码
            $Code = cookie('randCode',$code,60);
    
        }
    }
}
