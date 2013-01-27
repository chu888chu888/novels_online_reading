<?php
// 本类由系统自动生成，仅供测试用途
class NovelListAction extends Action {
    public function index(){
    	if(session('?userName')){
    		$this->userName = session('userName');//前台显示登录用户名
            $this->userId =session('userId');//获取用户的id号
        	$this->logout =session('logout');	
            $author['bookAuthorId']=session('userId');

            $books=M("books")->where($author)->select();
            $this->assign('books',$books);   
    		$this->display();
    	}
    	else{
    		header("Content-Type:text/html; charset=utf-8");
    		redirect('./author/login',0,'请先登录！');
    	}
    	
    }
    

     public function del(){
        $condition['id'] = $_GET["_URL_"][4];
        $id = $_GET["_URL_"][4];
        $books=M("books");
        if($list=$books->where($condition)->delete()){
            $this->success('删除成功！');

        }
        else{
             $this->error('啊哦，删除失败!');
        }

    }
    
}