<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function status($status) {
  $status = $status;
  if($status == 1) {
      $str = "启用";
  }elseif($status == 0) {
      $str = "禁用";
  }else {
      $str = "删除";
  }
  return $str;
}

/**总时间类型
 * @param $seconds
 * @return string
 */
function changeTimeType($seconds) {
    if(!is_int($seconds)){
        return $seconds;
    }
    if ($seconds > 3600) { 
        $hours = intval($seconds / 3600);
        $minutes = $seconds % 3600;
        if($hours < 10){
            $time = "0". $hours . "小时" . gmstrftime('%M分钟%S', $minutes)."秒";
        }else{
            $time = $hours . "小时" . gmstrftime('%M分钟%S', $minutes)."秒";
        }
    } else { 
        $time = gmstrftime('%H小时%M分钟%S', $seconds)."秒";
    } 
    return $time;
}
function changeWeek($week){
    switch ($week){
        case 1:
            return "周一";
        case 2:
            return "周二";
        case 3:
            return "周三";
        case 4:
            return "周四";
        case 5:
            return "周五";
        case 6:
            return "周六";
        case 7:
            return "周日";
    }
}

/**使用前台需要的数据性质
 * @param $time
 */
function changeDate($seconds)
{
    if (!is_int($seconds)) {
        return $seconds;
    }
    if ($seconds > 3600) {
        $hours = intval($seconds / 3600);
        $minutes = $seconds % 3600;
        if ($hours < 10) {
            $time = '<i>0' . $hours . "</i>小时<i>" . gmstrftime('%M</i>分钟<i>%S</i>', $minutes);
        } else {
            $time = '<i>' . $hours . "</i>小时<i>" . gmstrftime('%M</i>分钟<i>%S</i>', $minutes);
        }
    } else {
        $time = gmstrftime('<i>%H</i>小时<i>%M</i>分钟<i>%S</i>', $seconds);
    }
    return $time;
}
    /**设置一周当日sesion
     * @param $week
     *
     */
function setSign($week){
    \think\Session::set("flag", $week);
}
function delSign($i){
    \think\Session::delete("flag");
}
function ifSign(){
    if(\think\Session::has("flag")){
        return true;
    }else{
        return false;
    }
}
function getUsername(){
    return \think\Session::get("Username");
}
function ifUsernameID(){
    if(\think\Session::has("UsernameID")){
        return true;
    }else{
        return false;
    }
}


