<?php
// 本类由系统自动生成，仅供测试用途
class EditUserAction extends Action {
    public function index(){
    	if(session('?userName')){
            //$condition['id']=$_get['id'];
            //$this->num=$_GET['id'];
            $id['id']=$_GET['id'];
    		$User=M("User")->where($id)->select();
            $this->assign('User',$User);
            $this->userName = session('userName');//前台显示登录用户名
            $this->logout =session('logout');   
    		$this->display();
    	}
    	else{
    		header("Content-Type:text/html; charset=utf-8");
    		redirect('./login',0,'请先登录！');
    	}
    	
    }
    public function save(){
        if(session('?userName')){
            $this->userName = session('userName');//前台显示登录用户名
            $this->logout =session('logout');   

            $data['id']=$_GET['id'];
            $data['userName']=$_POST['userName'];
            $data['userPass']=$_POST['userPass'];
            if($User=M("User")->save($data)){
                $this->success('数据保存成功！');
            }
            else{
                $this->error('数据写入错误！');
            }
            
            
           
        }
        else{
            header("Content-Type:text/html; charset=utf-8");
            redirect('./login',0,'请先登录！');
        }

    }
   
    
}