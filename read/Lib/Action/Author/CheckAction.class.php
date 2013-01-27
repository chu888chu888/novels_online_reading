<?php
// 本类由系统自动生成，仅供测试用途
class CheckAction extends Action {
    public function index(){
        $User=M("User");
        //多字段查询
        $condition['userName']=$_POST['userName'];
        $condition['userPass']=$_POST['userPass'];
        $condition['state']=1;
        $condition['userType']=1;
        //如果能找到这个用户的id
        if($userId=$User->where($condition)->getField('id') ){              
               session('userName',$condition['userName']); //讴置session  
               session('userId',$userId); //讴置session    
               session('logout','[退出]'); //设置session   
               redirect('../author',0,'请先登录！');          
        }
        else{
        $this->error('帐号或密码错误!');
        }
    }

    
}