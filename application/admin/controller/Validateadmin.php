<?php
namespace app\admin\controller;
use app\admin\model\Validateadmin as ValidateadminModel;
class Validateadmin  
{
    function index(){
    
     $val=new ValidateadminModel();
     echo  $val->username();
     echo  $val->password();
     echo  $val->confirmpwd();
     echo  $val->name();
     echo  $val->tel();
     echo  $val->username_edit();
  
    }
      
     
}
