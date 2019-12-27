<?php
namespace app\index\model;
use think\Model;
class Photo extends Model
{
    public function selPhoto($year)
    {
        
        $sql="select * from xy_photo where year(photime)={$year}";
        $data=Photo::query($sql);
        return $data;
    }
    
}




?>