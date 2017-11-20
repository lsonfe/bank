<?php
namespace app\index\controller;

class Index extends Base
{
    //首页
    public function index()
    {
        //首页轮播图
        $banner = db('banner')->select();
        //平台信息
        $platform = db('platform')->order('id','desc')->limit(3)->select();
        //地方动态
        $local = db('local')->order('id','desc')->limit(3)->select();
        //热点项目
        $project = db('project')->order('id','desc')->limit(5)->select();
        //光荣团队
        $team = db('team')->order('id','desc')->limit(5)->select();
        //顶级服务分类
        $one = db('category')->where('pid',0)->select();
        //次级服务分类
        foreach($one as $key=>$val){
            $result = db('category')->where('pid',$val['id'])->select();
            $one[$key]['two'] = $result;
        }
        //现有会员数量
        $count = db('user')->count('id');
        //现有时间币总量
        $money = db('user_information')->sum('money');
        //会员风采
        $member = db('member')->order('id','desc')->limit(5)->select();
        return $this->fetch('',[
            'banner' => $banner,
            'platform' => $platform,
            'local' => $local,
            'project' => $project,
            'team' => $team,
            'one' => $one,
            'member' => $member,
        ]);
    }
}
