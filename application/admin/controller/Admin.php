<?php
namespace app\admin\controller;
use app\admin\model\Admin as AdminModel;
use app\admin\controller\Common;
use app\admin\controller\Validateadmin;
class Admin extends Common
{
   
    public function lst()
    {
       $auth=new Auth();
       $admin=new AdminModel();
       $adminres=$admin->getadmin();
       foreach ($adminres as $k => $v) {
         $_groupTitle=$auth->getGroups($v['id']);
         $groupTitle=$_groupTitle[0]['title'];
         $v['groupTitle']=$groupTitle;
     }
       $this->assign('adminres',$adminres);
       return view();
    }


    public function add()
    {
      if(request()->isPost()){
         $arr=array();
         $arr=input('post.');
         $this->username($arr['username']);
         $this->password($arr['password']);
         $this->name($arr['name']);
         $this->tel($arr['tel']);
         $this->confirmpwd($arr['confirmpwd'],$arr['password']);
            $admin=new AdminModel();
              if($admin->addadmin($arr)){
                 $this->success('添加管理员成功 ',url('lst'));
              }else{
               $this->error('添加管理员失败请重新添加！',url('add'));
              }
                  return;
            }
      
         //分配用户组
         $authGroupRes=db('auth_group')->select();
         $this->assign('authGroupRes',$authGroupRes);
       return view();
     
    }
    

    public function edit($id)
    {
       $admins=db('admin')->find($id);
     //  dump($admins);
     //  die();
       if(request()->isPost()){
          $data=input('post.');
       
       $admin=new AdminModel();
          if( $admin->saveadmin($data,$admins)!==false){
             if($admin->saveadmin($data,$admins)==2){
               $this->error('用户名不能为空');
             }
             if($admin->saveadmin($data,$admins)==3){
               $this->error('输入的两次密码不相同');
             }
             $this->success('修改成功！',url('lst'));
          }else{
             $this->error('修改失败！');
          }
          return;
       }
       if(!$admins){
          $this->error('该管理员不存在');
       }

       $authGroupAccess=db('auth_group_access')->where(array('uid'=>$id))->find();
       $authGroupRes=db('auth_group')->select();
       $this->assign('authGroupRes',$authGroupRes);
       $this->assign('groupId',$authGroupAccess['group_id']);
       
      $this->assign('admin',$admins);
      return view();
    }


    public function del($id){
           $admin=new AdminModel();
           $delnum=$admin->deladmin($id);
           if($delnum=='1'){
              $this->success('删除管理员成功！',url('lst'));
           }else{
              $this->error('删除失败');
           }
    }


    public function logout(){
      session(null); 
      $this->success('退出系统成功！',url('login/index'));
  }

     public function username($username){
     
                    $res='/^[\da-zA-z]{5,12}$/';
                  
                    if($username==""){
                        $this->error('用户名不能为空！',url('add'));
                        return ;
                     }
                    $info=db('admin')->where('username','=',$username)->find();
                     if($info){
                        $this->error('用户名已存在',url('add'));
                        return ;
                      }
                   
                      if(!preg_match($res, $username))
                      {
                        $this->error('长度为5-15位（字母、数字），不能含有特殊符号',url('add'));
                        return ;
                    }
            
    }
    
    public function password($password){
       
         //验证密码
       
            $res='/^[\da-zA-z]{5,12}$/';

            if($password==""){
                $this->error("密码不能为空！",url('add'));
                                           return ;
             }
                if(!preg_match($res, $password ))
                {
                    $this->error("长度为5-15位（字母、数字），不能含有特殊符号",url('add'));
                    return ;
                }
                return ;
              
}
public function confirmpwd($confirmpwd,$password){
   
  
    if($confirmpwd==""){
        $this->error("确认密码密码不能为空！",url('add'));
      return "";
     }
        if($confirmpwd!==$password)
        {
            $this->error("两次输入的密码不一样",url('add'));
          return  '';
        }
        return "";
      
}
public function name($name){
    
    $res='/^[\x{4E00}-\x{9FA5}\x{f900}-\x{fa2d}·s]{2,20}$/u';

  
    if($name==""){
        $this->error("名字不能为空！",url('add'));
      return ;
     }
    if(!preg_match($res,$name))
   {
    $this->error('请输入真实姓名的正确格式',url('add'));
       return  ;
   }
   return "";
     
}
public function tel($tel){
   
    $res='/^1[34578]\d{9}$/';
     
     if($tel==""){
        $this->error( "手机号码不能为空！",url('add'));
       return;
      }
      if(!preg_match($res,$tel))
     {
        $this->error('请输入手机号的正确格式',url('add'));
        return  ;
     }
     return "";
       
}
}
