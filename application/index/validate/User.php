<?php
namespace app\index\validate;
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/3/15
 * Time: 19:24
 */
class User extends BaseValidate {
    protected $rule = [
        'username'      =>   'require|max:10',
        'email'         =>   'require|email',
        'password'      =>   'require|min:6|max:12',
        'captcha|验证码' =>   'require|captcha',
    ];
    protected $message = [
        'username.require'  =>   '用户名是必须的',
        'username.max'      =>   '用户名不能超过10个字符',
        'email.email'       =>   '邮箱格式不正确',
        'password.min'      =>   '密码长度不能小于6位',
        'password.max'      =>   '密码长度不能大于12位',
        'validate.max'      =>   '验证码长度不能超过8位',
    ];
    protected $scene = [
        'login'     =>    ['username', 'password', 'captcha'],
        'register'  =>    ['username', 'password' ,'validate', 'email'],
    ];
}