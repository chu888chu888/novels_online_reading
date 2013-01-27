<?php
// 本类由系统自动生成，仅供测试用途
class UserAction extends Action {
    public function index(){
    	if(session('?userName')){
    		$User=M("User")->select();
            $this->assign('User',$User);
            $this->userName = session('userName');//前台显示登录用户名
            $this->logout =session('logout');   
    		$this->display();
    	}
    	else{
    		header("Content-Type:text/html; charset=utf-8");
    		redirect('./login',0,'请先登录！');
    	}
    	
    }
    public function add(){
        $User = D("User");
        if ($vo = $User->create()) {
            $list = $User->add();
            /* 比如
             *  $Form->add($data);
              或者使用data方法连贯操作
              $User->data($data)->add();
              如果在add之前已经创建数据对象的话（例如使用了create或者data方法），add方法就不需要再传入数据了。
             */
            //如果你的主键是自动增长类型，并且如果插入数据成功的话，add方法的返回值就是最新插入的主键值，可以直接获取。 
            if ($list !== false) {
                $this->success('数据保存成功！');
            } else {
                $this->error('数据写入错误！');
            }
        } else {
            $this->error($User->getError());
        }
    }
    
    public function del(){
        $condition['id'] = $_GET["_URL_"][4];
        $id = $_GET["_URL_"][4];
        $User=M("User");
        if($list=$User->where($condition)->delete()){
            $this->success('删除成功！');

        }
        else{
             $this->error('啊哦，删除失败!');
        }

    }
    public function checkup(){
        $condition['id'] = $_GET["_URL_"][4];
        $id = $_GET["_URL_"][4];
        $data['state']=1;
        $User=M("User");
        if($list=$User->where($condition)->save($data)){
            $this->success('审核成功！');

        }
        else{
             $this->error('啊哦，审核失败!');
        }
    }
    public function checkupAuthorYes(){
        $condition['id'] = $_GET["_URL_"][4];
        $id = $_GET["_URL_"][4];
        $data['userType']=1;
        $User=M("User");
        if($list=$User->where($condition)->save($data)){
            $this->success('设为作者成功！');

        }
        else{
             $this->error('啊哦，设为作者失败!');
        }

    }
    public function checkupAuthorNo(){
        $condition['id'] = $_GET["_URL_"][4];
        $id = $_GET["_URL_"][4];
        $data['userType']=0;
        $User=M("User");
        if($list=$User->where($condition)->save($data)){
            $this->success('撤销作者成功！');

        }
        else{
             $this->error('啊哦，撤销作者失败!');
        }

    }
    
}