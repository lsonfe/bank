<?php
namespace app\index\controller;

class Base extends \think\Controller
{
    public $account = '';
    public function _initialize(){
        
        $this->assign('tel',$this->getLoginUser());
      
    }   
    //获取session
    public function getLoginUser(){
        if(!$this->account){
            $this->account = session('tel','','dake');
        }
        return $this->account;
    }
}
