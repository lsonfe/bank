<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/*
 * 审核状态
 * 0 待审，1 通过， 2 拒绝
 */
function status1($status) {
    if($status == 1){
        $str = "<span class='label label-success radius'>审核通过</span>";
    }elseif($status == 0){
        $str = "<span class='label label-danger radius'>待审</span>";
    }else{
        $str = "<span class='label label-danger radius'>不通过</span>";
    }
    return $str;
}

/**
 * 通用的分页样式
 * @param unknown $obj
 */
function pagination($obj){
    if(!$obj){
        return '';
    }
    //获取url后面参数的方法       tp5自带
    $params = request()->param();
    return "<div class='cl pd-5 bg-1 bk-gray mt-20 tp5-o2o'>".$obj->appends($params)->render()."</div>";
}

include '../extend/sendSms/php/api_sdk/aliyun-php-sdk-core/Config.php';
include_once '../extend/sendSms/php/api_sdk/Dysmsapi/Request/V20170525/SendSmsRequest.php';
include_once '../extend/sendSms/php/api_sdk/Dysmsapi/Request/V20170525/QuerySendDetailsRequest.php';
/*function sendSms
 * 发送手机短信验证码
 * @param $phone 发送目标号码     char
 * @param $code  验证码                int
 */
function sendSms($phone,$code) {

    //此处需要替换成自己的AK信息
    $accessKeyId = "LTAItrnzqjQYUxS1";
    $accessKeySecret = "Cw4bT83j4PsUHffEmzRXAeNtM4DS40";
    //短信API产品名
    $product = "Dysmsapi";
    //短信API产品域名
    $domain = "dysmsapi.aliyuncs.com";
    //暂时不支持多Region
    $region = "cn-hangzhou";

    //初始化访问的acsCleint
    $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
    DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
    $acsClient= new DefaultAcsClient($profile);

    $request = new Dysmsapi\Request\V20170525\SendSmsRequest;
    //必填-短信接收号码
    $request->setPhoneNumbers("$phone");
    //必填-短信签名
    $request->setSignName("达克云科技");
    //必填-短信模板Code
    $request->setTemplateCode("SMS_96965039");
    //选填-假如模板中存在变量需要替换则为必填(JSON格式)
    $request->setTemplateParam("{\"code\":\"$code\"}");
    //选填-发送短信流水号
    //$request->setOutId("1234");

    //发起访问请求
    $acsResponse = $acsClient->getAcsResponse($request);
    //var_dump($acsResponse);
}