<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller
{
    public function index()
    {
    
        // $this->check(input('code'));
        if(request()->isPost()){
            $this->check(input('code'));
            $admin=new Admin();
            $num=$admin->login(input('post.'));
            $num1=$num;
            if($num==1){
                $this->success('登陆成功！',url('index/index'));
            }else{
                $this->error('账号或密码错误！');
            }
        }
       

       return view('login');
      
    }

      // 验证码检测
     public function check($code='')
      {
          if (!captcha_check($code)) {
            $this->error('验证码错误！');
          } else {
              return true;
          }
      }
  
    }