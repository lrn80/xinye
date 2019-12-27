<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Photo as PhotoModel;

class Photo extends Common
{
   
    public function lis()
    {
        $pholis=db('photo')->order('id','desc')->paginate(10);
        $this->assign("pholis",$pholis);
        return view();
    }

    

    public function add()
    {
        if(request()->isPost())
        {
            $data=input('post.');
            if(empty($data)){
                $this->error('图片格式不正确！');
            }
            
            
            

            if(!$_FILES['photo']['tmp_name']) 
            {
                $this->error("图片添加失败!");
            }

           
            $type= getimagesize($_FILES['photo']['tmp_name']);
        
        
           if(empty($type['mime'])){
               $this->error("图片格式不正确！！！");
           }

            $data['photime']="{$data['photime1']}-{$data['photime2']}-{$data['photime3']}";
            unset($data['photime1'],$data['photime2'],$data['photime3']);
            $PhoModel=new PhotoModel();
            $Phomes=$PhoModel->save($data);
            
            if($Phomes){
                $this->success("添加图片成功！",url('lis'));
            }else{
                $this->error("添加图片失败");
            }
        }
        return view();
    }
    

    public function edit()
    {
        $PhoModel=new PhotoModel();
        if(request()->isPost())
        {
            
            $data=$PhoModel->update(input("post."));
            if($data){
                $this->success("图片修改成功！",url('lis'));
            }else{
                $this->error("图片修改失败！");
            }
        }
        $pholis=db('photo')->find(input('id'));
        $this->assign("pholis",$pholis);
        return view();
    }

  
    public function del()
    {
      $PhoModel=new PhotoModel();
      $data=db('photo')->where('id',input('id'))->find();
     
      if($data!='')
      {
          $dataPath=$_SERVER['DOCUMENT_ROOT'].$data['photo'];
        @unlink($dataPath);
      }
        $comdel=db('photo')->delete(input('id'));
        
        if($comdel){
            $this->success("图片删除成功！");
        }else{
            $this->error("图片删除失败！");
        }

    }



}
