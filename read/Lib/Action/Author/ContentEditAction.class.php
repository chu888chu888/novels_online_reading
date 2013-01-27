<?php
// 本类由系统自动生成，仅供测试用途
class ContentEditAction extends Action {
    public function index(){
    	if(session('?userName')){
    		$this->userName = session('userName');//前台显示登录用户名
            $this->userId =session('userId');//获取用户的id号
        	$this->logout =session('logout');	

          
            $book['id']=$_GET['id'];
            $bookcontents=M("bookcontents")->where($book)->select();
             $this->assign('bookcontents',$bookcontents);
           
            
    		$this->display();
    	}
    	else{
    		header("Content-Type:text/html; charset=utf-8");
    		redirect('./author/login',0,'请先登录！');
    	}
    	
    }
    public function save(){
        $bookcontents = M("bookcontents");

        $data['id'] = $_GET['id'];
        $data['contentName'] =$_POST['contentName'];
         $data['contentNum'] = $_POST['contentNum'];
         $data['contents'] = $_POST['contents'];
         //$data['lastUpdate'] = date("Y-m-d");

         
        if ($bookcontents->save($data)) {
             
                $this->success('数据保存成功！');
           
        } else {
             $this->error('数据写入错误！');
        }
    }

     
    
}