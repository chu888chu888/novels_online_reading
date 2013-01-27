<?php
// 本类由系统自动生成，仅供测试用途
class EbookAction extends Action {
    public function index(){
    	
    	$bookcontents=M('bookcontents')->where('booksId=33 and contentNum=1')->select();
    	$this->assign('bookcontents',$bookcontents);
        $this->display();
    }

     public function read(){
        if(session('?userName')){
             $this->userName = session('userName');//前台显示登录用户名
            $this->logout =session('logout');
        //read/book序号/章节序号
        $data['booksId']=$_GET["_URL_"][2];
        $data['contentNum']=$_GET["_URL_"][3];
        $bookcontents=M('bookcontents')->where($data)->select();
        $this->assign('bookcontents',$bookcontents);
        
        //获取书名
        $book['id']=$_GET["_URL_"][2];
        $bookName=M('books')->where($book)->getField('bookTitle');
        $this->bookName=$bookName;
        //最大的章节序号
        $contentMaxId['booksId']=$_GET["_URL_"][2];
        $contentMax=M('bookcontents')->where($contentMaxId)->order('contentNum desc')->getField('contentNum');
        $this->contentMax=$contentMax;
       
        $this->bookId=$book['id'];
        $this->contentId=$data['contentNum'];

        $bookmarkUserId['userId']= session('userId');
        $bookmarkUserId['bookId']=$_GET["_URL_"][2];
         $bookmarkData['contentId']=$_GET["_URL_"][3];
         $bookmarkData['lastTime']=date("Y-m-d");
        $bookmark=M("booklib")->where($bookmarkUserId)->save($bookmarkData);
        $this->display();

        }else{
             header("Content-Type:text/html; charset=utf-8");
         
            redirect('../../../login',1,'请先登录！');

        }
       
    }
   
}