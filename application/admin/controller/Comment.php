<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Comment as CommentModel;
class Comment extends  Common
 {

    public function lis()
    {
        $comlis=db('comment')->order('comid','desc')->paginate(5);
        $content=db('comment')->select();
        $this->assign('comlis',$comlis);
        $this->assign('content',$content);
        // echo $comlis[3]['content'];

        // echo substr($comlis[3]['content'],0,10);
       
        // exit();
        // dump(substr($comlis['content']),0,10);
        return view();
    }

   
    public function add()
    {
       
        if(request()->isPost())
        { 
            $ComModel=new CommentModel();
            $data=input('post.');
            $data['comtime']=time();
            $Commes=$ComModel->save($data);
            if($Commes){
                $this->success("添加留言成功！",url('lis'));
            }else{
                $this->error("添加留言失败");
            }
        }
        return view();
    }

    public function edit()
    {
        $ComModel=new CommentModel();
        if(request()->isPost())
        {
            $data=input('post.');
           
            $Commes=db('comment')->update($data);
            if($Commes !==false){
                $this->success("留言信息编辑成功！",url('lis'));
            }else{
                $this->error("留言信息编辑失败！");
            }
        }
        $EditData=$ComModel->find(input('id'));
        $this->assign('edit',$EditData);
        return view();
    }

    public function del()
    {
        $comdel=db('comment')->delete(input('id'));
        if($comdel){
            $this->success("留言删除成功！");
        }else{
            $this->error("留言删除失败！");
        }

    }

    public function liu()
    {
        $comres=db('comment')->select(input('id'));
        $this->assign("edit",$comres);
        return view();
    }

  

    
}
