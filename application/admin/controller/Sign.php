<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use  app\admin\model;

class Sign extends Common
{
  private  $obj;
 // public function _initialize() {
  //   
  //}
  
  public function sign_list(){
    $this->obj = model("Sign");
    $result = $this->obj->joinUser()->paginate(5);
    if(!$result){
      $this->error("查询异常");
    }
    $data = model("User")->all();
    return $this->fetch("sign/list",["result" => $result]);
  }
    public function edit($id){
        $this->obj = model("Sign");
        if($this->request->isPost()){
            $date = input("post.");
            $date['sign_time'] = strtotime($date['sign_time']);
            $hour = date("H", $date['sign_time']);
            $minute = date("i", $date['sign_time']);
            $date['sign_time'] = $hour*3600+$minute*60;
            $date['update_time'] = time();
            unset($date['id']);
            var_dump($date);
    //            $validate = Validate('Sign');
    //            if(!$validate->check($date)){
    //                var_dump($validate->getError());
    //            }

            if($this->obj->where('id',$id)->update($date)){
                $this->redirect(url('sign/sign_list'));
            }else{
                $this->error("更新失败");
            }
        }else{
            return $this->fetch("",[
                'id'       =>  $id,
            ]);
        }
    }
    public function add(){
        $this->obj = model("Sign");
        if($this->request->isPost()){
            $date = input("post.");
            $date['sign_date'] = strtotime($date['sign_date']);
            $date['sign_time'] = strtotime($date['sign_time']);
            $hour = date("H", $date['sign_time']);
            $minute = date("i", $date['sign_time']);
            $date['sign_time'] = $hour*3600+$minute*60;
            $date['update_time'] = time();
            //            $validate = Validate('Sign');
            //            if(!$validate->check($date)){
            //                var_dump($validate->getError());
            //            }
            $user = Model("User")->where("username",$date['username'])
                ->find();
            if(!$user){
                return $this->error("用户名不存在");
            }
            $date['user_id'] = $user['id'];
            unset($date['username']);
            var_dump($date);
            if(!$this->obj->save($date)){
                return $this->error("新建失败");
            }
            return $this->redirect("sign/sign_list");
        }else{
            return $this->fetch("");
        }
    }


}