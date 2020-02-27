<?php


namespace app\admin\model;


use think\Model;

class Book extends Model
{
    public function add(){

    }
    public function del($id){
        if($this::destroy($id)){
            return 1;
        }else{
            return 2;
        }
    }
}