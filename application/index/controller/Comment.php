<?php
namespace app\index\controller;
use app\index\model\Comment as CommentModel;
use think\Controller;

class Comment extends Controller
{
    public function Comment()
    {  
       
        if(request()->isPost())
        { 
            $ComModel=new CommentModel();
            $data=input('post.');
            // dump($data);
            // die;
            if($data['content']==null||$data['comemail']==null||$data['comname']==null){
                $this->error('留言内容不能为空,请重新输入');
            }
            $pattern = '/^[a-z0-9]+([._-][a-z0-9]+)*@([0-9a-z]+\.[a-z]{2,14}(\.[a-z]{2})?)$/i';
            if(!preg_match($pattern,$data['comemail'])){
                $this->error("请输入正确的邮件形式");
            }
            $data['comtime']=time();
            $Commes=$ComModel->save($data);
            if($Commes){
                $this->success("添加留言成功！");
            }else{
                $this->error("添加留言失败");
            }
        }
        return view();
    }


}
