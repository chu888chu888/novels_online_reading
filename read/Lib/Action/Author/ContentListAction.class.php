<?php
// 本类由系统自动生成，仅供测试用途
class ContentListAction extends Action {
    public function index(){
    	if(session('?userName')){
    		$this->userName = session('userName');//前台显示登录用户名
            $this->userId =session('userId');//获取用户的id号
        	$this->logout =session('logout');	
            $book['booksId'] = $_GET['id'];
            
            

            $bookcontents=M("bookcontents")->where($book)->order('contentNum desc')->select();
             $this->assign('bookcontents',$bookcontents);   
    		
            $this->display();
    	}
    	else{
    		header("Content-Type:text/html; charset=utf-8");
    		redirect('./author/login',0,'请先登录！');
    	}
    	
    }
    

     public function del(){
        $condition['id'] = $_GET["_URL_"][4];
        
        $bookcontents=M("bookcontents");
        if($list=$bookcontents->where($condition)->delete()){
            $this->success('删除成功！');

        }
        else{
             $this->error('啊哦，删除失败!');
        }

    }
    
}