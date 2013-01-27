<?php
// 本类由系统自动生成，仅供测试用途
class ClassEditAction extends Action {
    public function index(){
    	if(session('?userName')){
            $data['id']=$_GET['id'];
            
    		$bookClass=M("bookclass")->where($data)->select();
            $this->assign('bookClass',$bookClass);
            
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
        
        $data['id']=$_GET['id'];
        $data['bookClassName']=$_POST['bookClassName'];
        
        if($bookclass=M("bookclass")->save($data)){
                $this->success('数据保存成功！');
            }
            else{
                $this->error('数据写入错误！');
            }
    }
    
    
}