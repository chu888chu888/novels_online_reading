<?php
// 本类由系统自动生成，仅供测试用途
class LibaryAction extends Action {
    public function index(){
       if(session('?userName')){
    		$this->userName = session('userName');//前台显示登录用户名
    		$this->logout =session('logout');
                          $user['userId']=  session('userId');

                       //链接2张表
                       /*

                        教你如何写thinkphp多表查询语句 (2011-04-07 13:18:44)转载▼
1、table()函数
thinkphp中提供了一个table()函数，具体用法参考以下语句：
$list=$Demo->table('think_blog blog,think_type type')->where('blog.typeid=type.id')->field('blog.id as id,blog.title,blog.content,type.typename as type')->order('blog.id desc' )->limit(5)->select();
echo $Demo->getLastSql(); //打印一下SQL语句，查看一下
 
2、join()函数
看一下代码：
$Demo = M('artist');
$Demo->join('RIGHT JOIN think_work ON think_artist.id = think_work.artist_id' );
//可以使用INNER JOIN 或者 LEFT JOIN 这里一定要注意表名的前缀！
echo $Demo->getLastSql(); //打印一下SQL语句，查看一下

                       */
                       $mybooks=D("booklib")->join(' INNER JOIN books ON books.id = booklib.bookId')->where($user)->select();

                      

                       $this->assign('mybooks',$mybooks);
                    $this->display();
    	}
    	else{
    	 header("Content-Type:text/html; charset=utf-8");
    	 
    		redirect('login',0,'请先登录！');
    	}
    }
}