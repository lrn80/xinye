<?php
namespace app\index\controller;
use app\index\model\Photo as photoModel;
use think\Controller;
class Photo extends controller
{
    public function photo()
    {

        $data=model('photo')->field("year(photime) as year,count(*)")->order("year","desc")->group("year")->select();
//        $data = model('photo')->field("year(photime) as year")->select();
        $dataYear=array();
        foreach($data as $k=>$v){
            $dataYear[$k]=$v['year'];
        }
        // dump($dataYear);
        // die;

        $this->assign('year',$dataYear);
        return view();
    }

    public function jiekou()
    {
        $data=db('photo')->field("year(photime) as year,photo")->order('year','desc')->select(); //获取所有年份对应图片的二维数组
        $dataPhoto=array_column($data,'year','photo');         //二维数组下标转换
        $name=$_GET['id'];                  //获取对应的年份
        
        $datayear=array();      
        foreach($dataPhoto as $k=>$v){
            if($v==$name){
                $datayear[]=$k;                         //获取对应年份传过来的数据
            }
        }
        $datayear2=array();
        $datayear2['phoPath']=$datayear;

        echo json_encode($datayear2);

    }


    
   

}