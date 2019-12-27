<?php
namespace app\admin\model;
use think\Model;
class Photo extends Model
{

    protected static function init()
    {
        Photo::event('before_insert',function($photo){
            if($_FILES['photo']['tmp_name']){
                  $file = request()->file('photo');
                  $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                 
                  if($info){
                      // $thumb=ROOT_PATH . 'public' . DS . 'uploads'.'/'.$info->getExtension();
                      $thumb = DS.'uploads'.'/'.$info->getSaveName();
                      $photo['photo']=$thumb;
                  }
              }
        });


        Photo::event('before_update',function($photo){
           
            if($_FILES['photo']['tmp_name']){
                    $arts=Photo::find($photo->id);
                    $thumbpath=$_SERVER['DOCUMENT_ROOT'].$arts['photo'];
                  if(file_exists($thumbpath)){
                      @unlink($thumbpath);
                  }
                  $file = request()->file('photo');
                  $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                  if($info){
                      // $thumb=ROOT_PATH . 'public' . DS . 'uploads'.'/'.$info->getExtension();
                      $thumb = DS.'uploads'.'/'.$info->getSaveName();
                      $photo['photo']=$thumb;
                  }
  
              }
        });

        
  
    }
}




?>