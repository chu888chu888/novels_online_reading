<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
    	if(session('?userName')){
    		$this->userName = session('userName');//前台显示登录用户名
    		$this->logout =session('logout');
                            
                        $books=M("books")->select();                       
                        $this->assign('books',$books);

                        $userId['userId']= session('userId');
                        $booklib=M("booklib")->where($userId)->select();      
    		$this->assign('booklib',$booklib);
                        $this->display();
    	}
    	else{
    	 header("Content-Type:text/html; charset=utf-8");
    	 
    		redirect('login',0,'请先登录！');
    	}
        	
    }

     public function add(){
        $userId=session('userId');
        $bookId=$_GET["_URL_"][3];
        $data['userId']=$userId;
        $data['bookId']=$bookId;
        
       if($list=M("booklib")->data($data)->add() )
       {
        $this->success('数据保存成功！');
       }
       else
       {
        $this->error('数据写入错误！');
       }
    }
}