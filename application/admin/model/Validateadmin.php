<?php
namespace app\admin\model;
use think\Model;
use think\Request;
class Validateadmin extends Model
{

  public function username(){
    $request=Request::instance();
            //验证用户名
            if($request->has('username','get')){
                $res='/^[\da-zA-z]{5,12}$/';
                $username=$request->get('username');
                if($username==""){
                  return "*用户名不能为空！";
                 }
                $info=db('admin')->where('username','=',$username)->find();
                 if($info){
                    return "*用户名已存在";
                  }
               
                  if(!preg_match($res, $username))
                  {
                    return  '*长度为5-15位（字母、数字），不能含有特殊符号';
                  }
                  return "";
                }
        
}
public function username_edit(){
  $request=Request::instance();
          //验证用户名
          if($request->has('username1','get')){
              $res='/^[\da-zA-z]{5,12}$/';
              $username1=$request->get('username1');
              if($username1==""){
                return "*用户名不能为空！";
               }
                if(!preg_match($res, $username1))
                {
                  return  '*长度为5-15位（字母、数字），不能含有特殊符号';
                }
                return "";
              }
      
}
       public function password(){
        $request=Request::instance();
         //验证密码
        if($request->has('password','get')){
            $res='/^[\da-zA-z]{5,12}$/';
            $password=$request->get('password');
            if($password==""){
              return "*密码不能为空！";
             }
                if(!preg_match($res, $password ))
                {
                  return  '*长度为5-15位（字母、数字），不能含有特殊符号';
                }
                return "";
              }
}
public function confirmpwd(){
    $request=Request::instance();
  //确认密码
  if($request->has('confirmpwd','get')){
    $password=$request->get('password1');
    $confirmpwd=$request->get('confirmpwd');
    if($confirmpwd==""){
      return "*确认密码密码不能为空！";
     }
        if($confirmpwd!==$password)
        {
          return  '两次输入的密码不一样';
        }
        return "";
      }
}
public function name(){
    $request=Request::instance();
   
   //验证真实姓名
   if($request->has('name','get')){
    $res='/^[\x{4E00}-\x{9FA5}\x{f900}-\x{fa2d}·s]{2,20}$/u';

    $name=$request->get('name');
    if($name==""){
      return "*名字不能为空！";
     }
    if(!preg_match($res,$name))
   {
       return  '*请输入真实姓名的正确格式';
   }
   return "";
     }
}
public function tel(){
    $request=Request::instance();
  //  第一位是1第二位可能是34578的十一位数字
 if($request->has('tel','get')){
              
    $res='/^1[34578]\d{9}$/';
     $tel=$request->get('tel');
     if($tel==""){
       return "*手机号码不能为空！";
      }
      if(!preg_match($res,$tel))
     {
        return  '*请输入手机号的正确格式';
     }
     return "";
       }
}
}
