<?php
// 本类由系统自动生成，仅供测试用途
class AddNovelAction extends Action {
    public function index(){
    	if(session('?userName')){
    		$this->userName = session('userName');//前台显示登录用户名
            $this->userId =session('userId');//获取用户的id号
        	$this->logout =session('logout');	

            $bookclass=M("bookclass")->select();
            $this->assign('bookclass',$bookclass);
            
    		$this->display();
    	}
    	else{
    		header("Content-Type:text/html; charset=utf-8");
    		redirect('./author/login',0,'请先登录！');
    	}
    	
    }
    public function add(){
        $books = D("books");
        $data['bookClassId']=$_POST['bookClassId'];
        $data['bookType']=$_POST['bookType'];
        $data['bookTitle']=$_POST['bookTitle'];
        $data['bookDescribe']=$_POST['bookDescribe'];
        $data['bookAuthorId']=$_POST['bookAuthorId'];
        $data['authorName']=$_POST['authorName'];
        $data['addTime']=date("Y-m-d");
        if ($list = $books->add($data)) {
            $this->success('数据保存成功！');
               
        
        } else {
             $this->error('数据写入错误！');
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