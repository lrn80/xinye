<?php
namespace app\common\model;

use think\Model;

class Sign extends Model{
  protected $autoWriteTimestamp = true;
  protected $table = "xy_sign";
    /**获取一周时间
     * @param $id 用户ID
     * @param $flag '1'获取一周每天时间的数组，'0'获取一周总时间
     * @return array|int
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
  public function getWeekendTime($id ,$flag){
      $result = $this->where('user_id', $id)
          ->limit(7)
          ->order('id','desc')
          ->select();
      //终止累加时间
      $termination = strtotime('last Sunday')+3600*24-1;
      $array = array();
      $allTime = 0;
      for($i=0; $i<7; $i++){
          if(!isset($result[$i])) break;
          $week = date("w",$result[$i]['sign_date']);
          if($termination < $result[$i]['sign_date']){
              if($week == 0){
                  $week = 7;
              }
              $array[$i]['week'] = $week;
              $array[$i]['time'] = $result[$i]['sign_time'];
              $allTime += $result[$i]['sign_time'];
          }
      }
      if($flag == 1){
          return $array;
      }else{
          return $allTime;
      }
  }

    /**联合user表和sign表查询
     * @return Sign
     *
     */
  public function joinUser(){
      return $this->join('user u','u.id=xy_sign.user_id','left')
          ->field('sign.*,u.username');
  }

    /**获取今日总状态
     * @param $id 用户ID
     * @return int|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
  public function getTodayAll($id){
      $time = strtotime(date("Y-m-d", time()));
      $where['sign_date'] = ["eq", $time];
      $where['user_id'] = ["eq", $id];
      $today = $this->where($where)->find();
      if($today){
          return $today;
      }else{
          return 0;
      }
  }

}