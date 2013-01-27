<?php
// 本类由系统自动生成，仅供测试用途
class AddContentAction extends Action {
    public function index(){
    	if(session('?userName')){
    		$this->userName = session('userName');//前台显示登录用户名
            $this->userId =session('userId');//获取用户的id号
        	$this->logout =session('logout');	

           
            $bookId['id']=$_GET['id'];
            $books=M("books")->where($bookId)->select();
            $this->assign('books',$books);   
            
            $book['booksId']=$_GET['id'];
            $bookNewNum=M("bookcontents")->where($book)->order('contentNum desc')->limit(1)->getField('contentNum');
             $this->bookNewNum=++$bookNewNum;
           
            
    		$this->display();
    	}
    	else{
    		header("Content-Type:text/html; charset=utf-8");
    		redirect('./author/login',0,'请先登录！');
    	}
    	
    }
    public function add(){
        $bookcontents = D("bookcontents");
        if ($vo = $bookcontents->create()) {
            $list = $bookcontents->add();

            $bookMaxContent['maxContentId']=$_POST['contentNum'];
            $bookId['id']=$_POST['booksId'];
            $maxContentId=M("books")->where($bookId)->save($bookMaxContent);
           
            if ($list !== false) {
                $this->success('数据保存成功！');
            } else {
                $this->error('数据写入错误！');
            }
        } else {
            $this->error($User->getError());
        }
    }

     
    
}