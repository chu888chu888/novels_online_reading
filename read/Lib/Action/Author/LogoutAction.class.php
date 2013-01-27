<?php
class LogoutAction extends Action {
    public function index(){
       session(null);
       redirect('login',0,'请先登录！');
    }
    
}