<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
    	if(session('?userName')){
    		$this->userName = session('userName');//前台显示登录用户名
        	$this->logout =session('logout');	
    		$this->display();
    	}
    	else{
    		header("Content-Type:text/html; charset=utf-8");
    		redirect('./admin/login',0,'请先登录！');
    	}
    	
    }
    
}