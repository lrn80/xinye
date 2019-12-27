<?php
namespace app\common\model;

use think\Model;
use think\Db;

class User extends Model{
  protected $autoWriteTimestamp = true;
  protected $table = "xy_user";
  public function getStatusAttr($value)
  {
      $status = [
        -1=>'删除',
        0=>'禁用',
        1=>'启用',
        404 => '异常'
      ];
      return $status[$value];
  }

}