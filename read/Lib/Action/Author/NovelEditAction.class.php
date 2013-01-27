<?php
// 本类由系统自动生成，仅供测试用途
class NovelEditAction extends Action {
    public function index(){
    	if(session('?userName')){
    		$this->userName = session('userName');//前台显示登录用户名
            $this->userId =session('userId');//获取用户的id号
        	$this->logout =session('logout');	

            $condition['id'] = $_GET["id"];
            $books=M("books")->where($condition)->select();
            $this->assign('books',$books); 

            //得到当前分类
            $bookClassId['id']=M("books")->where($condition)->getField('bookClassId');           
            $bookclass=M("bookclass")->where($bookClassId)->select();
            $this->assign('bookclass',$bookclass);  

            //得到除当前分类的其他分类
            $bookClassIdNeq['id'] = array('neq',$bookClassId['id']);
            $bookclassAll=M("bookclass")->where($bookClassIdNeq)->select();
            //echo $bookclassAll;
            $this->assign('bookclassAll',$bookclassAll);  
    		$this->display();
    	}
    	else{
    		header("Content-Type:text/html; charset=utf-8");
    		redirect('./author/login',0,'请先登录！');
    	}
    	
    }
    

     public function edit(){
       
        $condition['id'] = $_GET["id"];

        $condition['bookTitle'] = $_POST["bookTitle"];
        $condition['bookDescribe'] = $_POST["bookDescribe"];
        $condition['bookClassId'] = $_POST["bookClassId"];
        $condition['bookType'] = $_POST["bookType"];

       
        if ($list = M("books")->save($condition)) {
            $this->success('数据保存成功！');
           
        } else {
             $this->error('数据写入错误！');
        }
        
       
    }
    
}