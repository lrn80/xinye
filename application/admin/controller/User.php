<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use think\Request;
use think\Validate;
use app\admin\model;

class User extends Common
{
    private  $obj;
  //  public function _initialize() {
  //     
   // }
    //用户列表
    public function user_list(){
      $this->obj = model("User");
        $map['status'] = [
            ['eq', 1],
            ['eq', 0],
            'or'
        ];
      $result = $this->obj->where($map)->paginate(5);
      if(!$result){
        return $this->error("查询错误");
      }
      return $this->fetch("user/list",['result' => $result]);
    }
    
    //删除用户列表
    public function user_delete_list(){
      $this->obj = model("User");
        $map['status'] = [
            'eq', -1
        ];
        $result = $this->obj->where($map)->paginate(5);
        if(!$result){
            return $this->error("查询错误");
        }
        return $this->fetch("user/delete_list",['result' => $result]);
    }
    //编辑会员界面
    public function user_edit($id){
      $this->obj = model("User");
        return $this->fetch("user/edit",[
            'id' => $id
        ]);
    }
    //改变状态
    public function status($id = 1){
      $this->obj = model("User");
      $data['status'] = 0;
      $result = $this->obj->get($id);
      if($result){
        if($result['status'] == "启用"){
          $data['status'] = 0;
        }elseif($result['status'] == "禁用"){
          $data['status'] = 1;
        }elseif($result['status'] == "删除"){
          $data['status'] = 0;
        }
      }else{
        return 404;
      }
      if($this->obj->update($data,['id'=>$id])){
        $result = $this->obj->get($id);
        if($result){
          return $result['status'];
        }
      }else{
        return 404;
      }
    }
    //删除会员
    public function delete($id = 0){
      $this->obj = model("User");
        $result = $this->obj->where('id',$id)->update(['status' => '-1']);
        $update = [
            'delete_time' => time(),
        ];
        $this->obj->where('id',$id)->update($update);
        if($result){
            return $this->redirect(url('user/user_list'));
        }else{
            return $this->error('删除失败');
        }
    }
    //彻底删除会员
    public function thorough_delete($id = 0){
      $this->obj = model("User");
        $result = $this->obj->where('id',$id)->delete();
        if($result){
            return $this->redirect(url('user/delete_list'));
        }else{
            return $this->error('彻底删除失败');
        }
    }
    //修改会员信息
    public function edit($id){
      $this->obj = model("User");
        $date = input("post.");
        unset($date['is_show']);
        unset($date['id']);
        $validate = Validate('User');
        if(!$validate->scene('edit')->check($date)){
            $this->error($validate->getError());
        }
        $date['password'] = md5($date['password']);
        if($this->obj->where('id',$id)->update($date)){
            $this->redirect(url('user/user_list'));
        }else{
            $this->error("更新失败");
        }
    }
}