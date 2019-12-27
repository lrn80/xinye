<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model
{

   public function addadmin($data){
      if(empty($data) || !is_array($data)){
         return false;
     }
 

     if($data['password']){
         $data['password']=md5(md5($data['password']));
     }
     $adminData=array();
     $adminData['username']=$data['username'];
     $adminData['password']=$data['password'];
     $adminData['name']    =$data['name'];
     $adminData['tel']     =$data['tel'];
     $adminData['addate']		= time();
     if($adminData['password'] != md5(md5(($data['confirmpwd']))))	{
       
       $this->error('两次输入的密码不相等,请重新添加',url('add'));
    }
    
     if($this->save($adminData)){
         $groupAccess['uid']=$this->id;               //添加管理员的id
         $groupAccess['group_id']=$data['group_id'];  //分组的id
         db('auth_group_access')->insert($groupAccess);
         return true;
     }else{
         return false;
     }
 
   }

  
   //分页函数
   public function getadmin(){
       return $this::paginate(5,false,[
           'type'=>'bootstrap',
           'var_page'=>'page',
       ]);
   }
   //管理员修改
   public function saveadmin($data,$admins){
       $arr=array();
       $arr['id']=$data['id'];
    if(!$data['username']){
       return 2;
     }else{
         $arr['username']=$data['username'];
     }
     if(!$data['password']){
        $arr['password']=$admins['password'];
     }else{
        $arr['password']=md5(md5($data['password']));
     }
     if(!$data['name']){
        $arr['name']=$admins['name'];
     }else{
        $arr['name']=$data['name'];
     }
     if(!$data['tel']){
        $arr['tel']=$admins['tel'];
     }else{
        $arr['tel']=$data['tel'];
     }
     $arr['addate']		= time();
     db('auth_group_access')->where(array('uid'=>$data['id']))->update(['group_id'=>$data['group_id']]);
     return $this::db('admin')->update($arr);
   }

   //管理员删除
   public function deladmin($id){
       if($this::destroy($id)){
           return 1;
       }else{
           return 2;
       }
   }

    public function login($data){
        $admin=Admin::where('username',$data['username'])->find();
           	//(4)更新用户资料：最后登录的IP、最后登录时间、登录总次数
		$arr['last_login_ip']		= $_SERVER['REMOTE_ADDR'];
		$arr['last_login_time'] 	= time();
        $arr['login_times']		    = $admin['login_times']+1;
        $arr['id']                  =$admin['id'];
		if(!$this::db('admin')->where('username',$data['username'])->update($arr))
		{
		return 4;
		}
        if($admin){
            if($admin['password']==md5(md5($data['password']))){
               session('id', $admin['id']);
                session('username', $admin['username']);
                return 1; //登录密码正确的情况
            }else{
                return 0; //登录密码错误  用户名不存在
            }
        }
    }

 
}
