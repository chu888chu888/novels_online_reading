<?php
// 本类由系统自动生成，仅供测试用途
class LoginAction extends Action {
    public function index(){
    	$this->userName=session('userName');
    	$this->logout=session("logout");
        $this->display();
    }

    
}