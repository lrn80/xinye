<?php
namespace app\common\model;

use think\Model;

class Category extends Model{
  protected $autoWriteTimestamp = true;

  protected $table = 'category';
  
  public function add($data){
    $result = $this->save($data);
    return $result;
  }
  public function categorylist($arrs,$level=0,$pid=0){
    static $categorys=array();
    foreach($arrs as $arr){
        if($arr['pid']==$pid){
            $arr['level']=$level;
            $categorys[]=$arr;
            $this->categorylist($arrs,$level+1,$arr['id']);
        }
    }
    return $categorys;
  } 
}