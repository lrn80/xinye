### 完成的功能
- 管理员的登录
- 管理员的add edit delete
- Auth权限分配管理管理
### 管理员的登录
登陆界面主要是对管理员的账号密码以及验证码进行验证  
具体内容如下图：
![](http://xy.lrnjy.club/images/xinye-1.png)
### 管理员列表的增删改  
在add和edit界面利用onblur事件,触发Ajax请求后端相应的方法来效验填写的内容是否符合规则。当离开框时就给予相应的提示。
![](http://xy.lrnjy.club/images/xinye-2.png)
### 管理员Auth权限
#### 引入Auth包  
由于thinkphp3.2是自带Auth权限认证包的，到了thinkphp5便去除掉了，所以把3.2的auth权限类做一下修改应用的thinkphp5上边。https://github.com/lrn80/xinye/blob/master/application/admin/controller/Auth.php  
#### 建表并说明  
首先我们要建立三张必要的表  
auth_group（用户组表） 1 超级管理员 2 普通管理员 3 文章发布专员 
![](http://xy.lrnjy.club/images/7-thinkphp5-auth1-1.png)
auth_rule （规则表）   1 article/add 2 article/edit 3 article/del 控制器名/方法名
![](http://xy.lrnjy.club/images/7-thinkphp5-auth2-2.png)
auth_group_access（用于管理员表和用户组表相连）uid 1 group_id 1  
![](http://xy.lrnjy.club/images/7-thinkphp5-auth2-3.png)  
**建表语句参考上边链接**
#### 实现的核心函数  
- **list**页面利用无限级分类对内容进行展示实现如下效果：  
将数据进行排序 最后的排序结果实现如下效果：
管理员组  
|---管理员组列表  
|------管理员组修改  
|------管理员组删除  
|------管理员组增加  
签到中心  
|---签到列表  
|------修改签到  
|------增添签到  
//每一个子分类在相应的父级的下面  

```php
public function authRuleTree(){
        $authRuleres=$this->order('sort desc')->select(); //取出所有的数据并按照sort进行排序
        return $this->sort($authRuleres);
    }
    public function sort($data,$pid=0){
        static $arr=array();
        foreach ($data as $k => $v) {
            if($v['pid']==$pid){            //找到顶级分类
                $arr[]=$v;
                $this->sort($data,$v['id']); //利用递归找到下面的子分类
            }
        }
        return $arr;
    }
```

- delete操作的时候不只是把前端传来的id对应项进行删除就好了。    
例如：      
管理员组    
|---管理员组列表  
|------管理员组修改  
|------管理员组删除  
|------管理员组增加  
签到中心  
|---签到列表  
|------修改签到  
|------增添签到  
当我们删除*签到中心*的时候应该将对应的子栏目一并删除，同理当我们删除*签到列表*的时候下面的子栏目也要得到一并的删除。
具体实现的思路体现在代码：  
通过递归找到相应的子栏目ID一并删除  

```php
   public function getchilrenid($authRuleId){
        $AuthRuleRes=$this->select();
        return $this->_getchilrenid($AuthRuleRes,$authRuleId);
    }
    public function _getchilrenid($AuthRuleRes,$authRuleId){
        static $arr=array();
        foreach ($AuthRuleRes as $k => $v) {
            if($v['pid'] == $authRuleId){         //找到父级ID等于传过来的ID的数据可以找到相应的子项
                $arr[]=$v['id'];
                $this->_getchilrenid($AuthRuleRes,$v['id']);
            }
        }
        return $arr;
    }
```

- 当分配权限的时候如果分配到了子权限那么相应的父级权限也应该会有：
例如：  
管理员组  
|---管理员组列表  
|------管理员组修改  
|------管理员组删除  
|------管理员组增加  
签到中心  
|---签到列表  
|------修改签到  
|------增添签到  
当分配到*管理员组修改*权限的时候它的父级权限也应该一并分配（*管理员组* 和*管理员组列表* ）的权限。  
所以我们要找到相应的父级的ID代码如下：  

```php
 public function getparentid($authRuleId){
        $AuthRuleRes=$this->select();
        return $this->_getparentid($AuthRuleRes,$authRuleId);
    }

    public function _getparentid($AuthRuleRes,$authRuleId){
        static $arr=array();      
        foreach ($AuthRuleRes as $k => $v) {
            if($v['id'] == $authRuleId){
                $arr[]=$v['id'];
                $this->_getparentid($AuthRuleRes,$v['pid'],False);
            }
        }     
        return $arrStr;
    }
```

#### 完成check  
完成效验是利用Auth类中的check方法具体细节看代码中的注释。  
说明：将代码写到Common（每个控制器要继承的公共类）的_initialize（定义控制器初始化方法 _initialize）  

```php
 $auth=new Auth();//实例化auth
 $request=Request::instance(); //实例化auth
 $con=$request->controller(); //得到请求的控制器名称
 $action=$request->action(); //得到请求的方法名称
 $name=$con.'/'.$action;
 $notCheck=array('Index/index','Admin/lst','Admin/logout'); //定义不用校验的控制器方法
 if(session('id')!=1){
    if(!in_array($name, $notCheck)){
        if(!$auth->check($name,session('id'))){              //调用check方法进行校验
        $this->error('没有权限',url('index/index')); 
            }
    }   
 }
```
