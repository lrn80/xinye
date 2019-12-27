<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/3/20
 * Time: 17:13
 */
namespace app\index\controller;

use think\captcha\Captcha;
use think\Controller;
use think\Session;


class Base extends Controller
{
    public function _initialize(){

    }
    public function isLogin(){
        $user = Session::get("UsernameID");
        if(isset($user)){
            return true;
        }else{
            return false;
        }
    }
    public function captcha(){
        $captcha = new Captcha();
        $captcha->length = 4;
        $captcha->fontSize = 30;
        return $captcha->entry();
    }
    public function sendEmail($email=""){
        if(!isset($email)){
            return "未输入正确邮箱，请重新输入";
        }
        $validate = "";
        for($i=0 ; $i<6; $i++){
            $number = rand(0,9);
            $validate = $validate."".$number;
        }
        Session::delete("validate");
        Session::set("validate","$validate");
        $set = $email;
        $title = 'text';
        $message = "<h3><a>".$validate."</a></h3>";
        $name = "laowang";
        \Mail::Qmail($set ,$name ,$title ,$message);
    }
}