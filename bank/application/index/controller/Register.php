<?php 
namespace app\index\controller;


class Register extends \think\Controller
{
    public function index(){
        return $this->fetch();
    }
    
    public function add() {
        //判断是否為post传参
        if(!request()->isPost()) {
            echo 1;die;
        }
        //获取提交的数据
        $data = input('post.');
        //print_r($data);die;
        
        //判断输入的图片验证码是否正确
        if(!captcha_check($data['checkCode'])){
            //验证码不正确
            echo 2;die;
        }
    
        //手机验证码判断
        if($data['randCode'] != cookie('randCode')){
           echo 3;die;
        }
        $number = 'E'.time();
        //注册信息
        $reg_data = [
            'tel' => $data['phone'],
            'username' => $data['username'],
            'password' => md5($data['password']),
            'number' => $number,
        ];  
        $res = db('user')->insert($reg_data);
        if($res){
            echo 4;die;
        }else{
            echo 5;die;
        }
    }
    //发送短信验证码
    public function sendCode() {
         
        $phone = input('post.phone');
        //一个手机号只能注册一个账户
        $result = db('user')->where('tel',$phone)->find();
    
        if($result){
            echo 1;die;
        }else{
    
            //手机短信验证码发送
            $code = mt_rand(100000,999999);
            
            sendSms($phone,$code);
            //接收发送的验证码
            $Code = cookie('randCode',$code,60);
    
        }
    }
}
?>