<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/3/30
 * Time: 21:00
 */

namespace app\index\validate;


use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck(){
        $request = Request::instance();
        $array = $request->param();
        if(!$this->scene("login")->check($array)){
            return $this->getError();
        }

    }

}